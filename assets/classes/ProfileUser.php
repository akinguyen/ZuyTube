<?php
class ProfileUser
{
    private $pdo, $userInfo, $username;

    public function __construct($pdo, $username)
    {
        $this->pdo = $pdo;
        $query = $pdo->prepare("SELECT * FROM users WHERE username=:username");
        $query->execute(array(":username" => $username));
        $this->userInfo = $query->fetch(PDO::FETCH_ASSOC);

    }
    public function hasUser()
    {
        return $this->userInfo;
    }
    public static function getSubCountForProfile($pdo, $toUser)
    {
        $check = $pdo->prepare("SELECT COUNT(*) as total FROM subscribe WHERE toUser=:to");
        $check->execute(array(":to" => $toUser));
        $total = $check->fetch(PDO::FETCH_ASSOC);
        return !isset($total) ? "Subscriber 0" : "Subscriber " . $total["total"];
    }
    public static function getTotalSubs($pdo, $toUser)
    {
        $check = $pdo->prepare("SELECT COUNT(*) as total FROM subscribe WHERE toUser=:to");
        $check->execute(array(":to" => $toUser));
        $total = $check->fetch(PDO::FETCH_ASSOC);
        return $total["total"];
    }
    public function getTotalViews()
    {
        $query = $this->pdo->prepare("SELECT sum(views) FROM videos WHERE uploadedBy=:username");
        $query->execute(array(":username" => $this->getUserName()));
        return $query->fetchColumn();

    }
    public function createProfile()
    {
        echo $this->createUser();
    }
    private function createUser()
    {
        $name = $this->getFirstName() . " " . $this->getLastName();
        $email = $this->getEmail();
        $username = $this->getUserName();
        return
            "
            <h5>Details</h5>
            <div>Name: $name</div>
            <div>Email: $email</div>
            <div>Username: $username</div>
        ";

    }
    public function userDidSub($fromUser, $toUser)
    {
        $check = $this->pdo->prepare("SELECT * FROM subscribe WHERE fromUser=:from AND toUser=:to");
        $check->execute(array(":from" => $fromUser, ":to" => $toUser));
        if ($check->fetch(PDO::FETCH_ASSOC)) {
            return true;
        }
        return false;
    }
    public function userDidLike($videoId)
    {
        $check = $this->pdo->prepare("SELECT * FROM likes WHERE username=:username AND videoId=:videoId");
        $check->execute(array(":username" => $this->userInfo["username"], ":videoId" => $videoId));

        if ($check->fetch(PDO::FETCH_ASSOC)) {
            return true;
        }
        return false;
    }
    public function userDidDislike($videoId)
    {
        $check = $this->pdo->prepare("SELECT * FROM dislikes WHERE username=:username AND videoId=:videoId");
        $check->execute(array(":username" => $this->userInfo["username"], ":videoId" => $videoId));

        if ($check->fetch(PDO::FETCH_ASSOC)) {
            return true;
        }
        return false;
    }
    public function getFirstName()
    {
        return $this->userInfo["firstname"];
    }
    public function getLastName()
    {
        return $this->userInfo["lastname"];
    }
    public function getUserName()
    {
        return $this->userInfo["username"];
    }
    public function getProfileImage()
    {
        return $this->userInfo["profileImage"];
    }
    public function getEmail()
    {
        return $this->userInfo["email"];
    }
}
