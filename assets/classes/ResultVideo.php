<?php
class ResultVideo
{
    private $query, $pdo, $filter, $searchQuery, $viewQuery, $dateQuery;
    public function __construct($pdo, $searchQuery, $filter)
    {
        $this->pdo = $pdo;
        $this->filter = $filter;
        //Order Randomly
        $this->searchQuery = $searchQuery;
        $this->query = $pdo->query("SELECT videos.id, videos.uploadDate as date, thumbnails.imagePath, videos.uploadedBy, videos.title, videos.views, videos.duration FROM videos INNER JOIN thumbnails ON thumbnails.videoId = videos.id AND videos.title LIKE '%$searchQuery%' ORDER BY RAND() ");

    }
    public function createResultVideo()
    {
        $searchQuery = $this->searchQuery;
        if ($this->filter === "1") {
            //Order By View
            $viewQuery = $this->pdo->query("SELECT videos.id,  videos.uploadDate as date, thumbnails.imagePath, videos.uploadedBy, videos.title, videos.views, videos.duration FROM videos INNER JOIN thumbnails ON thumbnails.videoId = videos.id AND videos.title LIKE '%$searchQuery%' ORDER BY videos.views DESC");

            foreach ($viewQuery as $row) {
                echo $this->createThumbnail($row);
            }
        } else if ($this->filter === "2") {
            //Order by date
            $dateQuery = $this->pdo->query("SELECT videos.id, videos.uploadDate as date, thumbnails.imagePath, videos.uploadedBy, videos.title, videos.views, videos.duration FROM videos INNER JOIN thumbnails ON thumbnails.videoId = videos.id AND videos.title LIKE '%$searchQuery%' ORDER BY videos.uploadDate DESC");

            foreach ($dateQuery as $row) {
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
