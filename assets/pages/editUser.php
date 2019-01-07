<?php
require "../classes/EditAccount.php";
require "../includes/config.php";
$validator = new EditAccount($pdo, $_POST["currentEmail"], $_POST["currentUser"], $_POST["fname"], $_POST["lname"], $_POST["uname"], $_POST["email"], $_POST["pwd"]);
if ($validator->edit()) {
    echo json_encode(json_decode("{}"));
} else {
    $obj = json_encode($validator->errorArray);
    echo ($obj);
}
