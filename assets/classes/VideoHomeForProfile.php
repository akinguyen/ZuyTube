<?php
class VideoHomeForProfile
{
    private $recommend, $subList, $pdo, $username, $privacy;
    public function __construct($pdo, $username, $privacy)
    {
        $this->pdo = $pdo;
        $this->privacy = $privacy;
        $this->username = $username;
        if (isset($this->username) && $this->username !== "") {
            $this->subList = $pdo->prepare("SELECT toUser as user FROM subscribe WHERE fromUser=:username");
            $this->subList->execute(array(":username" => $username));
        }

    }

    public function getVideoListForProfile($username)
    {
        $privacy = $this->privacy === "1" ? "AND videos.privacy=0" : "";
        $query = $this->pdo->prepare("SELECT videos.id, thumbnails.imagePath, videos.uploadedBy, videos.title, videos.views, videos.duration, videos.uploadDate FROM videos INNER JOIN thumbnails ON thumbnails.videoId = videos.id AND videos.uploadedBy=:username $privacy ORDER BY RAND()");

        $query->execute(array(":username" => $username));
        foreach ($query as $video) {
            echo $this->createThumbnailForProfile($video);
        }
        echo "<div class='clearfix'></div>";
    }

    private function createThumbnailForProfile($row)
    {
        $imagePath = $row["imagePath"];
        $uploadedBy = $row["uploadedBy"];
        $view = $row["views"];
        $viewEnding = ($row["views"] === "0" || $row["views"] === "1") ? " view" : " views";
        $duration = $row["duration"];
        $tooltip = $row["title"];
        $title = (strlen($tooltip) > 16) ? substr($tooltip, 0, 16) . "..." : $tooltip;
        $id = $row["id"];
        $profile = "profile.php?username=" . $uploadedBy;
        return
            "
            <div class='responsive'>
                <div class='gallery'>
                <a style='text-decoration: none' data-toggle='tooltip' title='$tooltip'  href='../pages/watch.php?id=$id'>
                    <img src='$imagePath' alt='Thumbnail' width='600' height='400'>
                    <div class='time'><h6 style='font-size: 10px'>$duration</h6></div>
                </a>
                <div class='desc'>
                    <h6 class='title'>$title</h6>
                    <h6 style='font-size: 10px'>$view $viewEnding</h6>
                    <a href='$profile' style='font-size: 10px; margin-top: -5px;'>$uploadedBy</a>
                </div>
                </div>
            </div>

        ";
    }

}
