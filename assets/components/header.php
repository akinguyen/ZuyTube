<?php
require strpos($_SERVER['REQUEST_URI'], 'index.php') > 0 || strlen($_SERVER["REQUEST_URI"]) === 11 ? "assets/includes/config.php" : "../includes/config.php";
require strpos($_SERVER['REQUEST_URI'], 'index.php') > 0 || strlen($_SERVER["REQUEST_URI"]) === 11 ? "assets/classes/User.php" : "../classes/User.php";
require strpos($_SERVER['REQUEST_URI'], 'index.php') > 0 || strlen($_SERVER["REQUEST_URI"]) === 11 ? "assets/classes/subList.php" : "../classes/subList.php";
?>
<?php
session_start();
if (isset($_POST["email"]) || isset($_POST["editSuccess"])) {
    $_SESSION["email"] = $_POST["email"];
    $location = strpos($_SERVER['REQUEST_URI'], 'index.php') > 0 || strlen($_SERVER["REQUEST_URI"]) === 11 ? "index.php" : "../../index.php";
    header("Location: $location");
}
if (isset($_GET["userLoggedOut"])) {
    unset($_SESSION["email"]);
    $location = strpos($_SERVER['REQUEST_URI'], 'index.php') > 0 || strlen($_SERVER["REQUEST_URI"]) === 11 ? "index.php" : "../../index.php";
    header("Location: $location");
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>ZuyTube</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">

    <!-- videotube.css -->
    <link rel="stylesheet"  href=<?=strpos($_SERVER['REQUEST_URI'], 'index.php') > 0 || strlen($_SERVER["REQUEST_URI"]) === 11 ? "assets/css/videotube.css" : "../css/videotube.css"?> />
    <link rel="stylesheet"  href=<?=strpos($_SERVER['REQUEST_URI'], 'index.php') > 0 || strlen($_SERVER["REQUEST_URI"]) === 11 ? "assets/css/sideMenu.css" : "../css/sideMenu.css"?> />
    <link rel="stylesheet"  href=<?=strpos($_SERVER['REQUEST_URI'], 'index.php') > 0 || strlen($_SERVER["REQUEST_URI"]) === 11 ? "assets/css/login.css" : "../css/login.css"?> />
    <link rel="stylesheet"  href=<?=strpos($_SERVER['REQUEST_URI'], 'index.php') > 0 || strlen($_SERVER["REQUEST_URI"]) === 11 ? "assets/css/videoHome.css" : "../css/videoHome.css"?> />
    <script src=<?=strpos($_SERVER['REQUEST_URI'], 'index.php') > 0 || strlen($_SERVER["REQUEST_URI"]) === 11 ? "assets/js/searchBar.js" : "../js/searchBar.js"?>></script>
</head>

<body>
<?
echo $_SERVER["REQUEST_URI"];
if (isset($_SESSION["email"])) {
    $user = new User($pdo, $_SESSION["email"]);
}
?>
<nav class="navbar fixed-top navbar-expand-lg justify-content-between navbar-dark bg-dark">
    <ul class="navbar-nav">
        <li class="nav-item">
        <div id="menu-button" class="nav-link">
            <img class=" menu-icon" src="http://www.stickpng.com/assets/images/588a64c6d06f6719692a2d0c.png" alt="Menu">
        </div>
        </li>
        <li class="nav-item">
            <a class=" navbar-brand nav-link text-information" href=<?=strpos($_SERVER['REQUEST_URI'], 'index.php') > 0 || strlen($_SERVER["REQUEST_URI"]) === 11 ? "" : "../../index.php"?>>
                ZuyTube
            </a>
        </li>

    </ul>
    <script>
        $(function(){
            $(".searchButton").click(()=>{
                if ($(".searchBar").val() !== ""){
                    $(".searchForm").submit();
                }
            })
        })
    </script>
  <form method="get" action=<?=strpos($_SERVER['REQUEST_URI'], 'index.php') > 0 || strlen($_SERVER["REQUEST_URI"]) === 11 ? "assets/pages/result.php" : "../pages/result.php"?> class="searchForm form-inline">
    <div class="nav-link">
        <img class="back-button rounded-circle" src="https://cdn1.iconfinder.com/data/icons/social-messaging-ui-color-round-1/254000/27-512.png" alt="Back">
    </div>
    <input name="search_query" class="rounded p-1 mr-2 searchBar" type="search" placeholder="Search" aria-label="Search">
    <button class="searchButton fas fa-search btn btn-outline-success my-2 my-sm-0" type="submit"></button>
  </form>
    <ul class="navbar-nav left mr-2">
      <li class="nav-item">
        <a class="nav-link" href=<?=strpos($_SERVER['REQUEST_URI'], 'index.php') > 0 || strlen($_SERVER["REQUEST_URI"]) === 11 ? "assets/pages/upload.php" : "upload.php"?>>
            <img class="icon rounded-circle" src="https://www.colprinting.com/wp-content/uploads/2015/02/upload.png" alt="Upload">
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">
            <img class="icon rounded-circle" src="https://cdn1.iconfinder.com/data/icons/basic-elements-glyph-circle/614/764_-_Notification-512.png" alt="Notification">
        </a>
      </li>
      <?php
if (isset($_SESSION["email"])) {
    $profileUrl = strpos($_SERVER['REQUEST_URI'], 'index.php') > 0 || strlen($_SERVER["REQUEST_URI"]) === 11 ? "assets/pages/profile.php" : "profile.php";
    echo
        "
          <li class='nav-item'>
                <a class='nav-link' href=$profileUrl>
                    <img class='icon rounded-circle' src='https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcShci2i08psVXKRwGLnhzTe5T9KeyO1cv_zq0nNf0DZ7c5ME00hOQ' alt='User'>
                </a>
            </li>
          ";
} else {
    echo
        "<li class='nav-item'>
            <a class='nav-link loginLink' style='cursor: pointer;'>Login</a>
        </li>";
}
?>

    </ul>

</nav>
<br>
<style>
    hr {
    display: block;
    height: 1px;
    border: 0;
    border-top: 1px solid #818181;
    margin: 1em 0;
    padding: 0;
}
</style>
<div id="mainSection">
    <div id="mySidebar" class="sidebar">
        <a href=<?=strpos($_SERVER['REQUEST_URI'], 'index.php') > 0 || strlen($_SERVER["REQUEST_URI"]) === 11 ? "" : "../../index.php"?>>Home</a>
        <a href=<?=strpos($_SERVER['REQUEST_URI'], 'index.php') > 0 || strlen($_SERVER["REQUEST_URI"]) === 11 ? "assets/pages/trending.php" : "trending.php"?>>Trending</a>
        <?php
if (isset($_SESSION["email"])) {
    $likedUrl = strpos($_SERVER['REQUEST_URI'], 'index.php') > 0 || strlen($_SERVER["REQUEST_URI"]) === 11 ? "assets/pages/likedVideo.php" : "likedVideo.php";

    $settingUrl = strpos($_SERVER['REQUEST_URI'], 'index.php') > 0 || strlen($_SERVER["REQUEST_URI"]) === 11 ? "assets/pages/setting.php" : "setting.php";

    $aboutUrl = strpos($_SERVER['REQUEST_URI'], 'index.php') > 0 || strlen($_SERVER["REQUEST_URI"]) === 11 ? "assets/pages/profile.php" : "profile.php";

    $logOutUrl = strpos($_SERVER['REQUEST_URI'], 'index.php') > 0 || strlen($_SERVER["REQUEST_URI"]) === 11 ? "?userLoggedOut=1" : "../../index.php?userLoggedOut=1";

    echo "<a href='$likedUrl'>Liked Videos</a>";
    echo "<a href='$aboutUrl'>About</a>";
    echo "<a href='$settingUrl'>Setting</a>";

    echo "<a href='$logOutUrl'>Log Out</a>";

    $subList = new SubList($pdo, $user->getUserName());
    $subList->createSubList();
}
?>


    </div>
