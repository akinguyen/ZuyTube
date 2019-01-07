<?php
class VideoUploadForm
{
    public static function createVideoUploadForm($pdo)
    {
        $uploadInput = VideoUploadForm::createUploadInput();
        $youtubeInput = VideoUploadForm::createYoutubeInput();
        $titleInput = VideoUploadForm::createTitleInput();
        $descriptionInput = VideoUploadForm::createDescriptionInput();
        $privateInput = VideoUploadForm::createPrivateStatus();
        $categoriesInput = VideoUploadForm::createCategoriesInput($pdo);
        $uploadButton = VideoUploadForm::createUploadButton();
        echo
            "<form id='uploadLoading' action='../pages/processing.php' method='POST'>
                $youtubeInput
                $titleInput
                $descriptionInput
                $privateInput
                $categoriesInput
                $uploadButton
            </form>";
    }
    public static function createUploadInput()
    {
        return
            "<div class='form-group'>
                <input type='file' class='form-control-file' >
            </div>";
    }
    public static function createYoutubeInput()
    {
        return
            "
            <div class='form-group'>
                <input type='url' class='form-control' placeholder='Youtube URL' name='youtube' required>
            </div>
        ";
    }
    public static function createTitleInput()
    {
        return
            "<div class='form-group'>
                <input name='title' class='form-control' type='text' placeholder='Title' required>
            </div>";
    }
    public static function createDescriptionInput()
    {
        return
            "
            <div class='form-group'>
                <textarea name='description' class='form-control' placeholder='Description' rows='3'></textarea>
            </div>
        ";
    }
    public static function createPrivateStatus()
    {
        return
            "<div class='form-group'>
                <select name='private' class='form-control'>
                <option value='1'>Private</option>
                <option value='0'>Public</option>
                </select>
            </div>";
    }
    private static function createCategoriesInput($pdo)
    {
        $options = "";
        $query = $pdo->query("SELECT * FROM categories ORDER BY id ASC");
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $id = $row["id"];
            $options .= "<option value='$id'>" . $row["name"] . "</option>";
        }
        return
            "<div class='form-group'>
                <select name='category' class='form-control'>
                $options
                </select>
            </div>";
    }
    private static function createUploadButton()
    {
        return "<button type='submit' class='btn btn-primary' name='uploadButton'>Upload</button>";
    }
}
