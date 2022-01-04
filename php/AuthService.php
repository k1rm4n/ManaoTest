<?php
session_start();
include_once 'PresetUser.php';
include_once 'User.php';

$errors = [];
$message;

if (!preg_match('/[A-Za-z0-9]{6,}/', $_POST['login']) || !preg_match('/[A-Za-z0-9]{6,}/', $_POST['pass'])){
    $errors[] = ['text' => "Логин или пароль не верный!"];
    echo json_encode(['errors' => $errors, 'message' => $message]);
} 
else {
    try{
        $user = new User();
        $file = file_get_contents('../json/data.json');
        $users = json_decode($file, true) ?? [];
        unset($file);
        $user = null;
    
        foreach($users as $item) {
            if($_POST['login'] == $item["login"] && md5($_POST['pass']) == $item["pass"]){
                $user = $item;
            }
        }
        if(!$user) {
            $errors[] = ['text' => "Логин или пароль не верный!"];
            echo json_encode(['errors' => $errors, 'message' => $message]);
            return;
        }
        $_SESSION["user"] = $user;

        $preset = new PresetUser('../json/data.json');

        $message = 'Данные загружены успешно!';
        echo json_encode(['errors' => $errors, 'message' => $message]);
    }
    catch(Exception $ex) {
        $errors[] = [$ex];
        exit('Ошибка записи');
    }
}
