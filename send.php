<?php
require "db.php";
$user = $_POST["userid"];
$room = $_POST["room"];
$message = $_POST["message"];
$db = new DB();
$db->InsertData("INSERT INTO message(iduser, idroom, message) VALUES ($user,$room,'{$message}')");
?>