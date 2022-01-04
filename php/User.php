<?php
include_once 'PresetUser.php';

class User
{
    private $login;
    private $pass;
    private $confirm_pass;
    private $mail;
    private $name;
    
    public function setLogin($v)
    {
        if($v == ""){
            throw new Exception('Введите имя!');
        }
        $this->login = $v;
    }

    public function setPass($v)
    {
        if($v == ""){
            throw new Exception('Введите пароль!');
        }

        $this->pass = $v;
    }

    public function setConfirmPass($v)
    {
        if($v == ""){
            throw new Exception('Повторите введение пароля!');
        }

        $this->confirm_pass = $v;
    }

    public function setMail($v)
    {
        if($v == ""){
            throw new Exception('Введите e-mail!');
        }

        $this->mail = $v;
    }

    public function setName($v)
    {
        if($v == ""){
            throw new Exception('Введите пароль!');
        }

        $this->name = $v;
    }

    public function getLogin()
    {
        return $this->login;
    }

    public function getPass()
    {
        return $this->pass;
    }

    public function getConfirmPass()
    {
        return $this->confirm_pass;
    }

    public function getMail()
    {
        return $this->mail;
    }

    public function getName()
    {
        return $this->name;
    }

    public function save()
    {
        $preset = new PresetUser('../json/data.json');
        $preset->createUser($this);
    }
}
