<?php
session_start();

include 'header.php';
?>

<div class="dashboardID">
    <h2>Tickets</h2>
</div>

<div class="span10 topBar">
    <div class="barBox span3">
        <h3>Open Tickets</h3>
        <p><?php echo $issueCount; ?></p>
    </div>
    <div class="barBox span3">
        <h3>Open Tickets</h3>
        <p><?php echo $issueCount; ?></p>
    </div>
    <div class="barBox span3">
        <h3>New Tickets</h3>
        <p><?php echo $newIssueCount; ?></p>
    </div>
</div>

<div class="flipPanel span10">
    <div id="flip"><p>Ticket Manager</p></div>
    <div id="panel">
        <a href="addIssue.php">Create Ticket</a>|
        <a href="allTickets.php">View All Tickets</a>
    </div>
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



