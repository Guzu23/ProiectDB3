<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['credential']) && isset($_POST['password'])) {
        $credential = htmlspecialchars($_POST['credential']);
        $password = htmlspecialchars($_POST['password']);

        if ($credential === 'admin' && $password === 'admin') {
            $_SESSION["loggedin"] = true;
            $_SESSION["username"] = 'admin';
            $_SESSION["user_type"] = 'admin'; 
            header("location: index.php");
            exit();
        } else {
            $xml = simplexml_load_file('users.xml');

            foreach ($xml->user as $user) {
                if (($user->username == $credential || $user->email == $credential) && password_verify($password, (string)$user->password)) {
                    $_SESSION["loggedin"] = true;
                    $_SESSION["username"] = (string)$user->username;
                    $_SESSION["user_type"] = (string)$user->user_type; 
                    header("location: index.php");
                    exit();
                }
            }

            header("location: login.php?error=invalid_credentials");
            exit();
        }
    } else {
        header("location: login.php?error=missing_credentials");
        exit();
    }
} else {
    header("location: login.php");
    exit();
}
?>
