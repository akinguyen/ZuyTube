<?php
require "../components/header.php";
require "../classes/VideoPlayer.php";
require "../classes/VideoPlayerForm.php";
require "../classes/ResultVideo.php";
?>
    <link rel="stylesheet"  href="../css/resultVideo.css">
    <div id="main">
        <div class="container">
            <?php
require "../components/filter.php";
$filter = isset($_GET["orderBy"]) ? $_GET["orderBy"] : "";
$searchQuery = isset($_GET["search_query"]) ? $_GET["search_query"] : "";
$resultVideo = new ResultVideo($pdo, $searchQuery, $filter);
$resultVideo->createResultVideo();
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