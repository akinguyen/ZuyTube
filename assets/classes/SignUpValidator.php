<?php
class SignUpValidator
{
    public $fname, $lname, $uname, $email, $pwd;
    private $pdo;
    public $errorArray;
    public function __construct($pdo, $fname, $lname, $uname, $email, $pwd)
    {
        $this->pdo = $pdo;
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
        if ($query->fetch(PDO::FETCH_ASSOC)) {
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
        if ($query->fetch(PDO::FETCH_ASSOC)) {
            $this->errorArray["email"] = "Email already exists";
        }
    }
    public function signUp()
    {
        if ($this->isSignUpValid()) {
            $query = $this->pdo->prepare("INSERT INTO users (firstname,lastname,username,email,password,profileImage) VALUES (:fname,:lname,:uname,:email,:pwd,:profile)");
            $query->execute(array(":fname" => $this->fname, ":lname" => $this->lname, ":uname" => $this->uname, ":email" => $this->email, ":pwd" => hash("sha512", $this->pwd), ":profile" => "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcShci2i08psVXKRwGLnhzTe5T9KeyO1cv_zq0nNf0DZ7c5ME00hOQ"));
            return true;
        }
        return false;
    }

    private function isSignUpValid()
    {
        $this->validateSignUpInput();
        return sizeof($this->errorArray) === 0 ? true : false;
    }

    private function validateSignUpInput()
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
