<?php
class Comment
{
    private $videoId, $comment, $username, $date;
    public function __construct($videoId, $comment, $username, $date)
    {
        $this->videoId = $videoId;
        $this->comment = $comment;
        $this->username = $username;
        $this->date = $date;

    }

    public function getVideoId()
    {
        return $this->videoId;
    }
    public function getComment()
    {
        return $this->comment;
    }
    public function getUserName()
    {
        return $this->username;
    }
    public function getDate()
    {
        return $this->date;
    }
}
