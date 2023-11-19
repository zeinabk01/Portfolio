<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    session_start();
    //json data import
    $data = json_decode(file_get_contents("user.json"));

    //extract data from form
    $userName = $_POST["userName"];
    $fullName = $_POST["fullName"];
    $password = $_POST["password"];
    $sex = $_POST["sex"];
    $dob = $_POST["dob"];

    //required validation fields
    $requiredFields = ["userName", "fullName", "password", "sex", "dob"];
    $errors = [];

    //empty fields validation
    foreach ($requiredFields as $field) {
        if (empty($_POST[$field])) {
            $errors[$field] = ucfirst($field) . " is required.";
        }
    }

    //password validation (P@ssw0rd)
    if(!preg_match('/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[^\da-zA-Z]).{8,}$/', $password)){
        $errors["password"] = 'Password is invalid';
    }

    // username validation
    if (!filter_var($userName, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'userName is invalid';
    }

    if($errors === []){
        //no errors found

        //check if userName is unique
        foreach ($data as $user) {
            if ($user->userName == $_POST["userName"]) {
                //userName is found
                $_SESSION['error'] = 'Username already found';
                header("Location: signupForm.php");
                exit;
            }
        }
    
        //add new user
        $newUser = (object)[
            "userName" => $userName,
            "fullName" => $fullName,
            "password" => $password,
            "sex" => $sex,
            "dob" => $dob
        ];
    
        $data[] = $newUser;

        file_put_contents("user.json", json_encode($data, JSON_PRETTY_PRINT));
    
        header("Location: loginForm.php?success=signupSuccessful");
        exit;
    }else{
        //errors are found
        // Redirect to signup page with error messages
        $_SESSION['error'] = $errors;
        header("Location: signupForm.php");
        exit;
    }
}
?>
