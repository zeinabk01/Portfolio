<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = json_decode(file_get_contents("user.json"));

    $user = null;

    foreach ($data as $userData){
        //check if user exists
        if($userData->userName === $_POST["userName"] && $userData->password === $_POST["password"]){
            $user = $userData;
            break;
        }
    }
    session_start();
    if($user){
        //user was found
        
        $_SESSION['user'] = $user;
        header('Location: galleryDisplay.php');
    }else{
        //user was not found
        $_SESSION['error'] = 'Invalid credentials';
        header('Location: loginForm.php');
    }
}
?>
