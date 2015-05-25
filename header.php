<?php
error_reporting(0); // turn off all
include 'logout.php';

$user = new User();
$issues = new Issue();
$formatDate = new FormatDate();
$commentObject = new Comments();

$userID = $_SESSION['userID'];
if (!$user->get_session())
{
    header("location:login.php");
}

?>
<!DOCTYPE html>
<html>
<title>Ticket Tracker</title>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" type="text/css" href="css/main.css">
<link rel="stylesheet" type="text/css" media="only screen and (max-device-width: 600px)" href="mobile.css" />
<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src=”js/bootstrap.js”></script>
<script src=”js/main.js”></script>

</head>
<body>
<div class="container">
    <div class="navbar">
        <div class="navbar-inner gradientColor-Gray boxShadow">
            <div class="container span10">
                <div class="logo">
                    <li><a href="index.php"><img src="img/tixlogo.gif"></a></li>
                </div>
                <div class="nav">
                    <ul class="nav">
                        <li><a href="allTickets.php">Tickets</a></li>
                        <li><a href="users.php">Users</a></li>
                        <li><a href="projects.php">Projects</a> </li>
                    </ul>
                </div>
            </div>
            <ul class="nav2">
                <li>Hello!  <?php echo $user->getName($userID); ?></li>
                <li><a href="?q=logout">LOGOUT</a></li>
            </ul>
        </div>
    </div>
    <div class="hero-unit gradientColor-GrayHero boxShadow">