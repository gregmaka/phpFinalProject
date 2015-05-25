<?php
/**
 * Created by PhpStorm.
 * User: greg
 * Date: 4/20/15
 * Time: 7:54 PM
 */
session_start();

include 'header.php';

$issueObject = new Issue();

//initializing priority IDs
$critical = 1;
$high = 2;
$normal = 3;
//initializing status IDs
$newIssue = 0;
$openedIssue = 1;
$closedIssue = 2;

$allIssues = $issueObject->getIssues();


// Get issue counts  by priority
$criticalIssuesCount = $issueObject->getIssueCountByPriority($critical);
$highIssuesCount = $issueObject->getIssueCountByPriority($high);
$normalIssuesCount = $issueObject->getIssueCountByPriority($normal);

// Get issue counts by Status
$newIssueCount = $issueObject->getIssueCountByStatus($newIssue);

// Get a count of all issues
$allIssuesCount = $issueObject->getIssueCountAll();

if(isset($_POST['viewTicket'])){
    var_dump($_POST['viewTicket']);
}

?>

<div class="dashboardID">
    <h2>All Tickets</h2>
</div>

<div class="topBar span12">
    <div class="barBox bb5 span2 gradientColor-Gray boxShadow">
        <h3>Total</h3>
        <p><?php echo $allIssuesCount; ?></p>
    </div>
    <div class="barBox bb5 span2 gradientColor-Red boxShadow">
        <h3>Critical</h3>
        <p><?php echo $criticalIssuesCount; ?></p>
    </div>
    <div class="barBox bb5 span2 gradientColor-Yellow boxShadow">
        <h3>High</h3>
        <p><?php echo $highIssuesCount; ?></p>
    </div>
    <div class="barBox bb5 span2 gradientColor-Green boxShadow">
        <h3>Normal</h3>
        <p><?php echo $normalIssuesCount; ?></p>
    </div>
    <div class="barBox bb5 span2 gradientColor-Blue boxShadow">
        <h3>New</h3>
        <p><?php echo $newIssueCount; ?></p>
    </div>
</div>

    <div class="flipPanel span10">
        <div id="flip"><p>Manage Tickets</p></div>
        <div id="panel">
            <a href="addissue.php">Create New ticket</a>|
            <a href="allTickets.php">View All tickets</a>
        </div>
    </div>

<div class="span10 dashboardTables1 boxShadow">
    <table class="table">
        <tr>
            <th>Issue ID</th>
            <th>Priority</th>
            <th>Ticket name</th>
            <th>User</th>
            <th>Project</th>
            <th>Status</th>
            <th>Date</th>
            <th>Age</th>

        </tr>
<!--  loops through array of all the tickets and displays data-->
        <?php foreach($allIssues as $issue){ ?>
            <tr>
                <td><?php echo $issue['issueID'];   ?></td>
                <td><?php echo $issue['pType'];     ?></td>
                <td><?php echo $issue['issueName']; ?></td>
                <td><?php echo $issue['firstName']; ?></td>
                <td><?php echo $issue['projectName'];?></td>
                <td><?php echo $issue['status'];    ?></td>
                <td><?php echo date("m-d-y",strtotime($issue['dateTime']));?></td>
                <td><?php echo $days = date("z") - date("z",strtotime($issue['dateTime']));($days > 1)? $d = " Days" : $d = " Day"; echo $d?></td>
                <td><a href="viewTicket.php?issueID=<?php echo $issue['issueID']; ?>">View</a></td>
            </tr>
        <?php } ?>
    </table>
</div>
<?php include 'footer.php'; ?>

<!--javascript for menu dropdown-->
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
