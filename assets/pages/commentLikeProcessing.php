<?php
require "../includes/config.php";
$result = array();
if (isset($_POST["like"])) {
    $check = $pdo->prepare("SELECT id FROM commentlikes WHERE username=:username AND commentId=:commentId");
    $check->execute(array(":username" => $_POST["username"], ":commentId" => $_POST["commentId"]));

    if ($check->fetch(PDO::FETCH_ASSOC)) {
        $dislike = $pdo->prepare("DELETE FROM commentlikes WHERE username=:username AND commentId=:commentId");
        $dislike->execute(array(":username" => $_POST["username"], ":commentId" => $_POST["commentId"]));
        $result["like"] = "0";
        $result["dislike"] = "0";

    } else {
        $like = $pdo->prepare("INSERT INTO commentlikes (commentId, username) VALUES (:commentId, :username)");
        $like->execute(array(":commentId" => $_POST["commentId"], ":username" => $_POST["username"]));
        $dislike = $pdo->prepare("DELETE FROM commentdislikes WHERE username=:username AND commentId=:commentId");
        $dislike->execute(array(":username" => $_POST["username"], ":commentId" => $_POST["commentId"]));
        $result["like"] = "1";
        $result["dislike"] = "0";
    }
} else {
    $check = $pdo->prepare("SELECT * FROM commentdislikes WHERE username=:username AND commentId=:commentId");
    $check->execute(array(":username" => $_POST["username"], ":commentId" => $_POST["commentId"]));

    if ($check->fetch(PDO::FETCH_ASSOC)) {
        $like = $pdo->prepare("DELETE FROM commentdislikes WHERE username=:username AND commentId=:commentId");
        $like->execute(array(":username" => $_POST["username"], ":commentId" => $_POST["commentId"]));
        $result["dislike"] = "0";
        $result["like"] = "0";

    } else {
        $dislike = $pdo->prepare("INSERT INTO commentdislikes (commentId, username) VALUES (:commentId, :username)");
        $dislike->execute(array(":commentId" => $_POST["commentId"], ":username" => $_POST["username"]));
        $like = $pdo->prepare("DELETE FROM commentlikes WHERE username=:username AND commentId=:commentId");
        $like->execute(array(":username" => $_POST["username"], ":commentId" => $_POST["commentId"]));
        $result["like"] = "0";
        $result["dislike"] = "1";
    }
}
$likeTotal = $pdo->prepare("SELECT COUNT(*) as likeTotal FROM commentlikes WHERE commentId=:commentId");
$dislikeTotal = $pdo->prepare("SELECT COUNT(*) as dislikeTotal FROM commentdislikes WHERE commentId=:commentId");
$likeTotal->execute(array(":commentId" => $_POST["commentId"]));
$dislikeTotal->execute(array(":commentId" => $_POST["commentId"]));
$result["likeTotal"] = $likeTotal->fetch(PDO::FETCH_ASSOC)["likeTotal"];
$result["dislikeTotal"] = $dislikeTotal->fetch(PDO::FETCH_ASSOC)["dislikeTotal"];
echo json_encode($result);
