<?php
require "../components/header.php";

if (isset($_POST["uploadButton"]) && $_POST["youtube"] === "") {
    echo "No File sent to page";
    return;
}
?>
    <div id="main">
        <div class="container">
        <h2 class="mb-4">Found User Status</h2>
        <h6>User not found, please log in</h6>
        </div>
    </div>
</div>
<footer class="bg-dark text-white mt-5 p-4 text-center">
  Copyright @ 2019 ZuyTube
</footer>
</body>
</html>
