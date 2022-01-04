<?php
session_start();
    if(!$_SESSION["user"]){
        header('Location: Authorization.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .user {
            height: 100vh;
            width: 100vw;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f2f2f2;
        }

        .user__wrapper {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #fff;
            width: 600px;
            padding: 20px 15px;
            border-radius: 8px;
            box-shadow: 0px 2px 2px rgba(0, 0, 0, .45);
        }

        .user__hello {
            font-family: "Arial", sans-serif;
        }

        .user__exit {
            border: none;
            cursor: pointer;
            width: 150px;
            height: 40px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            background: rgb(60, 123, 196);
        }
    </style>
</head>
<body>
    <div class="user">
        <div class="user__wrapper">
            <h1 class="user__hello">Hello, <strong><?=$_SESSION["user"]["login"]?></strong></h1>
            <button class="user__exit">Выйти</button>
        </div>
    </div>

    <script>
        var button = document.querySelector('button')
        button.onclick = function(){
            location.href = "Authorization.php"
            session_destroy()
        }
    </script>
</body>
</html>