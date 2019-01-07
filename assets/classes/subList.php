<?php
class SubList
{
    public function __construct($pdo, $username)
    {
        $this->subList = $pdo->prepare("SELECT toUser as user FROM subscribe WHERE fromUser=:username");
        $this->subList->execute(array(":username" => $username));
    }
    public function createSubList()
    {
        echo "<hr>";
        echo "<a style='color:#818181'>Subscriptions</a>";
        echo "<hr>";
        foreach ($this->subList as $row) {
            echo $this->createSub($row);
        }
    }
    public function createSubListForProfile()
    {
        foreach ($this->subList as $row) {
            echo $this->createSubForProfile($row);
        }
        echo "<div class='clearfix'></div>";
    }
    private function createSubForProfile($row)
    {
        $subname = $row["user"];
        return
            "<div class='responsive'>
                <div class='gallery'>
                    <a style='text-decoration: none;' href='?username=$subname'>
                        <img src='https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcShci2i08psVXKRwGLnhzTe5T9KeyO1cv_zq0nNf0DZ7c5ME00hOQ' alt='Thumbnail' width='600' height='400'>
                    </a>

                    <div class='subTitle'>
                        <h4 class='title'>$subname</h4>
                    </div>
                </div>
            </div>";
    }
    private function createSub($row)
    {
        $subname = $row["user"];
        $url = strpos($_SERVER['REQUEST_URI'], 'index.php') > 0 ? "assets/pages/profile.php?username=$subname" : "profile.php?username=$subname";
        return
            "<a class='thumbnailBox d-flex flex-row' href='$url'>
                <img class='rounded-circle mr-2' src='https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcShci2i08psVXKRwGLnhzTe5T9KeyO1cv_zq0nNf0DZ7c5ME00hOQ' style='height:25px'alt='user'>
                <div style='padding-bottom: 2px; font-size: 20px'>$subname</div>
            </a>";
    }
}
