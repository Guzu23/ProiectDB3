<?php
session_start();
require_once 'classes.php';

$xml = simplexml_load_file('users.xml');

if (isset($_COOKIE['username']) && !isset($_SESSION['username'])) {
    $_SESSION['username'] = $_COOKIE['username'];
}

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $user_type = '';

    foreach ($xml->user as $user) {
        if ($user->username == $username) {
            $user_type = (string) $user->user_type;
            break;
        }
    }

    if ($user_type == 'admin') {
        $currentUser = new Administrator($user_type, $username);
    } else {
        $currentUser = new Membru($user_type, $username);
    }
} else {
    $username = '';
    $user_type = '';
    $currentUser = null;
}
?>
