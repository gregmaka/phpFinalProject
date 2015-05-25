<?php
session_start();
include 'header.php';

$userIssueObject = new Issue();

$userID = $_SESSION['userID'];
$userName = $_SESSION['FName'];

$userIssues = $userIssueObject->getUserIssues($userID);
$issueCount = $userIssueObject->getIssueCount($userID);
$newIssueCount = $userIssueObject->getNewIssueCount($userID);

$projectObject= new PROJECTS();
$userProjects = $projectObject->getProjectsByUser($_SESSION['userID']);


?>
<div class="dashboardID">
    <h2><?php echo $userName ?>'s Dashboard</h2>
</div>


<div class="span10 topBar">
    <div class="barBox bbleft span3 gradientColor-Gray boxShadow">
        <h3>Open Projects</h3>
        <p>4</p>
    </div>
    <div class="barBox bbcenter span3 gradientColor-Gray boxShadow">
        <h3>Open Tickets</h3>
        <p><?php echo $issueCount; ?></p>
    </div>
    <div class="barBox bbright span3 gradientColor-Gray boxShadow">
        <h3>New Tickets</h3>
        <p><?php echo $newIssueCount; ?></p>
    </div>
</div>

    <div class="flipPanel span10">
        <div id="flip"><p>Manager</p></div>
        <div id="panel">
            <a href="users.php">Manage Users</a>|
            <a href="allTickets.php">Tickets</a>|
            <a href="projects.php">Manage Projects</a>
        </div>
    </div>

<div class="dashboardTablesProjects boxShadow span10">
    <h3>Current Projects</h3>
    <table class="table">
        <th>Project ID</th>
        <th>Project Name</th>
        <th>Date</th>
        <?php foreach($userProjects as $project){ ?>
            <tr>
                <td><?php echo $project['projectID'];   ?></td>
                <td><?php echo $project['projectName'];  ?></td>
                <td><?php echo $project['dateCreated'];    ?></td>
            </tr>
        <?php }?>
    </table>
</div>
<div class="dashboardTables boxShadow span10" ">
    <h3>Current Tickets </h3>
    <table class="table">
        <th>Ticket ID</th>
        <th>Priority</th>
        <th>Ticket Name</th>
        <th>Status</th>
        <th>Date Opened</th>
        <th>+</th>
        <?php foreach($userIssues as $issue){ ?>
            <tr>
                <td><?php echo $issue['issueID'];   ?></td>
                <td><?php echo $issue['pType'];  ?></td>
                <td><?php echo $issue['issueName']; ?></td>
                <td><?php echo $issue['status'];    ?></td>
                <td><?php echo $issue['dateTime'];  ?></td>
                <td><a href="viewTicket.php?issueID=<?php echo $issue['issueID']; ?>">View</a></td>
            </tr>
        <?php }?>
    </table>

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



