<?php 
$login = trim(filter_var($_POST['login'],FILTER_SANITIZE_SPECIAL_CHARS));
$username = trim(filter_var($_POST['username'],FILTER_SANITIZE_SPECIAL_CHARS));
$email = trim(filter_var($_POST['email'],FILTER_SANITIZE_SPECIAL_CHARS));
$password = trim(filter_var($_POST['password'],FILTER_SANITIZE_SPECIAL_CHARS));


if(strlen($login)<3){
    echo"Длина логина должна быть больше 3 символов!";
    exit;
}
if(strlen($username)<2){
    echo"Длина имени должна быть больше 2 символов!";
    exit;
}
if(strlen($email)<4 && str_contains($email, '@')){
    echo"email не может быть короче 4 символов и должен иметь знак @!";
    exit;
}
if(strlen($password)<6){
    echo"Длина пароля должна быть больше 6 символов!";
    exit;
}

//Password
$salt = '4567890(*(*#$#%^#&Dffdl';
$password = md5($salt.$password);
// DB
require "db.php";
// INSERT
$sql = 'INSERT INTO users(login, username, email, password) VALUES(?, ?, ?, ?)';
$query = $pdo->prepare($sql);
$query->execute([$login, $username, $email, $password]);

header('Location: /');
