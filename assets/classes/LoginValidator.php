<?php
class LoginValidator
{
    public $fname, $lname, $uname, $email, $pwd;
    private $pdo;
    public $errorArray;
    public function __construct($pdo, $email, $pwd)
    {
        $this->pdo = $pdo;
        $this->email = isset($email) ? htmlentities($email) : "";
        $this->pwd = isset($pwd) ? htmlentities($pwd) : "";
        $this->errorArray = array();
    }

    public function login()
    {
        $this->validateLoginInput();
        return sizeof($this->errorArray) === 0 ? true : false;
    }

    private function validateLoginInput()
    {
        $query = $this->pdo->prepare("SELECT * FROM users WHERE email=:email");
        $query->execute(array(":email" => $this->email));
        if (!$query->fetch(PDO::FETCH_ASSOC)) {
            $this->errorArray["email"] = "There is no user with this email";
        } else {
            $this->validatePassword();
        }
    }
    private function validatePassword()
    {
        $query = $this->pdo->prepare("SELECT * FROM users WHERE email=:email AND password=:pwd");
        $query->execute(array(":email" => $this->email, ":pwd" => hash("sha512", $this->pwd)));
        if (!$query->fetch(PDO::FETCH_ASSOC)) {
            $this->errorArray["pwd"] = "Wrong Password";
        }
    }

}
