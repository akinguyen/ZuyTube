<?php
require "../includes/config.php";
$result = array();
if (isset($_POST["like"])) {
    $check = $pdo->prepare("SELECT * FROM likes WHERE username=:username AND videoId=:videoId");
    $check->execute(array(":username" => $_POST["username"], ":videoId" => $_POST["videoId"]));

    if ($check->fetch(PDO::FETCH_ASSOC)) {
        $dislike = $pdo->prepare("DELETE FROM likes WHERE username=:username AND videoId=:videoId");
        $dislike->execute(array(":username" => $_POST["username"], ":videoId" => $_POST["videoId"]));
        $result["like"] = "0";
        $result["dislike"] = "0";

    } else {
        $like = $pdo->prepare("INSERT INTO likes (videoId, username) VALUES (:videoId, :username)");
        $like->execute(array(":videoId" => $_POST["videoId"], ":username" => $_POST["username"]));
        $dislike = $pdo->prepare("DELETE FROM dislikes WHERE username=:username AND videoId=:videoId");
        $dislike->execute(array(":username" => $_POST["username"], ":videoId" => $_POST["videoId"]));
        $result["like"] = "1";
        $result["dislike"] = "0";
    }

} else if (isset($_POST["dislike"])) {
    $check = $pdo->prepare("SELECT * FROM dislikes WHERE username=:username AND videoId=:videoId");
    $check->execute(array(":username" => $_POST["username"], ":videoId" => $_POST["videoId"]));

    if ($check->fetch(PDO::FETCH_ASSOC)) {
        $like = $pdo->prepare("DELETE FROM dislikes WHERE username=:username AND videoId=:videoId");
        $like->execute(array(":username" => $_POST["username"], ":videoId" => $_POST["videoId"]));
        $result["dislike"] = "0";
        $result["like"] = "0";

    } else {
        $dislike = $pdo->prepare("INSERT INTO dislikes (videoId, username) VALUES (:videoId, :username)");
        $dislike->execute(array(":videoId" => $_POST["videoId"], ":username" => $_POST["username"]));
        $like = $pdo->prepare("DELETE FROM likes WHERE username=:username AND videoId=:videoId");
        $like->execute(array(":username" => $_POST["username"], ":videoId" => $_POST["videoId"]));
        $result["like"] = "0";
        $result["dislike"] = "1";
    }
}

$likeTotal = $pdo->prepare("SELECT COUNT(*) as likeTotal FROM likes WHERE videoId=:videoId");
$dislikeTotal = $pdo->prepare("SELECT COUNT(*) as dislikeTotal FROM dislikes WHERE videoId=:videoId");
$likeTotal->execute(array(":videoId" => $_POST["videoId"]));
$dislikeTotal->execute(array(":videoId" => $_POST["videoId"]));
$result["likeTotal"] = $likeTotal->fetch(PDO::FETCH_ASSOC)["likeTotal"];
$result["dislikeTotal"] = $dislikeTotal->fetch(PDO::FETCH_ASSOC)["dislikeTotal"];
echo json_encode($result);
