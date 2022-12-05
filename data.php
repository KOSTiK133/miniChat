<?php
require "db.php";
$room = $_POST["room_id"];
$db = new DB();
$data = $db->SelectData("select * from message where idroom=".$room);
echo json_encode($data);
?>