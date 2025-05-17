<?php

require "con_db_l.php";
session_start();

$username = htmlspecialchars($_POST['username'] ?? '');

$user = $savienojums->prepare("SELECT COUNT(*) FROM lietotaji WHERE username = ?");
$user->bind_param("s", $username);
$user->execute();
$user->bind_result($count);
$user->fetch();
$user->close();

if ($count > 0) {
    echo json_encode(["status" => "exists"]);
} else {
    echo json_encode(["status" => "available"]);
}