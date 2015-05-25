<?php
/**
 * Created by PhpStorm.
 * User: greg
 * Date: 4/20/15
 * Time: 7:54 PM
 */
session_start();

include 'header.php';

$projectObject = new PROJECTS();

$userProjects = $projectObject->getAllProjects();

?>

<div class="dashboardID">
    <h2>Projects</h2>
</div>

<div class="span10 topBar">
    <div class="barBox bbleft span3 gradientColor-Gray boxShadow">
        <h3>Open Projects</h3>
        <p>4</p>
    </div>
    <div class="barBox bbcenter span3 gradientColor-Gray boxShadow">
        <h3>Closed Projects</h3>
        <p>4</p>
    </div>
    <div class="barBox bbright span3 gradientColor-Gray boxShadow">
        <h3>New Projects</h3>
        <p>4</p>
    </div>
</div>

<div class="flipPanel span10">
    <div id="flip"><p>Manage Projects</p></div>
    <div id="panel">
        <a href="addProject.php">Create New Project</a>|
        <a href="allTickets.php">View All tickets</a>
    </div>
</div>

<div class="span10 dashboardTables1 boxShadow">
    <table class="table">
        <thead>Projects</thead>
        <tr>
            <th>Project ID</th>
            <th>Project Name</th>
            <th>Project Manager</th>
            <th>Date</th>
            <?php foreach($userProjects as $project){ ?>
        <tr>
            <td><?php echo $project['projectID'];   ?></td>
            <td><?php echo $project['projectName'];  ?></td>
            <td><?php echo $project['FName']." ". $project['LName'];  ?></td>
            <td><?php echo $project['dateCreated'];    ?></td>
        </tr>
        <?php }?>
</div>


<?php include 'footer.php'; ?>

<script>
    $(document).ready(function(){
        $("#flip").click(function(){
            $("#panel").slideDown(500);
        });
    });
    $("#panel").click(function(){
        $("#panel").slideUp(300);

    });
</script>
