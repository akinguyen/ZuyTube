<?php
require "../components/header.php";
require "../classes/EditVideoForm.php";
?>
    <div id="main">
        <div class="container">
       <div id="loading" class="justify-content-center">
            <img
            src="https://loading.io/spinners/coolors/lg.palette-rotating-ring-loader.gif" alt="">
        </div>

        <?php
if (isset($_SESSION["email"])) {
    echo "<h2 class='mb-4'>Edit Your Video</h2>";
    $editVideoForm = new EditVideoForm($pdo, isset($_GET["id"]) ? $_GET["id"] : "");
    $editVideoForm->createEditVideoForm();
} else {
    echo "<h1>Please Log In</h1>";
}

?>
        </div>

    </div>
</div>
<script>
  $(function(){
      $("#loading").css("display", "none");
      $("#uploadLoading").submit(()=>{
          $("#loading").addClass("d-flex");
          $("#loading").css("display", "block");
      });
  });
</script>
<div class='clearfix'></div>
<footer class="bg-dark text-white mt-5 p-4 text-center">
  Copyright @ 2019 ZuyTube
</footer>
<?php require "../components/loginModal.php"?>
</body>
</html>
