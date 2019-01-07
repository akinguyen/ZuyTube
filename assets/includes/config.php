<?php
ob_start(); // Turns on output buffering
date_default_timezone_set("America/Los_Angeles");
try {
    $servername = "localhost";
    $username = "duy";
    $password = "meyeu2000";
    $pdo = new PDO("mysql:host=$servername;dbname=videotube", $username, $password);
// set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
