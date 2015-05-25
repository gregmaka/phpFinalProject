<?php
/**
 * Created by PhpStorm.
 * User: greg
 * Date: 4/19/15
 * Time: 5:11 PM
 */

require 'classes/Database.php';
class Issue {


    public $issueName;
    public $issueBody;
    public $assignedUserID;
    public $priority;
    public $assigned_TO;
    public $FName;
    public $status;
    public $statusID;
    public $statusType;
    public $assignedProject;

    public $conn;

    function __construct()
    {
        $db = new Database();
        return $this->conn = $db->connect();
    }

    function createIssue()
    {
        $conn = $this->conn;

        $sql = "INSERT INTO ISSUE (issueName, issueBody, assigned_TO, priority, assigned_project)
              VALUES ('$this->issueName','$this->issueBody','$this->assignedUserID','$this->priority','$this->assignedProject')";
        if ($conn->query($sql) === TRUE) {
            echo "New Issue created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    function getIssueInfo($issueName, $issueBody, $assignedUserID, $priority,$assignedProject)
    {
        $this->issueName = $issueName;
        $this->issueBody = $issueBody;
        $this->assignedUserID = $assignedUserID;
        $this->priority = $priority;
        $this->assignedProject = $assignedProject;
    }

    function getIssues()
    {
        $conn = $this->conn;

        $sql = "SELECT issueName,priority,FName, assigned_TO,issueID,statusID,statusType,status,pID,pType,pColor,insDate,assigned_project,projectName,projectID
                FROM ISSUE
                LEFT JOIN USER ON ISSUE.assigned_TO = USER.userID
                LEFT JOIN PRIORITY ON ISSUE.priority = PRIORITY.pID
                LEFT JOIN STATUS ON ISSUE.status = STATUS.statusID
                LEFT JOIN PROJECTS ON ISSUE.assigned_project = PROJECTS.projectID";
        $r = mysqli_query($conn, $sql);
        if($r!==false)
        {
            while (list($issueName,$priority,$FName,$assigned_TO,$issueID,$statusID,$status,$statusType,$pID,$pType,$pColor,$dateTime,$assigned_project, $projectName,$projectID) = mysqli_fetch_array($r, MYSQLI_NUM))
            {
                $tempArray[] = array(
                    "issueName"=>$issueName,
                    "priority"=>$priority,
                    "firstName"=>$FName,
                    "assigned"=>$assigned_TO,
                    "issueID"=>$issueID,
                    "statusID"=>$statusID,
                    "status"=>$status,
                    "statusType"=>$statusType,
                    "pID"=>$pID,
                    "pType"=>$pType,
                    "pColor"=>$pColor,
                    "dateTime"=>$dateTime,
                    "assigned_project"=>$assigned_project,
                    "projectName"=>$projectName,
                    "projectID"=>$projectID,

                );
               //var_dump($tempArray);
            }

            return $tempArray;
        }
        else  //if the database got no records for any reason fail
        {
            return false;
        }
    }


    function getUserIssues($userID)
    {
        $conn = $this->conn;

        $sql = "SELECT issueName,priority, assigned_TO,issueID,statusID,statusType,status,pID,pType,pColor,insDate
                FROM ISSUE
                LEFT JOIN USER ON ISSUE.assigned_TO = USER.userID
                LEFT JOIN PRIORITY ON ISSUE.priority = PRIORITY.pID
                LEFT JOIN STATUS ON ISSUE.status = STATUS.statusID
                WHERE ISSUE.assigned_TO = '$userID' AND ISSUE.status != 2";
        $r = mysqli_query($conn, $sql);
        if($r!==false)
        {
            while (list($issueName,$priority,$assigned_TO,$issueID,$statusID,$status,$statusType,$pID,$pType,$pColor,$dateTime) = mysqli_fetch_array($r, MYSQLI_NUM))
            {
                $tempArray[] = array(
                    "issueName"=>$issueName,
                    "priority"=>$priority,
                    "assigned"=>$assigned_TO,
                    "issueID"=>$issueID,
                    "statusID"=>$statusID,
                    "status"=>$status,
                    "statusType"=>$statusType,
                    "pID"=>$pID,
                    "pType"=>$pType,
                    "pColor"=>$pColor,
                    "dateTime"=>$dateTime,

                );
                //var_dump($tempArray);
            }
            return $tempArray;
        }
        else  //if the database got no records for any reason fail
        {
            return false;
        }
    }
    function getSingleIssue($issueID)
    {
        $conn = $this->conn;

        $sql = "SELECT issueName,priority, assigned_TO,issueID,statusID,statusType,status,issueBody,FName,LName,pID,pType
                FROM ISSUE
                LEFT JOIN USER ON ISSUE.assigned_TO = USER.userID
                LEFT JOIN PRIORITY ON ISSUE.priority = PRIORITY.pID
                LEFT JOIN STATUS ON ISSUE.status = STATUS.statusID
                WHERE ISSUE.issueID = '$issueID'";
        $r = mysqli_query($conn, $sql);
        if($r!==false)
        {
            while (list($issueName,$priority,$assigned_TO,$issueID,$statusID,$status,$statusType,$issueBody,$FName,$LName,$pID,$pType) = mysqli_fetch_array($r, MYSQLI_NUM))
            {
                $tempArray[] = array(
                    "issueName"=>$issueName,
                    "priority"=>$priority,
                    "assigned"=>$assigned_TO,
                    "issueID"=>$issueID,
                    "statusID"=>$statusID,
                    "status"=>$status,
                    "statusType"=>$statusType,
                    "issueBody"=>$issueBody,
                    "FName"=>$FName,
                    "LName"=>$LName,
                    "pID"=>$pID,
                    "pType"=>$pType,


                );
                //var_dump($tempArray);
            }
            return $tempArray;
        }
        else  //if the database got no records for any reason fail
        {
            return false;
        }
    }
    function getIssueCount($userID)
    {
        $conn = $this->conn;

        $sql = "SELECT issueName,priority, assigned_TO,issueID
                FROM ISSUE
                LEFT JOIN USER ON ISSUE.assigned_TO = USER.userID
                WHERE ISSUE.assigned_TO = '$userID' AND ISSUE.status != '2'";
        $r = mysqli_query($conn, $sql);

        return  mysqli_num_rows($r);
    }

    function getIssueCountAll()
    {
        $conn = $this->conn;

        $sql = "SELECT issueID
                FROM ISSUE
                WHERE ISSUE.status != 2";
        $r = mysqli_query($conn, $sql);

        return  mysqli_num_rows($r);

    }



    function getNewIssueCount($userID)
    {
        $conn = $this->conn;

        $sql = "SELECT issueName,priority, assigned_TO,issueID,statusID,statusType,status
                FROM ISSUE
                LEFT JOIN USER ON ISSUE.assigned_TO = USER.userID
                LEFT JOIN STATUS ON ISSUE.status = STATUS.statusID
                WHERE ISSUE.assigned_TO = '$userID' AND STATUS.statusID = '0'";
        $r = mysqli_query($conn, $sql);

        return  mysqli_num_rows($r);


    }
    function getIssueCountByPriority($priority)
    {
        $conn = $this->conn;

        $sql = "SELECT issueName,priority,issueID,pID,pType
                FROM ISSUE
                LEFT JOIN PRIORITY ON ISSUE.issueID = PRIORITY.pID
                WHERE ISSUE.priority = '$priority' AND ISSUE.status != 2";
        $r = mysqli_query($conn, $sql);

        return  mysqli_num_rows($r);

    }

    function getIssueCountByStatus($status) //new open or closed
    {
        $conn = $this->conn;

        $sql = "SELECT issueName,issueID,statusID,statusType,status
                FROM ISSUE
                LEFT JOIN STATUS ON ISSUE.status = STATUS.statusID
                WHERE STATUS.statusID = '$status'";
        $r = mysqli_query($conn, $sql);

        return  mysqli_num_rows($r);


    }

    function updateIssue($status,$issueID)
    {
        $conn = $this->conn;

        $sql = "UPDATE ISSUE
                SET status = '$status' WHERE issueID = '$issueID'";
        $r = mysqli_query($conn, $sql);


    }
}