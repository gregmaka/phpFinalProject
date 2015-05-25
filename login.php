<?php
session_start();
//error_reporting(E_ALL & ~E_NOTICE);

error_reporting(0); // turn off all

include 'classes/Users.php';

$user = new User();
if ($user->get_session())
{
    header("location:dashboard.php");
}

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $login = $user->check_login($_POST['email'], $_POST['password']);
    if ($login)
    {
// Login Success
        header("location:dashboard.php");
    }
    else
    {
// Login Failed
        echo $msg= 'Username / password wrong';
    }
}

?>
<!DOCTYPE html>
<title>Ticket Tracker</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="css/main.css">
<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src=”js/bootstrap.js”></script>
<script src=”js/main.js”></script>

</head>
<body>
<div class="LOGINcontainer">
    <div class="hero-unit gradientColor-GrayHero boxShadow herthis">
        <h1><img src="img/tixlogo.gif"> </h1>
        <form action="#" method="post" name="login">
            Username or Email:  <br>
            <input type="text" name="email" size="30">
            <br>
            Password:           <br>
            <input type="password" name="password" size="30">
            <br>
            <input class="btn-large btn-primary loginButton" type="submit" name="login" value="Login">
        </form>
    </div>
</div>
