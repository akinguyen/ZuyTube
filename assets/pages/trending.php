<?php
require "../components/header.php";
require "../classes/VideoPlayer.php";
require "../classes/VideoPlayerForm.php";
require "../classes/TrendingVideo.php";
?>
    <link rel="stylesheet"  href="../css/resultVideo.css">
    <div id="main">
        <div class="container">
            <h1 class="mb-5">Trending from the past 7 days</h1>
            <?php
$trendingVideo = new TrendingVideo($pdo);
$trendingVideo->createTrendingVideo();
?>
            </div>
    </div>
<div class='clearfix'></div>
<footer class="bg-dark text-white mt-5 p-4 text-center">
  Copyright @ 2019 ZuyTube
</footer>
<?php require "../components/loginModal.php"?>
</body>
</html>