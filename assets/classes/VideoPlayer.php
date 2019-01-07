<?
class VideoPlayer
{
    private $videoId, $videoInfo, $pdo, $like, $dislike;
    public function __construct($pdo, $videoId)
    {
        $this->pdo = $pdo;
        $this->videoId = $videoId;
        $query = $pdo->prepare("SELECT * FROM videos WHERE id=:videoId");
        $query->execute(array(":videoId" => $videoId));
        $this->videoInfo = $query->fetch(PDO::FETCH_ASSOC);

        $likeTotal = $pdo->prepare("SELECT COUNT(*) as likeTotal FROM likes WHERE videoId=:videoId");
        $dislikeTotal = $pdo->prepare("SELECT COUNT(*) as dislikeTotal FROM dislikes WHERE videoId=:videoId");
        $likeTotal->execute(array(":videoId" => $videoId));
        $dislikeTotal->execute(array(":videoId" => $videoId));

        $likeResult = $likeTotal->fetch(PDO::FETCH_ASSOC)["likeTotal"];
        $this->like = isset($likeResult) ? $likeResult : "0";
        $dislikeResult = $dislikeTotal->fetch(PDO::FETCH_ASSOC)["dislikeTotal"];
        $this->dislike = isset($dislikeResult) ? $dislikeResult : "0";

    }
    public function getLikes()
    {
        return $this->like;
    }
    public function getDisLikes()
    {
        return $this->dislike;
    }
    public function getVideoId()
    {
        return $this->videoInfo["id"];
    }
    public function getTitle()
    {
        return $this->videoInfo["title"];
    }
    public function getDescription()
    {
        return $this->videoInfo["description"];
    }
    public function getCategory()
    {
        $query = $this->pdo->prepare("SELECT name FROM categories WHERE id=:id");
        $query->execute(array(":id" => $this->videoInfo["category"]));
        return $query->fetch(PDO::FETCH_ASSOC)["name"];
    }
    public function getViews()
    {
        $query = $this->pdo->prepare("UPDATE videos SET views=views + 1 WHERE id=:videoId");
        $query->execute(array(":videoId" => $this->videoId));
        return $this->videoInfo["views"];
    }
    public function getUploadedBy()
    {
        return $this->videoInfo["uploadedBy"];
    }
    public function getDuration()
    {
        return $this->videoInfo["duration"];
    }
    public function getPrivacy()
    {
        return $this->videoInfo["privacy"];
    }
    public function getVideoPath()
    {
        return $this->videoInfo["videoPath"];
    }
    public function getUploadedDate()
    {
        return $this->videoInfo["uploadDate"];
    }
}
