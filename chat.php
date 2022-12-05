<?php
session_start();
require "db.php";
if($_SESSION['user_id']==null ||$_SESSION['user_name']==null){
    header("Location: reg.html");

}
if($_POST['isDestroy']=='ok'){
    session_destroy();
    header("Location: index.html");
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>overflow</title>
    <style>
        .layer {
            margin-left: 170px;
            overflow: scroll; /* Добавляем полосы прокрутки */
            width: 1000px; /* Ширина блока */
            height: 450px; /* Высота блока */
            padding: 5px; /* Поля вокруг текста */
            border: solid 1px black; /* Параметры рамки */
        }
        .layerRoom {
            margin-top: -460px;
            overflow: scroll; /* Добавляем полосы прокрутки */
            width: 150px; /* Ширина блока */
            height: 450px; /* Высота блока */
            padding: 5px; /* Поля вокруг текста */
            border: solid 1px black; /* Параметры рамки */
        }
        .control{
            margin-left:500px;
        }
        .control #message{
            width: 450px;
        }
        .messageSelf{
            text-align: right;
        }
        .message{
            text-align: left;
        }
        .roomtext{
            border: solid 1px black; /* Параметры рамки */
        }
        .roomtext:hover{
            color:blue;
        }
    </style>
<script>
    var room = document.getElementById('roomID').innerText;
    let user = document.getElementById('userID').innerText;
    let message = document.getElementById('message').innerText;
    function update(){
        //document.getElementsByClassName('layer')
        $(".layer").html("");
        //$('.layer').innerHTML="1";
        $.ajax({
            url: '/data.php',
            method: 'post',
            dataType:'json',
            data:{room_id:room},
            success:function (data){
                for(let i=0;i<data.length;i++){
                    if(data[i]['iduser']==user){
                        $('.layer').append("<div class = messageSelf>"+data[i]['message']+"</div>");
                    }
                    else{
                        $('.layer').append("<div class = message>"+data[i]['message']+"</div>");
                    }
                }
            }
        });

    }
</script>
</head>
<body>
<div class="layer" >
</div>

<div class="layerRoom" id = "room" >
    <?php
    $db = new DB();
    $mas[] = $db->SelectData("Select * from room");
    for($i=0;$i<=count($mas[0]);$i++){
        echo "<div class =roomtext  id =".$mas[0][$i]["id"].">".$mas[0][$i]["Name"]."</div>";
    }
    ?>
</div>
<div class = "control">
    <label for=""> User Name is <?php echo $_SESSION["user_name"]?></label>
    <input id = "message" placeholder="введите сообщение">
<button id = "send"> Отправить</button>
    <button id = "exit"> Выйти</button>
    <label id ="userID" hidden><?php echo $_SESSION["user_id"]?></label>
    <label id ="roomID" hidden><?php echo $_GET["room"]?></label>
</div>



<script src="jquery-3.6.1.min.js"></script>

<script>

    $(window).on('load',function(){
          setInterval(update,3000);
    });
    $('.roomtext').click(function (e) {
        window.location.href = 'http://chat/chat.php?room='+this.id;
    });
    $('#send').on('click',function () {
        var room = document.getElementById('roomID').innerText;
        let user = document.getElementById('userID').innerText;
        let message = document.getElementById('message').value;
        var data = [{userid: user},
            {room: room},
            {message: message}];
        $.ajax({
            url: '/send.php',
            method: 'post',
            data:{userid: user,
                room: room,
                message: message} ,
            success: function () {
                update();
            }
        });
    });
    $('#exit').on('click',function () {
        $.ajax({
            url: '/chat.php',
            method: 'post',
            data:{isDestroy:'ok'}
        });
    });
</script>
</body>
</html>