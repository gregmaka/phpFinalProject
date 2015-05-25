<?php
/**
 * Created by PhpStorm.
 * User: greg
 * Date: 5/3/15
 * Time: 7:58 PM
 */

class Comments
{
    public $issueID;
    public $message;
    public $assignedUserID;

    function getCommentInfo($message, $issueID, $assignedUserID)
    {
        $this->message = $message;
        $this->issueID = $issueID;
        $this->assignedUserID = $assignedUserID;
    }


    function createComment()
    {
        // Create connection
        $conn = new mysqli('localhost', 'root', 'root', 'tixDB');
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "INSERT INTO COMMENTS (message, assigned_issue, assigned_TO)
                 VALUES ('$this->message','$this->issueID','$this->assignedUserID')";
        if ($conn->query($sql) === TRUE) {
            echo "New Comment created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    function getComments($issueID){
        // Create connection
        $conn = new mysqli('localhost', 'root', 'root', 'tixDB');
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT commentID, message, assigned_issue, assigned_TO, commentDate
                FROM COMMENTS
                WHERE COMMENTS.assigned_issue = '$issueID'
                ORDER BY commentDate DESC LIMIT 3";
        $r = mysqli_query($conn, $sql);
        if($r!==false)
        {
            while (list($commentID, $message, $assigned_issue, $assigned_TO, $commentDate,$issueID) = mysqli_fetch_array($r, MYSQLI_NUM))
            {
                $tempArray[] = array(
                    "commentID"=>$commentID,
                    "message"=>$message,
                    "assigned_issue"=>$assigned_issue,
                    "assigned_TO"=>$assigned_TO,
                    "commentDate"=>$commentDate,
                    "issueID"=>$issueID,
                );
            }
            return $tempArray;



        }
        else  //if the database got no records for any reason fail
        {
            return false;
        }
    }

}