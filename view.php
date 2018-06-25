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

if (isset($_REQUEST['submit'])) {

    $video = R::load('video', $_REQUEST['vid']);

    $comment = R::dispense('comments');

    $comment->comment = $_REQUEST['comment'];
    $comment->user = $_SESSION['auth'];

    $video->ownCommentsList[] = $comment;

    R::store($video);
}

$video = R::load('video', $_REQUEST['vid']);
?>
<div class="container" style="margin-top: 65px">

    <div class="search-container pull-right" style="margin-bottom: 15px">
        <form action="search.php">
            <input type="text" placeholder="Search.." name="keywords">
            <button type="submit">Submit</button>
        </form>
    </div>

    <div class="col-md-12">
        <div class="col-md-8 thumbnail">
            <video class="" width="100%" height="auto" poster="<?php echo $video->thumbnail ?>" controls>
                <source src="<?php echo $video->video ?>"
                        type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>

        <div class="col-md-4">
            <div>
                <h5>(<?php echo count($video->ownComments); ?>) Comments</h5>
                <form method="post" action="view.php">
                    <div class="form-group">
                        <textarea name="comment" class="form-control">Type comment here....</textarea>
                        <input type="hidden" value="<?php echo $video->id ?>" name="vid">
                        <?php
                        if (isset($_SESSION['auth'])) {
                            ?>
                            <input type="submit" name="submit" class="btn btn-default pull-right" value="Submit"/>
                        <?php } else {
                            echo "<span class='pull-right'><a href='login.php'>Log in</a> to comment</span>";
                        }
                        ?>
                    </div>
                </form>
            </div>
            <div style="margin-top: 55px">
                <ul class="list-group">
                    <?php
                    foreach ($video->ownCommentsList as $comment) {
                        ?>
                        <li class="list-group-item">
                            <?php
                            $user = R::load('user', $comment->user);
                            echo $comment->comment;
                            echo '<em style="font-size: 10pt"> - ' . $user->username . '</em>'
                            ?>
                        </li>
                        <?php
                    }
                    ?>
                </ul>
            </div>
        </div>

    </div>
</div>

</body>

</html>