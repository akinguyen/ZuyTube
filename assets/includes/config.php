<?php
ob_start(); // Turns on output buffering
date_default_timezone_set("America/Los_Angeles");
try {
    $servername = "us-cdbr-iron-east-01.cleardb.net";
    $username = "b6e2dbbf2ab244";
    $password = "26b64e03";
    $pdo = new PDO("mysql:host=$servername;dbname=videotube", $username, $password);
// set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
