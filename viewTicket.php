<?php
session_start();
error_reporting(0); // turn off all
include 'header.php';

$issueID = $_GET['issueID'];

$viewIssue = new Issue();

$issueInfo = $viewIssue->getSingleIssue($issueID);

$commentObj = new Comments();

if(isset($_POST['submit'])) {

    $commentObj->getCommentInfo($_POST['commentBody'],$_GET['issueID'],$_SESSION['userID']);
    $commentObj->createComment();
    $viewIssue->updateIssue(1,$issueID);
}
if(isset($_POST['closeTicketForm'])) {

    $viewIssue->updateIssue(2,$issueID);


}

$allComments = $commentObj->getComments($_GET['issueID']);

?>

<div class="ticketName boxShadow-SmokeWhite span10">
    <h3><?php echo $issueInfo['0']['issueName']; ?></h3><br>
</div>

<div class="ticketBody span10">
    <p><?php echo $issueInfo['0']['issueBody']; ?></p>
</div>


<?php foreach($allComments as $comment){ ?>

    <?php echo '<div class="commentBox span10">';?>
    <?php echo $comment['message']; ?>
    <?php echo '</div>'; ?>

<?php } ?>

<div class="span4 commentForm">
    <form action="#" method="post" id="commentForm">
        NAME: <?php echo $_SESSION['FName'];?> <br>
        Comment:<br />
        <textarea rows="6" cols="700"name="commentBody" id="textField" form="commentForm"></textarea><br><br>
    </form>
    <button class="btn-large submitButton" name="submit" form="commentForm"> Post Comment</button><br>
</div>
<div class="span4 issueInfoBox boxShadow-SmokeWhite">
    <p>Issued to : <?php echo $issueInfo['0']['FName']." ".$issueInfo['0']['LName'];?></p>
    <p>Priority : <?php echo $issueInfo['0']['pType'] ?> </p>
    <p>Status : <?php echo $issueInfo['0']['status'] ?> </p>
    <div class="span4">
        <form action="#" method="post" id="closeTicketForm">
        </form>
        <button class="btn-large submitButton" name="closeTicketForm" form="closeTicketForm"> Close Ticket</button><br>

    </div>


