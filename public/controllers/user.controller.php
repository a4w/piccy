<?php
include('../../inc/Autoloader.php');

header('Content-Type: application/json;');

use Mapper\UserMapper;
use Model\User;

$action = $_POST['action'] ?? null;


$output = array("error" => false);

switch($action){
    case 'register':
        $username = $_POST['username'] ?? null;
        $password = $_POST['password'] ?? null;
        $email = $_POST['email'] ?? null;
        $bio = $_POST['bio'] ?? null;
        $user = UserMapper::getByUsername($username);
        if($user !== null){
            $output['error'] = true;
            break;
        }
        $user = new User(null, $username, password_hash($password, PASSWORD_BCRYPT), 1, $email, $bio, null);
        UserMapper::add($user);
        mkdir(__DIR__ . '/../user_pictures/user_' . $user->getUsername(), 0777);
        session_start();
        $_SESSION['user'] = UserMapper::getByUsername($username);
        $_SESSION['login-time'] = time();
        break;
    case 'login':
        $username = $_POST['username'] ?? null;
        $password = $_POST['password'] ?? null;
        $user = UserMapper::getByUsername($username);
        if($user === null || !password_verify($password, $user->getPassword())){
            $output['error'] = true;
            break;
        }
        session_start();
        $_SESSION['user'] = $user;
        $_SESSION['login-time'] = time();
        break;
}

echo json_encode($output);
