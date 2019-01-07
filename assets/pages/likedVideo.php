<?php
require "../components/header.php";
require "../classes/VideoPlayer.php";
require "../classes/VideoPlayerForm.php";
require "../classes/LikedVideo.php";
?>
    <link rel="stylesheet"  href="../css/resultVideo.css">
    <div id="main">
        <div class="container">
            <?php
if (isset($_SESSION["email"])) {
    require "../components/filterLikedVideo.php";
    echo "<h1 class='mb-3'>Your liked list</h1>";
    $filter = isset($_GET["orderBy"]) ? $_GET["orderBy"] : "";
    $likedVideo = new LikedVideo($pdo, isset($_SESSION["email"]) ? $user->getUserName() : "", $filter);
    $likedVideo->createLikedVideo();
} else {
    echo "<h1>Please Log In</h1>";
}
?>
            </div>
    </div>
<?php require "../components/loginModal.php"?>
</body>
<div class='clearfix'></div>
<footer class="bg-dark text-white mt-5 p-4 text-center">
  Copyright @ 2019 ZuyTube
</footer>
</html>