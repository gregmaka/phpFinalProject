<?php
session_start();

$loggedUser = $_SESSION['FName'];

include 'header.php';

$userObject = new User();
$projectObject = new PROJECTS();

$users = $userObject->getAllusers();

if(isset($_POST['submit'])) {

    $projectObject->getProjectInfo($_POST['projectName'],$_POST['UserID']);
    $projectObject->createProject();


}
?>
<div class="topBar span10">
    <div class="dropMenu span4">
        <div id="flip">Manage Users</h4></div>
        <div id="panel">
            <a href="addUser.php">Create New User</a></br>
            <a href="users.php">Update User</a></br>
            <a href="users.php">Remove User</a>
        </div>
    </div>
</div>
<div class="span6">
    <h1>Create New Project </h1>
    <form action="addProject.php" method="post" id="projectForm">
        Project Name:<br>
        <input type="text" name="projectName">
        <br>
        Assign Project Manager:<br><select name="UserID" form="projectForm" id="dMenu">
            <?php foreach( $users as $user){?>
                <option value="<?= $user['userID']?>"> <?= $user['FName'] ?></option>
            <?php } ?>
        <input class="btn-large btn-primary" type="submit" name="submit">
    </form>
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