<?php
include "vendor/autoload.php";
include "includes/header.php";

use \RedBeanPHP\R as R;

// Database connection constants
define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASSWORD", "");
define("DB_NAME", "vodsite");

R::setup('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASSWORD);

if (isset($_POST['save'])) {

    //dispense bean and add attributes
    $item = R::dispense('user');
    $item->username = $_POST['username'];
    $item->password = $_POST['password'];
    R::store($item);

    $message = "Account created successfully. Log in <a href='login.php'>here</a>";

}

?>

<div class="container" style="margin-top: 65px">

    <div class="panel col-md-4 col-md-offset-4">
        <h3 style="text-align: center">Sign up for to our website</h3>
        <form action="register.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="file">Username</label>
                <input type="text" name="username" class="form-control"/>
            </div>
            <div class="form-group">
                <label for="title">Choose a password</label>
                <input type="password" id="title" name="password" class="form-control"/>
            </div>
            <button type="submit" name="save" class="pull-right">Sign Up</button>
        </form>
        <?php echo @$message; ?>
    </div>

</div>

</body>

</html>
