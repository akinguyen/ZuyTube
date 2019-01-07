<?php
require "../includes/config.php";
$result = array();
$check = $pdo->prepare("SELECT * FROM subscribe WHERE fromUser=:from AND toUser=:to");
$check->execute(array(":from" => $_POST["fromUser"], ":to" => $_POST["toUser"]));
if ($check->fetch(PDO::FETCH_ASSOC)) {
    $check = $pdo->prepare("DELETE FROM subscribe WHERE fromUser=:from AND toUser=:to");
    $check->execute(array(":from" => $_POST["fromUser"], ":to" => $_POST["toUser"]));
    $result["sub"] = "0";
} else {
    $check = $pdo->prepare("INSERT INTO subscribe (fromUser, toUser) VALUES (:from, :to)");
    $check->execute(array(":from" => $_POST["fromUser"], ":to" => $_POST["toUser"]));
    $result["sub"] = "1";
}
$check = $pdo->prepare("SELECT COUNT(*) as total FROM subscribe WHERE toUser=:to");
$check->execute(array(":to" => $_POST["toUser"]));
$total = $check->fetch(PDO::FETCH_ASSOC);
$result["total"] = !isset($total) ? "Subscriber 0" : "Subscriber " . $total["total"];
echo json_encode($result);
