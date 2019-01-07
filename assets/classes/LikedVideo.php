<?php
class LikedVideo
{
    private $query, $pdo, $filter, $username;
    public function __construct($pdo, $username, $filter)
    {
        $this->pdo = $pdo;
        $this->filter = $filter;
        $this->username = $username;
        $this->query = $pdo->prepare("SELECT v.id, v.date, v.imagePath,v.uploadedBy,v.title,v.views,v.duration FROM (SELECT videos.id, videos.uploadDate as date, thumbnails.imagePath, videos.uploadedBy, videos.title, videos.views, videos.duration FROM videos INNER JOIN thumbnails ON thumbnails.videoId = videos.id) as v INNER JOIN (SELECT * FROM likes WHERE likes.username=:username) as l ON l.videoId=v.id");
        $this->query->execute(array(":username" => $username));

    }
    public function createLikedVideo()
    {
        if ($this->filter === "1") {
            //Order By View
            $query = $this->pdo->prepare("SELECT v.id, v.date, v.imagePath,v.uploadedBy,v.title,v.views,v.duration FROM (SELECT videos.id, videos.uploadDate as date, thumbnails.imagePath, videos.uploadedBy, videos.title, videos.views, videos.duration FROM videos INNER JOIN thumbnails ON thumbnails.videoId = videos.id) as v INNER JOIN (SELECT * FROM likes WHERE likes.username=:username) as l ON l.videoId=v.id ORDER BY views DESC");
            $query->execute(array(":username" => $this->username));

            foreach ($query as $row) {
                echo $this->createThumbnail($row);
            }
        } else if ($this->filter === "2") {
            //Order by date
            $query = $this->pdo->prepare("SELECT v.id, v.date, v.imagePath,v.uploadedBy,v.title,v.views,v.duration FROM (SELECT videos.id, videos.uploadDate as date, thumbnails.imagePath, videos.uploadedBy, videos.title, videos.views, videos.duration FROM videos INNER JOIN thumbnails ON thumbnails.videoId = videos.id) as v INNER JOIN (SELECT * FROM likes WHERE likes.username=:username) as l ON l.videoId=v.id ORDER BY date DESC");
            $query->execute(array(":username" => $this->username));

            foreach ($query as $row) {
                echo $this->createThumbnail($row);
            }
        } else {
            foreach ($this->query as $row) {
                echo $this->createThumbnail($row);
            }
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
        $date = substr($row["date"], 0, 11);
        $time = substr($row["date"], 11);
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
                <div class='time'><h6 style='font-size: 13px'>$duration</h6></div>
            </a>
            <div class='thumbnailDetail'>
                <div style='font-weight: bold'>$title</div>
                <a href='$profile'>$uploadedBy</a>
                <div>$view $viewEnding</div>
                <div>Date: $date</div>
                <div>Time: $time</div>
            </div>

        </div>
        ";
    }
}
