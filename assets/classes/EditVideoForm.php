<?php
require "VideoPlayer.php";
class EditVideoForm
{
    private $videoInfo, $pdo, $videoId;
    public function __construct($pdo, $videoId)
    {
        $this->pdo = $pdo;
        $this->videoId = $videoId;
        $this->videoInfo = new VideoPlayer($pdo, $videoId);
    }
    public function createEditVideoForm()
    {
        $youtubeInput = $this->createYoutubeInput();
        $titleInput = $this->createTitleInput();
        $descriptionInput = $this->createDescriptionInput();
        $privateInput = $this->createPrivateStatus();
        $categoriesInput = $this->createCategoriesInput($this->pdo);
        $uploadButton = $this->createUploadButton();

        echo
            "<form id='uploadLoading' action='../pages/editProcessing.php' method='POST'>
                <input type='hidden' name='id' value='$this->videoId'>
                $youtubeInput
                $titleInput
                $descriptionInput
                $privateInput
                $categoriesInput
                $uploadButton
            </form>";
    }

    public function createYoutubeInput()
    {
        $url = $this->videoInfo->getVideoPath();
        return
            "
            <div class='form-group'>
                <input type='url' class='form-control' placeholder='Youtube URL' name='youtube'
                value='$url' required>
            </div>
        ";
    }
    public function createTitleInput()
    {
        $title = $this->videoInfo->getTitle();
        return
            "<div class='form-group'>
                <input name='title' class='form-control' type='text' placeholder='Title' value='$title' required>
            </div>";
    }
    public function createDescriptionInput()
    {
        $desc = $this->videoInfo->getDescription();
        return
            "
            <div class='form-group'>
                <textarea name='description' class='form-control' placeholder='Description' rows='3' value='$desc'></textarea>
            </div>
        ";
    }
    public function createPrivateStatus()
    {
        $status = $this->videoInfo->getPrivacy();
        $private = $status === "1" ? "selected" : "";
        $public = $status === "0" ? "selected" : "";
        return
            "<div value='$status' class='form-group'>
                <select name='private' class='form-control'>
                <option $private value='1'>Private</option>
                <option $public value='0'>Public</option>
                </select>
            </div>";
    }
    private function createCategoriesInput($pdo)
    {
        $category = $this->videoInfo->getCategory();
        $options = "";
        $query = $pdo->query("SELECT * FROM categories ORDER BY id ASC");
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $id = $row["id"];
            $status = ($row["name"] === $category) ? "selected" : "";
            $options .= "<option $status value='$id'>" . $row["name"] . "</option>";
        }
        return
            "<div class='form-group'>
                <select name='category' class='form-control'>
                $options
                </select>
            </div>";
    }
    private function createUploadButton()
    {
        return "<button type='submit' class='btn btn-primary' name='uploadButton'>Edit Video</button>";
    }
}
