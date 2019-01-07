<?php
require "../classes/ProfileUser.php";
$profileQuery = isset($_GET["username"]) ? $_GET["username"] : (isset($_SESSION["email"]) ? $user->getUserName() : "");
$profileUser = new ProfileUser($pdo, $profileQuery);
if (!$profileUser->hasUser()) {
    header("Location: noUser.php");
}
?>
<div class="container">
  <div class="card bg-success mb-3">
    <div>
      <div
        class="img-fluid"
        alt="Responsive image"
        style="max-width: 100%; height: 470px; background-image: url(&quot;https://wallpapercave.com/wp/wp2552360.jpg&quot;);"
      ></div>
      <div class="card-img-overlay text-center" style="margin-top: 70px;">
        <img
          src="//www.gravatar.com/avatar/f871f4131b1580194e81242a908eff12?s=200&amp;r=pg&amp;d=mm"
          class="rounded-circle border border-dark"
          style="width: 200px;"
        />
        <h2 style="color: white;"><?=isset($_GET["username"]) ? $_GET["username"] : (isset($_SESSION["email"]) ? $user->getUserName() : "")?></h2>
        <?php
if (isset($_GET["username"])) {
    if (isset($_SESSION["email"]) && ($user->getUserName() !== $_GET["username"])) {
        $subCountForProfile = ProfileUser::getSubCountForProfile($pdo, $profileQuery);
        echo
            "
        <div class='subscribe'>
           <button  style='font-size: 20px;'
                type='button'
                class='btn btn-danger'
            >
            $subCountForProfile
            </button>
        </div>
    ";
    }
}
?>

        <input class="isSubValue" type="hidden" value=<?=isset($_SESSION["email"]) ? $user->userDidSub($user->getUserName(), $profileQuery) ? "1" : "0" : ""?>>
        <input type="hidden" class="toUser" value=<?=$profileQuery?>>
        <input class="unameValue" type="hidden" value='<?=isset($_SESSION["email"]) ? $user->getUserName() : ""?>'>
      </div>
    </div>
    <div class="card-body">
      <h3 class="text-center">Statistics</h3>
      <div class="card-text text-center">
        <li class="list-inline-item" style="font-size: 20px;">
        <i class="fas fa-eye"></i> <?=$profileUser->getTotalViews()?>
        </li>

        <?php
if ((isset($_SESSION["email"]) && !isset($_GET["username"])) || (!isset($_SESSION["email"]) && isset($_GET["username"]))) {
    $pquery = isset($_SESSION["email"]) ? $user->getUserName() : $_GET["username"];
    $totalSubs = ProfileUser::getTotalSubs($pdo, $pquery);
    echo "<li class='list-inline-item' style='font-size: 20px;'>
          <img src='http://www.adelaidewebsitedesign.com.au/shopping-cart-demo/wp-content/uploads/2018/08/Miscellaneous__subscribe_subscription_button_online-512.png' height=55 style='margin-right: 5px' alt='Subscribe'>$totalSubs
          </li>";
}
?>
      </div>
      <div class="card-text"></div>
    </div>
  </div>


    <!-- Nav pills -->
    <ul class="nav nav-pills" role="tablist">
      <li class="nav-item">
        <a class="nav-link active" data-toggle="pill" href="#home">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="pill" href="#about">About</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="pill" href="#subscribe"
          >Subscriptions</a
        >
      </li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
      <div id="home" class="container tab-pane active">
        <?php require "profileHome.php"?>
      </div>
      <div id="about" class="container tab-pane fade">
        <?php require "profileAbout.php"?>
      </div>
      <div id="subscribe" class="container tab-pane fade">
        <?php require "profileSub.php"?>
      </div>
    </div>

</div>
<script src="../js/profileFunction.js"></script>
<script>
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
});
</script>
