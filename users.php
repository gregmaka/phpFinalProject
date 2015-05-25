<?php
/**
 * Created by PhpStorm.
 * User: greg
 * Date: 4/19/15
 * Time: 9:20 PM
 */
session_start();
include 'header.php';

$allUsers = $user->getAllusers();
$totalUsers = $user->getTotalUsers();

?>

<div class="dashboardID">
    <h2>Users</h2>
</div>

<div class="span10 topBar">
    <div class="barBox bbleft span3 boxShadow gradientColor-Gray">
        <h3>Users</h3>
        <p><?php echo $totalUsers; ?></p>
    </div>
    <div class="barBox bbcenter span3 boxShadow gradientColor-Gray">
        <h3>Administrators</h3>
        <p><?php echo $issueCount; ?></p>
    </div>
    <div class="barBox bbright span3 boxShadow gradientColor-Gray">
        <h3>Watchers</h3>
        <p><?php echo $newIssueCount; ?></p>
    </div>
</div>

<div class="flipPanel span10">
    <div id="flip"><p>Manage Users</p></div>
    <div id="panel">
        <a href="addUser.php">Create New User</a>|
        <a href="updateUser.php">Update User</a>|
        <a href="deleteUser.php">Remove User</a>
    </div>
</div>

<div class="span10 dashboardTables1 boxShadow">
    <table class="table">
        <tr>
            <th>User ID</th>
            <th>Name</th>
            <th>Username</th>
            <th>Email</th>
            <th>Permissions</th>
        </tr>
        <?php foreach($allUsers as $users){ ?>
            <tr>
                <td><?php echo $users['userID'];?></td>
                <td><?php echo $users['FName'] . " ". $users['LName'];?></td>
                <td><?php echo $users['userName'];?></td>
                <td><?php echo $users['email'];?></td>
                <td>Administrator</td>
                <td>View</td>

            </tr>
        <?php } ?>
    </table>
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

