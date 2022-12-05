<?php
session_start();
require "db.php";
$user = $_POST["username"];
$pass = $_POST["password"];

$db = new DB();

$id = $db->InsertData("INSERT INTO user(Name, password) VALUES ('{$user}','{$pass}')");
$_SESSION['user_id']=$id;
$_SESSION['user_name']=$user;
header("Location: chat.php");
