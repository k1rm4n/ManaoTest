<?php
include_once 'PresetUser.php';

$errors = [];
$message;


if(strlen($_POST['pass']) < 6 && strlen($_POST['confirm_pass']) < 6){
    $errors[] = ['text' => "Укажите пароль! (более 6 символов)", 'name' => "pass"];
}

if (!preg_match('/^[A-Za-z0-9-_]{2,}$/i', $_POST['login'])){
    $errors[] = ['text' => "Укажите логин (более 6 символов) или такой логин уже существует!", 'name' => "login"];
} 

if(!preg_match('/[A-Za-z0-9]/', $_POST['pass'])){
    $errors[] = ['text' => "Пароль должен состоять из букв, цифр!", 'name' => "pass"];
} 
if(!preg_match('/[@#$\.%^&+=]/', $_POST['pass'])){
    $errors[] = ['text' => "Пароль должен состоять из спец. символов", 'name' => "pass"];
} 
if(!preg_match('/[A-Za-z0-9]{6,}/', $_POST['confirm_pass']) || $_POST['confirm_pass'] != $_POST['pass']){
    $errors[] = ['text' => "Повторите пароль!", 'name' => "confirm_pass"];
} 
if(!preg_match('/^(?:[a-z0-9]+(?:[-_.]?[a-z0-9]+)?@[a-z0-9_.-]+(?:\.?[a-z0-9]+)?\.[a-z]{2,5})$/i', $_POST['e-mail'])){
    $errors[] = ['text' => "Укажите e-mail или такой e-mail уже существует!", 'name' => "e-mail"];
} 
if(!preg_match('/[A-Za-z]{2,}/', $_POST['name'])){
    $errors[] = ['text' => "Укажите имя! (более 2 символов)", 'name' => "name"];
}
if(count($errors) == 0){
    $user = new User();
    $user->setLogin($_POST['login']);
    $user->setPass(md5($_POST['pass']));
    $user->setConfirmPass(md5($_POST['confirm_pass']));
    $user->setMail($_POST['e-mail']);
    $user->setName($_POST['name']);
    $user->save();

    $message = 'Данные загружены успешно!';
}

echo json_encode(['errors' => $errors, 'message' => $message]);