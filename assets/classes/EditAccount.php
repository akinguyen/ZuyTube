<?php
class EditAccount
{
    public $fname, $lname, $uname, $email, $pwd, $currentUser, $currentEmail;
    private $pdo;
    public $errorArray;
    public function __construct($pdo, $currentEmail, $currentUser, $fname, $lname, $uname, $email, $pwd)
    {
        $this->pdo = $pdo;
        $this->currentUser = $currentUser;
        $this->currentEmail = $currentEmail;
        $this->fname = isset($fname) ? htmlentities($fname) : "";
        $this->lname = isset($lname) ? htmlentities($lname) : "";
        $this->uname = isset($uname) ? htmlentities($uname) : "";
        $this->email = isset($email) ? htmlentities($email) : "";
        $this->pwd = isset($pwd) ? htmlentities($pwd) : "";
        $this->errorArray = array();
    }

    private function checkUserName()
    {
        if (!(strlen($this->uname) > 2 && strlen($this->uname) < 26)) {
            $this->errorArray["uname"] = "The user name should be between 3 and 25";
        }
        $query = $this->pdo->prepare("SELECT * FROM users WHERE username=:username");
        $query->execute(array(":username" => $this->uname));
        $user = $query->fetch(PDO::FETCH_ASSOC);
        if ($user && $user["username"] !== $this->currentUser) {
            $this->errorArray["uname"] = "Username already exists";
        }
    }
    private function checkEmail()
    {
        if (!(strlen($this->email) > 2 && strlen($this->email) < 101)) {
            $this->errorArray["email"] = "The email should be between 3 and 100";
        }
        $query = $this->pdo->prepare("SELECT * FROM users WHERE email=:email");
        $query->execute(array(":email" => $this->email));
        $user = $query->fetch(PDO::FETCH_ASSOC);
        if ($user && $user["email"] !== $this->currentEmail) {
            $this->errorArray["email"] = "Email already exists";
        }
    }
    public function edit()
    {
        if ($this->isEditValid()) {
            $query = $this->pdo->prepare("UPDATE users SET firstname=:fname,lastname=:lname,username=:uname,email=:email,password=:pwd WHERE username=:current");
            $query->execute(array(":fname" => $this->fname, ":lname" => $this->lname, ":uname" => $this->uname, ":email" => $this->email, ":pwd" => hash("sha512", $this->pwd), ":current" => $this->currentUser));

            $this->updateDislikes();
            $this->updateLikes();
            $this->updateSub();
            $this->updateVideo();
            return true;
        }
        return false;
    }
    private function updateLikes()
    {
        $query = $this->pdo->prepare("UPDATE likes SET username=:uname WHERE username=:current");
        $query->execute(array(":uname" => $this->uname, ":current" => $this->currentUser));

        return true;
    }
    private function updateDislikes()
    {
        $query = $this->pdo->prepare("UPDATE dislikes SET username=:uname WHERE username=:current");
        $query->execute(array(":uname" => $this->uname, ":current" => $this->currentUser));

        return true;
    }
    private function updateVideo()
    {
        $query = $this->pdo->prepare("UPDATE videos SET uploadedBy=:uname WHERE uploadedBy=:current");
        $query->execute(array(":uname" => $this->uname, ":current" => $this->currentUser));

        return true;
    }
    private function updateSub()
    {
        $query = $this->pdo->prepare("UPDATE subscribe SET fromUser=:uname WHERE fromUser=:current");
        $query->execute(array(":uname" => $this->uname, ":current" => $this->currentUser));

        $query = $this->pdo->prepare("UPDATE subscribe SET toUser=:uname WHERE toUser=:current");
        $query->execute(array(":uname" => $this->uname, ":current" => $this->currentUser));
        return true;
    }

    private function isEditValid()
    {
        $this->validateEditInput();
        return sizeof($this->errorArray) === 0 ? true : false;
    }

    private function validateEditInput()
    {
        if (!(strlen($this->fname) > 1 && strlen($this->fname) < 26)) {
            $this->errorArray["fname"] = "The first name should be between 2 and 25";
        }
        if (!ctype_alpha($this->fname)) {
            $this->errorArray["fname"] = "Invalid first name, must have character only";
        }
        if (!(strlen($this->lname) > 1 && strlen($this->lname) < 26)) {
            $this->errorArray["lname"] = "The last name should be between 2 and 25";
        }
        if (!ctype_alpha($this->lname)) {
            $this->errorArray["lname"] = "Invalid last name, must have character only";
        }

        if (!(strlen($this->pwd) > 1 && strlen($this->pwd) < 256)) {
            $this->errorArray["pwd"] = "The password should be between 5 and 255";
        }
        $this->checkUserName();
        $this->checkEmail();
    }
}
