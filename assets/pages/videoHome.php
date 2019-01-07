<?php
require "assets/classes/VideoHome.php";

$videoHome = new VideoHome($pdo, isset($_SESSION["email"]) ? $user->getUserName() : "");
$videoHome->createVideoHome();

?>
<script>
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
});
</script>
