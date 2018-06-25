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

?>
<div class="container" style="margin-top: 65px">

    <div class="search-container pull-right" style="margin-bottom: 15px">
        <form action="search.php">
            <input type="text" placeholder="Search.." name="keywords">
            <button type="submit">Submit</button>
        </form>
    </div>

    <div class="col-md-12">
        <?php
        $videos = R::findAll('video');

        foreach ($videos as $video) {
            ?>

            <div class="col-md-4 thumbnail">
                <video class="" width="100%" height="220" poster="<?php echo $video->thumbnail ?>" controls>
                    <source src="<?php echo $video->video ?>"
                            type="video/mp4">
                    Your browser does not support the video tag.
                </video>
                <div>
                    <strong><h4 class="col-md-6"><a
                                    href="view.php?vid=<?php echo $video->id ?>"><?php echo ucwords($video->title) ?></a>
                        </h4></strong>
                    <a href="<?php echo $video->video ?>" download class="btn btn-success pull-right">Download</a>
                </div>
            </div>

            <?php
        }
        ?>
    </div>
</div>

</body>

</html>