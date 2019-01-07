<?php
require "videoDetail.php";
require "../includes/config.php";
class VideoPlayerForm
{
    private $videoPlayer, $pdo, $currentUser;
    public function __construct($pdo, $videoPlayer, $currentUser)
    {
        $this->videoPlayer = $videoPlayer;
        $this->currentUser = $currentUser;
        $this->pdo = $pdo;
    }
    public function createVideoPlayerForm()
    {
        $video = $this->createVideoPlayer();
        $detail = $this->createVideoDetailForForm();
        echo
            "
            <div class='videoDetail'>
        <div class='videoPlayer'>
            $video
            $detail
        </div>
        </div>
        ";
    }
    private function createVideoDetailForForm()
    {
        $videoDetail = new videoDetail($this->videoPlayer->getUploadedBy(), $this->videoPlayer->getUploadedDate(), $this->videoPlayer->getDescription(), $this->videoPlayer->getCategory());
        $detail = $videoDetail->createVideoDetail();
        $videoId = $this->videoPlayer->getVideoId();
        $title = $this->videoPlayer->getTitle();
        $getView = $this->videoPlayer->getViews() + 1;
        $views = $getView === 1 ? $getView . " view" : $getView . " views";
        $like = $this->videoPlayer->getLikes();
        $dislike = $this->videoPlayer->getDisLikes();
        $subCount = $this->getSubCount();
        $commentSection = $this->createCommentSection($videoId, $this->currentUser);
        return "<div class='d-flex justify-content-between'>
        <div>
        <h4 style='width: 90%'>$title</h4>
        <h6>$views</h6>
        </div>
        <div>
                <button
                class='btn btn-success'
                type='button'
            >
                <span class='fas fa-thumbs-up like'>

                <span class='likeNumber badge badge-light ml-2'>
                $like
                </span>
            </button>
            <button
                type='button'
                class='btn btn-danger'
            >
                <span class='fas fa-thumbs-down dislike'>
                <span class='dislikeNumber badge badge-light ml-2'>$dislike</span>
            </button>
        </div>
        <div class='subscribe'>
           <button
                type='button'
                class='btn btn-danger'
            >
            $subCount
            </button>
        </div>
        <a href='../pages/editVideo.php?id=$videoId' class='editVideo'>
           <button
                type='button'
                class='btn btn-danger'
            >
            Edit
            </button>
        </a>
        </div>
        $detail
        $commentSection
        ";
    }
    private function createCommentSection($videoId, $currentUser)
    {
        $commentForm = CommentForm::createCommentForm($this->pdo, $videoId);
        $replyForm = CommentForm::createReplySection($this->pdo, $currentUser, $videoId);
        return "
        <div class='comment'>
            $commentForm
        <div class='reply'>
            $replyForm
        </div>
        </div>";
    }
    private function getSubCount()
    {
        $check = $this->pdo->prepare("SELECT COUNT(*) as total FROM subscribe WHERE toUser=:to");
        $check->execute(array(":to" => $this->videoPlayer->getUploadedBy()));
        $total = $check->fetch(PDO::FETCH_ASSOC);
        return !isset($total) ? "Subscriber 0" : "Subscriber " . $total["total"];
    }

    private function createVideoPlayer()
    {
        $videoPath = $this->videoPlayer->getVideoPath();
        $parts = parse_url($videoPath);
        $query = "";
        if (isset($parts["query"])) {
            parse_str($parts['query'], $query);
        }
        $videoId = $query !== "" ? $query["v"] : "";
        $url = "https://www.youtube.com/embed/$videoId";
        return
            "
            <iframe src=$url frameborder='0' allow='accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture' allowfullscreen></iframe>
        ";
    }

}
