<?php
session_start();
include 'header.php';

$userObject = new User();
$projectObject = new PROJECTS();
$users = $userObject->getAllusers();
$projects = $projectObject->getAllProjects();

$issueObject = new Issue();

if(isset($_POST['submit'])) {

    $issueObject->getIssueInfo($_POST['issueName'], $_POST['issueBody'], $_POST['assignedUserID'],$_POST['priority'],$_POST['assignedProjectID']);
    $issueObject->createIssue();
}

?>

<div class="topBar span10">
    <div class="dropMenu span4">
        <div id="flip">Manage Tickets</h4></div>
        <div id="panel">
            <a href="addissue.php"> create New ticket </a></br>
            <a href="allTickets.php"> See All tickets </a></br>
        </div>
    </div>

    <script>
        $(document).ready(function(){
            $("#flip").click(function(){
                $("#panel").slideDown(300);
            });
        });
        $("#panel").click(function(){
            $("#panel").slideUp(300);

        });
    </script>
</div>

<div class="span6">
<h2>New Ticket </h2>
    <form action="addIssue.php" method="post" id="issueForm">
        Issue Name:<br><input type="text" name="issueName" id="textField"><br>

    </form>
        Issue Description:<br>
        <textarea rows="6" cols="400"name="issueBody" id="textField" form="issueForm"></textarea><br>

    Assign to User:<select name="assignedUserID" form="issueForm" id="dMenu">
        <?php foreach( $users as $user){?>
            <option value="<?= $user['userID']?>"> <?= $user['FName'] ?></option>
        <?php } ?>
    </select><br>
    Assign Project:<select name="assignedProjectID" form="issueForm" id="dMenu">
        <?php foreach( $projects as $project){?>
            <option value="<?= $project['projectID']?>"> <?= $project['projectName'] ?></option>
        <?php } ?>
    </select><br>
    Set Priority :
    <select name="priority" form="issueForm" id="dMenu">
        <option value="3">Normal</option>
        <option value="2">High</option>
        <option value="1">Critical</option>
    </select>

    <button class="btn-large submitButton" name="submit" form="issueForm"> Submit</button><br>

</div>





</body>
</html>