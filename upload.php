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
    $item = R::dispense('video');

    $error = FALSE;
    $stamp = time();
    $uploaddir = 'content/';

    $uploadfile = $uploaddir . '-' . $stamp . basename($_FILES['thumbnail']['name']);
    if (move_uploaded_file($_FILES['thumbnail']['tmp_name'], $uploadfile)) {
        $baseimage = $uploadfile;
    } else {
        $baseimage = "content/placeholder.png";
    }

    $uploadvid = $uploaddir . '-' . $stamp . basename($_FILES['file']['name']);
    if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadvid)) {
        $video = $uploadvid;
    } else {
        $video = "";
    }

    $item->title = $_POST['title'];
    $item->thumbnail = $baseimage;
    $item->video = $video;

    R::store($item);

    $message = "Video is saved";

}

?>

<div class="container" style="margin-top: 65px">

    <div class="panel col-md-4 col-md-offset-4">
        <form action="upload.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="file">Select Video to Upload</label>
                <input type="file" id="file" name="file" class="form-control"/>
            </div>
            <div class="form-group">
                <label for="thumbnail">Select Picture Thumbnail</label>
                <input type="file" id="thumbnail" name="thumbnail" class="form-control"/>
            </div>
            <div class="form-group">
                <label for="title">Video Title</label>
                <input type="text" id="title" name="title" class="form-control"/>
            </div>
            <button type="submit" name="save" class="pull-right">Save Video</button>
        </form>
        <?php echo @$message; ?>
    </div>

</div>

</body>

</html>
