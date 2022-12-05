<?php
session_start();
require "db.php";
$user = $_POST["username"];
$pass = $_POST["password"];

$db = new DB();
$mas[]=$db->SelectData("Select * from user where Name = '{$user}'");
//var_dump($mas[0][1][]);

    if($mas[0][0]["password"]==$pass){

        $_SESSION["user_name"]=$mas[0][0]["Name"];
        $_SESSION["user_id"]=$mas[0][0]["id"];
        header("Location: chat.php");

    }


?>