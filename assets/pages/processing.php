<?php
require "../components/header.php";
require "../classes/VideoData.php";
require "../classes/VideoProcessor.php";

?>
    <div id="main">
        <div class="container">
        <h2 class="mb-4">Upload Video Status</h2>

        <?php
if ($_SERVER["REQUEST_METHOD"] === "GET" && empty(array_filter($_GET))) {
    echo "<h6>No Information Sent</h6>";
} else if (isset($_GET["success"])) {
    echo "<h6>Upload Successful</h6>";
} else if (isset($_GET["fail"])) {
    echo "<h6>Upload Failed, please check the required input</h6>";
} else {
    if (isset($_POST["youtube"]) && $_POST["youtube"] === "") {
        echo "<h6>Please check the youtube input</h6>";
        return;
    }
    if (isset($_POST["title"]) && $_POST["title"] === "") {
        echo "<h6>Please check the title input</h6>";
        return;
    }
    if (isset($_SESSION["email"])) {
        $videoData = new VideoData($_POST["youtube"], $_POST["title"], $_POST["description"], $_POST["private"], $_POST["category"],
            $user->getUserName());

        $videoProcessor = new VideoProcessor($pdo);

        $isSuccessful = $videoProcessor->uploadVideoData($videoData);
        if ($isSuccessful) {
            header("Location: processing.php?success=1");
        } else {
            header("Location: processing.php?fail=1");
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
