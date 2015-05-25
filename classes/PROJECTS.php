<?php
/**
 * Created by PhpStorm.
 * User: greg
 * Date: 5/4/15
 * Time: 9:04 PM
 */

class PROJECTS {

    public $projectName;
    public $projectManager;

    public $conn;

    function __construct()
    {
        $db = new Database();
        return $this->conn = $db->connect();
    }


    function getProjectInfo($projectName, $projectManager)
    {
        $this->projectName = $projectName;
        $this->projectManager = $projectManager;

    }

    function createProject()
    {
        $conn = $this->conn;

        $sql = "INSERT INTO PROJECTS (projectName,projectManager)
              VALUES ('$this->projectName','$this->projectManager')";
        if ($conn->query($sql) === TRUE) {
            echo "New Project created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    function getAllProjects()
    {
        $conn = $this->conn;

        $sql = "SELECT projectID, projectName, projectManager, dateCreated,userID, FName, LName
                FROM PROJECTS
                LEFT JOIN USER ON PROJECTS.projectManager = USER.userID";
        $r = mysqli_query($conn, $sql);
        if($r!==false)
        {
            while (list($projectID,$projectName,$projectManager,$dateCreated,$userID,$FName,$LName) = mysqli_fetch_array($r, MYSQLI_NUM))
            {
                $tempArray[] = array(
                    "projectID"=>$projectID,
                    "projectName"=>$projectName,
                    "projectManager"=>$projectManager,
                    "dateCreated"=>$dateCreated,
                    "userID"=>$userID,
                    "FName"=>$FName,
                    "LName"=>$LName,

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

    function getProjectsByUser($userID)
    {
        $conn = $this->conn;

        $sql = "SELECT projectID, projectName, projectManager, dateCreated
                FROM PROJECTS
                WHERE projectManager = '$userID';";
        $r = mysqli_query($conn, $sql);
        if($r!==false)
        {
            while (list($projectID,$projectName,$projectManager,$dateCreated,$assigned_issues,$userID) = mysqli_fetch_array($r, MYSQLI_NUM))
            {
                $tempArray[] = array(
                    "projectID"=>$projectID,
                    "projectName"=>$projectName,
                    "projectManager"=>$projectManager,
                    "dateCreated"=>$dateCreated,
                    "userID"=>$userID,

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

}