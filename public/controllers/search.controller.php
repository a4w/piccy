<?php
include('../../inc/Autoloader.php');

session_start();
header('Content-Type: application/json;');

use Mapper\UserMapper;
use Model\User;

$action = $_POST['action'] ?? null;
if (!array_key_exists('user', $_SESSION) || $_SESSION['user'] === NULL) {
    header('Location: login.php');
    exit();
}

$output = array("error" => false);

switch($action){
    case 'search':
        $users = UserMapper::getBySimilarUsername($_POST['sought-username']);
        $output['users'] = array();
        foreach($users as $user){
            $temp = array(  'userid' => $user->getUserID(),
                            'userProfilePicture' => $user->getProfilePicturePath(),
                            'username' => $user->getUsername());
            $output['users'][] = $temp;
        }
        break;
}

echo json_encode($output);

