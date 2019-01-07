<?php
require "../classes/LoginValidator.php";
require "../includes/config.php";
$validator = new LoginValidator($pdo, $_POST["email"], $_POST["pwd"]);
if ($validator->login()) {
    echo json_encode(json_decode("{}"));
} else {
    $obj = json_encode($validator->errorArray);
    echo ($obj);
}
