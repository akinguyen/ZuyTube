<?php
require "../classes/SignUpValidator.php";
require "../includes/config.php";
$validator = new SignUpValidator($pdo, $_POST["fname"], $_POST["lname"], $_POST["uname"], $_POST["email"], $_POST["pwd"]);
if ($validator->signUp()) {
    echo json_encode(json_decode("{}"));
} else {
    $obj = json_encode($validator->errorArray);
    echo ($obj);
}
