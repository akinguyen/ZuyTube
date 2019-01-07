<?php
class User
{
    private $pdo, $userInfo;

    public function __construct($pdo, $email)
    {
        $this->pdo = $pdo;
        $query = $pdo->prepare("SELECT * FROM users WHERE email=:email");
        $query->execute(array(":email" => $email));
        $this->userInfo = $query->fetch(PDO::FETCH_ASSOC);

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
    public function getPassword()
    {
        return $this->userInfo["password"];
    }
}
