<?php
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
        $user = new User(null, $username, password_hash($password, PASSWORD_BCRYPT), $countryID, $email, $bio, null);
        UserMapper::add($user);
        break;
}

echo json_encode($output);
