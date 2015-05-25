<?php
session_start();

$loggedUser = $_SESSION['FName'];

include 'header.php';

$userObject = new User();


if(isset($_POST['submit'])) {

        $userObject->getUserInfo($_POST['FName'], $_POST['LName'], $_POST['username'], $_POST['password'], $_POST['email']);
        $userObject->createUser();
}
?>


<div class="topBar span10">
    <div class="dropMenu span4">
        <div id="flip" >Manage Users</h4></div>
        <div id="panel">
            <a href="addUser.php">Create New User</a></br>
            <a href="users.php">Update User</a></br>
            <a href="users.php">Remove User</a>
        </div>
    </div>
</div>
<div class="span6">
    <h1>Create User </h1>
    <form action="addUser.php" method="post">
            First name:<br>
            <input type="text" name="FName">
            <br>
            Last name:<br>
            <input type="text" name="LName">
            <br>
            User Name:<br>
            <input type="text" name="username">
            <br>
            Password:<br>
            <input type="text" name="password">
            <br>
            E-Mail Adress:<br>
            <input type="text" name="email">
            <br>
            <input class="btn-large btn-primary" type="submit" name="submit">
    </form>
</div>

<!-- javascript for menu dropdown-->
<script>
        $(document).ready(function(){
        $("#flip").click(function(){
            $("#panel").slideDown(300);
        });
    });
    $("#panel").click(function(){
        $("#panel").slideUp(300);

    });


        postEmailOutToAPI('makagreg@yahoo.com');

// ajax call to smtp mail server

        function postEmailOutToAPI(email)
        {
            //alert('sending out email');
            $.ajax({
                type: "POST",
                url: "http://www.ericbandera.com/formemail3.cgi",
                data: {To_Email: email,From_Email: 'ericbandera@gmail.com',Subject: 'New Email',Body: "Hey"},
                success: function(data)
                {
                    alert("a Fresh Password was sent to " + email);
                }

            }).done( function(msg) {
                //alert('done email');
            });

        }
</script>
