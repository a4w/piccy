<?php
session_start();
$_SESSION['user'] = null;
unset($_SESSION['user']);
session_destroy();
header('Location: login.php');
