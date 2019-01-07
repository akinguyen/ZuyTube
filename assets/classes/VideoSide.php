<?php
class VideoSide
{
    private $query, $pdo;
    public function __construct($pdo)
    {
        $this->pdo = $pdo;
        $this->query = $pdo->query("SELECT videos.id, thumbnails.imagePath, videos.uploadedBy, videos.title, videos.views, videos.duration FROM videos INNER JOIN thumbnails ON thumbnails.videoId = videos.id AND videos.privacy=0 ORDER BY RAND() LIMIT 15");

    }
    public function createVideoSide()
    {
        echo "<h1 class='suggested'>Suggested</h1>";
        foreach ($this->query as $row) {
            echo $this->createThumbnail($row);
        }
    }
    private function createThumbnail($row)
    {
        $imagePath = $row["imagePath"];
        $uploadedBy = $row["uploadedBy"];
        $view = $row["views"];
        $viewEnding = ($row["views"] === "0" || $row["views"] === "1") ? " view" : " views";
        $duration = $row["duration"];
        $title = $row["title"];
        $profile = "profile.php?username=" . $uploadedBy;
        $id = $row["id"];
        return
            "
        <div class='thumbnailBox d-flex flex-row'>
            <a href='watch.php?id=$id'>
                <img class='thumbnail'
                src='$imagePath'
                alt='thumbnail'
                >
            </a>
            <div class='thumbnailDetail'>
                <div style='font-weight: bold'>$title</div>
                <a href='$profile'>$uploadedBy</a>
                <div>$view $viewEnding</div>
                <div>Duration: $duration</div>
            </div>

        </div>
        ";
    }
}
