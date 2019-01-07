<?php
$profileSub = new SubList($pdo, isset($_GET["username"]) ? $_GET["username"] : (isset($_SESSION["email"]) ? $user->getUserName() : ""));
$profileSub->createSubListForProfile();
