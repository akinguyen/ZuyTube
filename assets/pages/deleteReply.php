<?php
require "../includes/config.php";
$query = $pdo->prepare("DELETE FROM comments WHERE id=:commentId; DELETE FROM commentlikes WHERE commentId=:commentId; DELETE FROM commentdislikes WHERE commentId=:commentId");
$query->execute(array(":commentId" => $_POST["commentId"]));
