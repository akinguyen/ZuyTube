<?php
require "../components/header.php";
require "../classes/VideoPlayer.php";
require "../classes/VideoPlayerForm.php";
require "../classes/VideoSide.php";
require "../classes/CommentForm.php";
?>
    <link rel="stylesheet"  href="../css/videoPlayer.css">
    <div id="main">
        <div class="container">
        <?php
if (isset($_GET["id"])) {
    $videoPlayer = new VideoPlayer($pdo, $_GET["id"]);
    $videoPlayerForm = new VideoPlayerForm($pdo, $videoPlayer, isset($_SESSION["email"]) ? $user->getUserName() : "");
    $videoPlayerForm->createVideoPlayerForm();

} else {
    header("Location: ../../index.php");
}
?>
        <div class="videoSide">
            <input type="hidden" class="toUser" value='<?=$videoPlayer->getUploadedBy()?>'>
            <input class="videoIdValue" type="hidden" value=<?=$_GET["id"]?>>
            <input class="unameValue" type="hidden" value='<?=isset($_SESSION["email"]) ? $user->getUserName() : ""?>'>
            <input class="isSubValue" type="hidden" value=<?=isset($_SESSION["email"]) ? $user->userDidSub($user->getUserName(), $videoPlayer->getUploadedBy()) ? "1" : "0" : ""?>>
            <input class="isLikeValue" type="hidden" value=<?=isset($_SESSION["email"]) ? $user->userDidLike($_GET["id"]) ? "1" : "0" : ""?>>
            <input class="isDislikeValue" type="hidden" value=<?=isset($_SESSION["email"]) ? $user->userDidDislike($_GET["id"]) ? "1" : "0" : ""?>>
            <?php
$videoSide = new VideoSide($pdo);
$videoSide->createVideoSide();
?>
        </div>

<div>

</div>

            </div>
    </div>
    <script src="../js/likeFunction.js"></script>
    <script src="../js/postComment.js"></script>
<?php require "../components/loginModal.php"?>
<div class='clearfix'></div>
<footer class="bg-dark text-white mt-5 p-4 text-center">
  Copyright @ 2019 ZuyTube
</footer>
</body>
</html>
