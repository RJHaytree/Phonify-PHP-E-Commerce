<?php
/**
 * Login
 * ------------------------------
 * Login class to be instantiated whenever a login must be performed.
 * 
 * @author Ryan Haytree
 */

$filepath = realpath(dirname(__FILE__));
require_once($filepath . './../database/Database.php');

class Login {

    private $uid;
    private $pass;
    private $db;

    public function __construct($uid, $pass) {
        $this->uid = $uid;
        $this->pass = $pass;
        $this->login($this->uid, $this->pass);
    }

    /**
     * Perform the login function.
     */
    public function login() {
        # Establish connection and prepared statement. Preparement state is used due to user input being submitted to the database.
        $this->db = new Database();
        $conn = $this->db->getConnection();
        $stmt = $conn->prepare("SELECT * FROM `tbl_users` WHERE username=? OR email=?");
        if (!$stmt) {
            # Shouldn't ever happen, but checking the statement was prepared has no downsides.
            echo "An error has occured. Contact Admin";
            exit;
        }
        $stmt->bind_param("ss", $this->uid, $this->uid);
        $stmt->execute();
        $result = $stmt->get_result();

        # Using the result of the query, create a user array in the session containing credentials.
        if ($result && $result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                if (password_verify($this->pass, $row['password'])) {
                    $_SESSION['user']['username'] = $row['username'];
                    $_SESSION['user']['email'] = $row['email'];

                    echo 'success';
                    exit;
                }
                else {
                    echo "Password does not match";
                }
            }
        }
        else {
            echo "Email or Username does not match";
        }
    }
}

?>