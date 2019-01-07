<?php
class VideoHome
{
    private $recommend, $subList, $pdo, $username;
    public function __construct($pdo, $username)
    {
        $this->pdo = $pdo;
        $this->username = $username;
        $this->recommend = $pdo->query("SELECT videos.id, thumbnails.imagePath, videos.uploadedBy, videos.title, videos.views, videos.duration, videos.uploadDate FROM videos INNER JOIN thumbnails ON thumbnails.videoId = videos.id AND videos.privacy=0 ORDER BY RAND() LIMIT 9");
        if (isset($this->username) && $this->username !== "") {
            $this->subList = $pdo->prepare("SELECT toUser as user FROM subscribe WHERE fromUser=:username");
            $this->subList->execute(array(":username" => $username));
        }

    }
    public function createVideoHome()
    {
        $this->createRecommend();
        if (isset($this->username) && $this->username !== "") {
            $this->createSub();
        }
    }
    public function createRecommend()
    {

        echo "<h2 class='mb-4'>Recommended</h2>";
        foreach ($this->recommend as $row) {
            echo $this->createThumbnail($row);
        }
    }
    public function createSub()
    {
        foreach ($this->subList as $sub) {
            $user = $sub["user"];
            echo "<div class='clearfix'></div>
            <h2 class='mt-4 mb-4'>$user</h2>";
            $videoList = $this->getVideoListFromUser($user);
            foreach ($videoList as $video) {
                echo $this->createThumbnail($video);
            }

        }
    }

    private function getVideoListFromUser($username)
    {
        $query = $this->pdo->prepare("SELECT videos.id, thumbnails.imagePath, videos.uploadedBy, videos.title, videos.views, videos.duration, videos.uploadDate FROM videos INNER JOIN thumbnails ON thumbnails.videoId = videos.id AND videos.uploadedBy=:username AND videos.privacy=0 ORDER BY RAND() LIMIT 18");

        $query->execute(array(":username" => $username));
        return $query;

    }

    private function createThumbnail($row)
    {
        $imagePath = $row["imagePath"];
        $uploadedBy = $row["uploadedBy"];
        $view = $row["views"];
        $viewEnding = ($row["views"] === "0" || $row["views"] === "1") ? " view" : " views";
        $duration = $row["duration"];
        $tooltip = $row["title"];
        $title = (strlen($tooltip) > 19) ? substr($tooltip, 0, 19) . "..." : $tooltip;
        $id = $row["id"];
        $profile = "assets/pages/profile.php?username=" . $uploadedBy;
        return
            "
            <div class='responsive'>
                <div class='gallery'>
                <a style='text-decoration: none' data-toggle='tooltip' title='$tooltip'  href='assets/pages/watch.php?id=$id'>
                    <img src='$imagePath' alt='Thumbnail' width='600' height='400'>
                    <div class='time'><h6 style='font-size: 10px'>$duration</h6></div>
                </a>
                <div class='desc'>
                    <h6 class='title'>$title</h6>
                    <h6 style='font-size: 10px'>$view $viewEnding</h6>
                    <a href='$profile' style='font-size: 10px'>$uploadedBy</a>
                </div>
                </div>
            </div>

        ";
    }
}
