<?php
require "../includes/config.php";
require "../classes/CommentForm.php";
$result = array();
$newestComment = CommentForm::insertComment($pdo, $_POST["commentInput"], $_POST["username"], $_POST["videoId"]);
