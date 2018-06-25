<?php
session_start();
include "vendor/autoload.php";

use \RedBeanPHP\R as R;

// Database connection constants
define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASSWORD", "");
define("DB_NAME", "vodsite");

R::setup('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASSWORD);

if (isset($_POST['save'])) {

//dispense bean and add attributes
    $item = R::findOne('user', 'WHERE username = ? AND password = ?', [$_REQUEST['username'], $_REQUEST['password']]);

    if ($item == null) {
        $message = "<span style='color: red'>Invalid log in details</span>";
    } else {
        $_SESSION['auth'] = $item->id;
        header('Location: index.php');
    }

}

include "includes/header.php";

?>

<div class="container" style="margin-top: 65px">

    <div class="panel col-md-4 col-md-offset-4">
        <h3 style="text-align: center">Log in to our website</h3>
        <form action="login.php" method="post" enctype="multipart/form-data">
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
