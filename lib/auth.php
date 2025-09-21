<?php
$login = trim(filter_var($_POST['login'],FILTER_SANITIZE_SPECIAL_CHARS));
$password = trim(filter_var($_POST['password'],FILTER_SANITIZE_SPECIAL_CHARS));
if(strlen($login)<4){
    echo"Длина логина должна быть больше 4 символов!";
    exit;
}
if(strlen($password)<6){
    echo"Длина пароля должна быть больше 6 символов!";
    exit;
}

$salt = '4567890(*(*#$#%^#&Dffdl';
$password = md5($salt.$password);
//DB
require "db.php";

// Auth user
$sql = 'SELECT id FROM users WHERE login = ? AND password = ? ';
$query = $pdo->prepare($sql);
$query->execute([$login, $password]);
if($query->rowCount()==0){
    echo"Такго пользователя нет!";
}
else{
    setcookie('login',$login, time()+3600*24*30, "/");
    header('Location: /user.php');
}