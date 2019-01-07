<?php
require "../components/header.php";
require "../classes/VideoData.php";
require "../classes/EditVideoProcessor.php";

?>
    <div id="main">
        <div class="container">
        <h2 class="mb-4">Update Video Status</h2>
        <?php
if ($_SERVER["REQUEST_METHOD"] === "GET" && empty(array_filter($_GET))) {
    echo "<h6>No Information Sent</h6>";
} else if (isset($_GET["success"])) {
    echo "<h6>Update Successful</h6>";
    return;
} else if (isset($_GET["fail"])) {
    echo "<h6>Update Failed, please check the required input</h6>";
    return;
} else {
    if (isset($_POST["youtube"]) && $_POST["youtube"] === "") {
        echo "<h6>Please check the youtube input</h6>";
        return;
    }
    if (isset($_POST["title"]) && strlen($_POST["title"]) > 90) {
        echo "<h6>The title has to be between 1 and 90 characters</h6>";
        return;
    }
    if (isset($_SESSION["email"])) {
        $videoData = new VideoData($_POST["youtube"], $_POST["title"], $_POST["description"], $_POST["private"], $_POST["category"],
            $user->getUserName());

        $editVideoProcessor = new EditVideoProcessor($pdo, isset($_POST["id"]) ? $_POST["id"] : "");

        $isSuccessful = $editVideoProcessor->updateVideoData($videoData);
        if ($isSuccessful) {
            header("Location: editProcessing.php?success=1");
        } else {
            header("Location: editProcessing.php?fail=1");
        }

    }
}

//$youtubeData = $videoProcessor->getYoutubeData($videoData->videoPath);
?>
        </div>
    </div>
</div>
<footer class="bg-dark text-white mt-5 p-4 text-center">
  Copyright @ 2019 ZuyTube
</footer>
</body>
</html>
