<?php
class VideoProcessor
{
    private $pdo;
    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }
    public function getYoutubeData($url)
    {
        $parts = parse_url($url);
        $query = "";
        parse_str($parts['query'], $query);
        $videoId = $query["v"];
        $url = "https://morning-badlands-33048.herokuapp.com/$videoId";

        $json = file_get_contents($url);
        return json_decode($json);
    }
    private function isYoutubeURL($url)
    {
        return isset(parse_url($url)["path"]) && parse_url($url)["path"] === "/watch" && parse_url($url)["host"] === "www.youtube.com";
    }
    private function hasTitle($title)
    {
        return $title !== "";
    }
    private function insertVideo($videoData)
    {
        $youtubeData = $this->getYoutubeData($videoData->videoPath);
        if ($youtubeData) {
            $query = $this->pdo->prepare("INSERT INTO videos (uploadedBy,	title, description,	privacy,videoPath,category,	uploadDate,views,	duration) VALUES (:uploadedBy,:title, :description, :privacy,	:videoPath,	:category, :date, :views,:duration)");

            $query->execute(array(":uploadedBy" => $videoData->uploadedBy, ":title" => $videoData->title, ":description" => $videoData->description, ":privacy" => $videoData->private, ":videoPath" => $videoData->videoPath, ":category" => $videoData->category, ":date" => date('Y-m-d H:i:s'), ":views" => 0, ":duration" => $youtubeData->videoDuration));

            $videoId = $this->pdo->lastInsertId();
            $this->insertThumbnail($videoId, $youtubeData->videoImg);
            return true;
        }
        return false;

    }

    private function insertThumbnail($videoId, $imagePath)
    {
        $query = $this->pdo->prepare("INSERT INTO thumbnails (videoId, imagePath) VALUES (:videoId, :imagePath)");

        $query->execute(array(":videoId" => $videoId, ":imagePath" => $imagePath));
    }

    public function uploadVideoData($videoData)
    {
        if (!$this->isYoutubeURL($videoData->videoPath)) {
            return false;
        }
        if (!$this->hasTitle($videoData->title)) {
            return false;
        }
        if (!$this->insertVideo($videoData)) {
            return false;
        }
        return true;
    }
}
