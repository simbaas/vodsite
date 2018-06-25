<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en-gb" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Video Search</title>
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <script src="js/bootstrap.js"></script>
</head>

<body>

<!-- Fixed navbar -->
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                    aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">My VOD Site</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <li class="active"><a href="index.php">Home</a></li>
                <li><a href="upload.php">Upload</a></li>

                <?php
                if (isset($_SESSION['auth'])) {
                    ?>
                    <li><a href="logout.php">Log Out</a></li>
                    <?php
                } else {
                    ?>
                    <li><a href="register.php">Sign Up</a></li>
                    <li><a href="login.php">Log In</a></li>
                <?php } ?>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>

