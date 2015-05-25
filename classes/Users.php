<?php
/**
 * Created by PhpStorm.
 * User: greg
 * Date: 4/19/15
 * Time: 2:46 PM
 */

class User {

    public $FName;
    public $LName;
    public $username;
    public $password;
    public $email;

    public $usersArray;

    function __construct()
    {
       // $this->createUser();
    }

    function createUser()
    {
        // Create connection
        $conn = new mysqli('localhost', 'root', 'root', 'tixDB');
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "INSERT INTO USER (FName, LName, username, password, email)
              VALUES ('$this->FName','$this->LName', '$this->username', '$this->password', '$this->email')";
        if ($conn->query($sql) === TRUE) {
            echo "New User created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

    }

    function getUserInfo($FName, $LName, $username, $password, $email)
    {
        $this->FName = $FName;
        $this->LName = $LName;
        $this->username = $username;
        $this->password = $password;
        $this->email = $email;
    }

    function getAllusers(){
        // Create connection
        $conn = new mysqli('localhost', 'root', 'root', 'tixDB');
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT userID, FName, LName, userName,email FROM USER";
        $r = mysqli_query($conn, $sql);
        if($r!==false)
        {
            while (list($userID, $FName,$LName,$userName,$email) = mysqli_fetch_array($r, MYSQLI_NUM))
            {
                $tempArray[] = array(
                    "userID"=>$userID,
                    "FName"=>$FName,
                    "LName"=>$LName,
                    "userName"=>$userName,
                    "email"=>$email,
                );
            }
            return $tempArray;



        }
        else  //if the database got no records for any reason fail
        {
            return false;
        }
    }

    function getTotalUsers(){

        // Create connection
        $conn = new mysqli('localhost', 'root', 'root', 'tixDB');
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT userID
                FROM USER";
        $r = mysqli_query($conn, $sql);

        return  mysqli_num_rows($r);
    }

    function getName($userID){
        // Create connection
        $conn = new mysqli('localhost', 'root', 'root', 'tixDB');
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT FName from USER WHERE userID = '$userID'";
        $r = mysqli_query($conn, $sql);
        $userName = mysqli_fetch_array($r);

            return $_SESSION['FName'] = $userName['FName'];


    }

    public function check_login($email, $password)
    {
        // Create connection
        $conn = new mysqli('localhost', 'root', 'root', 'tixDB');
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $password = $password;
        $sql = "SELECT userID from USER WHERE USER.email = '$email' and USER.password = '$password' OR USER.username = '$email' and USER.password = '$password'";
        $r = mysqli_query($conn, $sql);
        $user_data = mysqli_fetch_array($r);
        $no_rows = mysqli_num_rows($r);
        if ($no_rows == 1)
        {
            $_SESSION['login'] = true;
            $_SESSION['userID'] = $user_data['userID'];
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

// Getting session
    public function get_session()
    {
        return $_SESSION['login'];
    }
// Logout
    public function user_logout()
    {
        $_SESSION['login'] = FALSE;
        session_destroy();
    }

}