<?php
include_once 'User.php';

class PresetUser
{
    private $path;

    public function getPath()
    {
        return $this->path;
    }
    
    public function __construct($jsonPath){
        $this->path = $jsonPath;
    }

    public function updateFile(User $user){
        $file = file_get_contents($this->getPath());
        $users = json_decode($file, true);        
        unset($file);     
        $users[] = $this->getOption($user);                     
        file_put_contents($this->getPath(), json_encode($users));  
    }


    public function getOption(User $user)
    {
        return [
            'login' => $user->getLogin(), 
            'pass' => $user->getPass(),
            'confirm_pass' => $user->getConfirmPass(),
            'name' => $user->getName(),
            'mail' => $user->getMail(),
        ];
    }

    public function createUser(User $user){
        try{
            $file = file_get_contents($this->getPath());
            $users = json_decode($file, true) ?? [];
            unset($file);

            foreach($users as $item){
                if($user->getMail() == $item["mail"] || $user->getLogin() == $item["login"]){
                    exit('Такой логин или почта уже существует');
                }
            }
            
            $this->updateFile($user);
        }
        catch(Exception $ex){
            exit('Ошибка записи');
        }
    }
}