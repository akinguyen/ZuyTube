<?php

class VideoData
{
    public $title, $description, $category, $uploadedBy, $videoPath, $private;
    public function __construct($videoPath, $title, $description, $private, $category, $uploadedBy)
    {
        $this->title = $title;
        $this->description = $description;
        $this->category = $category;
        $this->uploadedBy = $uploadedBy;
        $this->videoPath = $videoPath;
        $this->private = $private;
    }
}
