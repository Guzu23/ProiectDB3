<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['email']) && isset($_POST['user_type'])) {
        $newUsername = htmlspecialchars($_POST['username']);
        $newPassword = htmlspecialchars($_POST['password']);
        $email = htmlspecialchars($_POST['email']);
        $userType = htmlspecialchars($_POST['user_type']); 
        
        $xml = simplexml_load_file('users.xml');
        foreach ($xml->user as $user) {
            if ($user->username == $newUsername) {
                header("location: register.php?error=username_taken");
                exit();
            }
        }
        
        $newUser = $xml->addChild('user');
        $newUser->addChild('username', $newUsername);
        $newUser->addChild('password', password_hash($newPassword, PASSWORD_DEFAULT));
        $newUser->addChild('email', $email);
        $newUser->addChild('user_type', $userType);
        
        $xml->asXML('users.xml');
        header("location: login.php?success=registered");
        exit();
    } else {
        header("location: register.php?error=missing_registration_data");
        exit();
    }
} else {
    header("location: login.php");
    exit();
}
?>
