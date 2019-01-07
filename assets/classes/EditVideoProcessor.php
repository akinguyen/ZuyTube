<?php
class EditVideoProcessor
{
    private $pdo, $videoId;
    public function __construct($pdo, $videoId)
    {
        $this->pdo = $pdo;
        $this->videoId = $videoId;
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
    private function updateVideo($videoData)
    {
        $youtubeData = $this->getYoutubeData($videoData->videoPath);
        $id = $this->videoId;
        if ($youtubeData) {
            $query = $this->pdo->prepare("UPDATE videos SET uploadedBy=:uploadedBy,title=:title, description=:description,privacy=:privacy,videoPath=:videoPath,category=:category,	uploadDate=:date,duration=:duration WHERE id=$id");

            $query->execute(array(":uploadedBy" => $videoData->uploadedBy, ":title" => $videoData->title, ":description" => $videoData->description, ":privacy" => $videoData->private, ":videoPath" => $videoData->videoPath, ":category" => $videoData->category, ":date" => date('Y-m-d H:i:s'), ":duration" => $youtubeData->videoDuration));
            $this->updateThumbnail($this->videoId, $youtubeData->videoImg);
            return true;
        }
        return false;

    }

    private function updateThumbnail($videoId, $imagePath)
    {
        $query = $this->pdo->prepare("UPDATE thumbnails SET imagePath=:imagePath WHERE videoId=:videoId");

        $query->execute(array(":videoId" => $videoId, ":imagePath" => $imagePath));
    }

    public function updateVideoData($videoData)
    {
        if (!$this->isYoutubeURL($videoData->videoPath)) {
            return false;
        }
        if (!$this->hasTitle($videoData->title)) {
            return false;
        }
        if (!$this->updateVideo($videoData)) {
            return false;
        }
        return true;
    }
}
