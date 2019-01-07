<?php
require "../components/header.php";
?>
    <div id="main">
    <div class="container">
      <?php
if (isset($_SESSION["email"])) {
    require "../components/setting.php";
} else {
    echo "<h1>Please Log In</h1>";
    require "../components/loginModal.php";
}

?>
    </div>

    </div>
</div>

<div class='clearfix'></div>
<footer class="bg-dark text-white mt-5 p-4 text-center">
  Copyright @ 2019 ZuyTube
</footer>
</body>
</html>
