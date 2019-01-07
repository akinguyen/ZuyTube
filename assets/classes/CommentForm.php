<?php
class CommentForm
{
    private $pdo, $commentObj;
    public function __construct($pdo, $commentObj)
    {
        $this->pdo = $pdo;
        $this->commentObj = $commentObj;
    }

    public static function getCommentCounts($pdo, $videoId)
    {
        $query = $pdo->prepare("SELECT COUNT(*) as total FROM comments WHERE videoId=:videoId");
        $query->execute(array(":videoId" => $videoId));
        $result = $query->fetch(PDO::FETCH_ASSOC);
        return $result["total"];
    }
    public static function insertComment($pdo, $commentInput, $username, $videoId)
    {
        $query = $pdo->prepare("INSERT INTO comments (videoId,username,comment,date) VALUES (:videoId, :username, :comment, :date)");
        $query->execute(array(":videoId" => $videoId, ":date" => date('Y-m-d H:i:s'), ":comment" => $commentInput, ":username" => $username));
        return CommentForm::getLastestComment($pdo, $pdo->lastInsertId());
    }
    public static function getLastestComment($pdo, $commentId)
    {
        $query = $pdo->prepare("SELECT id, comment, username, date FROM comments WHERE id=:id");
        $query->execute(array(":id" => $commentId));
        $result = $query->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
    public static function createCommentForm($pdo, $videoId)
    {
        $getComments = CommentForm::getCommentCounts($pdo, $videoId);
        $totalComments = $getComments === "0" || $getComments === "1" ? $getComments . " Comment" : $getComments . " Comments";
        return
            "<h6 class='totalComments'>$totalComments</h6>
        <textarea rows='5' id='comment' placeholder='Comment' class='form-control commentInput'></textarea>
        <button type='submit' class='postComment btn btn-success mt-2'><i class='fa fa-user-plus'></i> Post</button>
        <br>
        <div class='loadingComment' style='text-align: center'>
        <img height=100 src='https://media.giphy.com/media/3oEjI6SIIHBdRxXI40/giphy.gif'/>
        </div>
        ";
    }
    public static function createReplySection($pdo, $currentUser, $videoId)
    {
        $replyList = CommentForm::getReplyList($pdo, $videoId);
        $result = "";
        foreach ($replyList as $reply) {
            $result .= CommentForm::createEachReply($pdo, $currentUser, $reply);
        }
        return $result;
    }

    public static function getReplyList($pdo, $videoId)
    {
        $query = $pdo->prepare("SELECT * FROM comments WHERE videoId=:id ORDER BY date DESC");
        $query->execute(array(":id" => $videoId));
        return $query;
    }
    public static function userDidLikeRep($pdo, $currentUser, $commentId)
    {
        $check = $pdo->prepare("SELECT id FROM commentlikes WHERE username=:username AND commentId=:commentId");
        $check->execute(array(":username" => $currentUser, ":commentId" => $commentId));

        if ($check->fetch(PDO::FETCH_ASSOC)) {
            return "text-success";
        }
        return "text-secondary";
    }

    public static function userDidDislikeRep($pdo, $currentUser, $commentId)
    {
        $check = $pdo->prepare("SELECT id FROM commentdislikes WHERE username=:username AND commentId=:commentId");
        $check->execute(array(":username" => $currentUser, ":commentId" => $commentId));

        if ($check->fetch(PDO::FETCH_ASSOC)) {
            return "text-danger";
        }
        return "text-secondary";
    }

    public static function createEachReply($pdo, $currentUser, $reply)
    {
        $username = $reply["username"];
        $comment = $reply["comment"];
        $date = substr($reply["date"], 0, 11);
        $time = substr($reply["date"], 11);
        $commentId = $reply["id"];
        $likes = CommentForm::getReplyLikes($pdo, $commentId);
        $dislikes = CommentForm::getReplyDislikes($pdo, $commentId);
        $didLike = CommentForm::userDidLikeRep($pdo, $currentUser, $commentId);
        $didDisLike = CommentForm::userDidDislikeRep($pdo, $currentUser, $commentId);
        $deleteButton = $currentUser === $username ? "<div class='deleteReply float-right btn btn-danger' style='font-size: 12px'>x</div>" : "<div class='float-right btn btn-danger' style='visibility: hidden;' style='font-size: 12px'>x</div>";
        return
            "
            $deleteButton
        <div class='row'>
              <div class='col-4 col-md-3 col-lg-2 col-md-2'>
                <div class='mt-4 ml-4 mb-4 '>
                  <a href='/profile/id/5c14a69be9c94600161fa845'
                    ><img
                      src='https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcShci2i08psVXKRwGLnhzTe5T9KeyO1cv_zq0nNf0DZ7c5ME00hOQ'
                      alt='User'
                      class=' rounded-circle border border-dark d-inline'
                      style='width: 50px;'
                  /></a>
                  <h6 class='mt-2'>$username</h6>
                  <h6 style='font-size: 10px;'>D: $date</h6>
                  <h6 style='font-size: 10px;'>T: $time</h6>
                </div>
              </div>
              <div
                class='col-8 col-md-9 col-lg-10 pl-5 pt-4 pr-5 pb-4 pr-sm-5 pt-sm-4 pb-sm-4'
              >
                <div
                  class='card rounded border border-secondary p-sm-3'
                  style='background-color: rgb(245, 245, 245); height:100%'
                >
                  <p>$comment</p>
                </div>
              </div>
         <div style='padding-left:31px'>
            <div class='likeComment'>
                <div style='display: inline-block' class='fas fa-thumbs-up $didLike'></div>
                <div style='display: inline-block; font-size: 10px; margin-left: 5px; margin-right: 5px' class='likeCommentNumber'>
                $likes
                </div>
            </div>
            <input type='hidden' value='$commentId'/>
            <div class='dislikeComment'
            >
                <div style='display: inline-block' class='fas fa-thumbs-down $didDisLike'></div>
                <div style='display: inline-block; font-size: 10px; margin-left:4px;' class='dislikeCommentNumber '>$dislikes</div>
            </div>
            </div>
        </div>
        ";
    }
    public static function getReplyLikes($pdo, $commentId)
    {
        $query = $pdo->prepare("SELECT COUNT(*) as total FROM commentlikes WHERE commentId=:commentId");
        $query->execute(array(":commentId" => $commentId));
        return $query->fetch(PDO::FETCH_ASSOC)["total"];
    }
    public static function getReplyDislikes($pdo, $commentId)
    {
        $query = $pdo->prepare("SELECT COUNT(*) as total FROM commentdislikes WHERE commentId=:commentId");
        $query->execute(array(":commentId" => $commentId));
        return $query->fetch(PDO::FETCH_ASSOC)["total"];
    }
}
