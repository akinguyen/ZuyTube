<?php
require "../classes/VideoHomeForProfile.php";
if (isset($_GET["username"]) && isset($_SESSION["email"])) {
    if ($_GET["username"] === $user->getUserName()) {
        header("Location: profile.php");
    }
}
$privacy = isset($_GET["username"]) ? "1" : (isset($_SESSION["email"]) ? "0" : "");
$videoHome = new VideoHomeForProfile($pdo, isset($_GET["username"]) ? $_GET["username"] : (isset($_SESSION["email"]) ? $user->getUserName() : ""), $privacy);
$videoHome->getVideoListForProfile(isset($_GET["username"]) ? $_GET["username"] : (isset($_SESSION["email"]) ? $user->getUserName() : ""));
