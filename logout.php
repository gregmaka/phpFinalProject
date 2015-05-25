<?php
error_reporting(E_ALL & ~E_NOTICE);

include 'classes/Users.php';
include 'classes/Issue.php';
include 'classes/FormatDate.php';
include 'classes/Comments.php';
include 'classes/PROJECTS.php';

$user = new User();
$userID = $_SESSION['userID'];
if ($_GET['q'] == 'logout')
{
    $user->user_logout();
    header("location:login.php");
}
?>
