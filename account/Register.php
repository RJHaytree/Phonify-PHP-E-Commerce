<?php
/**
 * Register
 * ------------------------------
 * Register class to be instantiated whenever an account registration must be performed.
 * 
 * @author Ryan Haytree
 */

$filepath = realpath(dirname(__FILE__));
require_once($filepath . './../database/Database.php');

class Register {

    private $uid;
    private $email; 
    private $pass;
    private $pass2;
    private $db;

    public function __construct($uid, $email, $pass, $pass2) {
        $this->uid = $uid;
        $this->email = $email;
        $this->pass = $pass;
        $this->pass2 = $pass2;
        $this->db = new Database();

        $this->register($this->uid, $this->email, $this->pass, $this->pass2);
    }

    /**
     * Init the register sequence. 
     * 
     * @param $uid The username of the account being registered.
     * @param $email The email of the account being registered.
     * @param $pass The password of the account being registered.
     * @param $pass2 duplicate password for validation. 
     */
    public function register($uid, $email, $pass, $pass2) {
        # Validate email input to ensure email is in the correct format. 
        # This should have already been checked in the prior to the AJAX call, but checking again is never an issue.
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "Email Address format is incorrect!";
            exit;
        }

        # Check whether the username is alphanumerical.
        if (!preg_match("/^[a-zA-Z0-9]*$/", $uid)) {
            echo "Username must be alphanumerical!";
            exit;
        }

        # Check if passwords COMPLETELY match.
        if ($pass !== $pass2) {
            echo "Your passwords do not match!";
            exit;
        }

        # Check whether a user already exists with this username or email address.
        # If no duplicate found, register the account.
        if (!$this->checkDuplicates()) {
            $this->registerAccount();
        }
        else {
            echo "This username or email already exists!";
            exit;
        }
    }

    /**
     * Check for duplicate entries in the database.
     */
    public function checkDuplicates() {
        $conn = $this->db->getConnection();
        $stmt = $conn->prepare("SELECT * FROM `tbl_users` WHERE username=? OR email=?");
        if (!$stmt) {
            echo "An error has occured. Contact Admin.";
            exit;
        }
        $stmt->bind_param("ss", $this->uid, $this->email);
        $stmt->execute();
        $result = $stmt->get_result();
        return ($result->num_rows > 0) ? true : false; 
    }

    /**
     * Perform the final registration. 
     */
    public function registerAccount() {
        $conn = $this->db->getConnection();
        $stmt = $conn->prepare("INSERT INTO `tbl_users` (`username`, `email`, `password`) VALUES (?, ?, ?)");
        if (!$stmt) {
            echo "An error has occured. Contact Admin.";
            exit;
        }
        $hashed = password_hash($this->pass, PASSWORD_DEFAULT);
        $stmt->bind_param("sss", $this->uid, $this->email, $hashed);
        $stmt->execute();
        echo 'success';
        exit;
    }
}