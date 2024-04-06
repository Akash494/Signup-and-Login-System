<?php

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    // $checked = isset($_POST['checkbox']);

    try{
        // Estabilish a database connection
        // to interact with the database we include 'singup_model.inc.php' file
         // to do anything with the data user submitted we include 'singup_model.inc.php' file
        require_once 'dbh.inc.php';
        require_once 'signup_model.inc.php';
        //require_once 'signup_view.inc.php';
        require_once 'signup_contr.inc.php';

        //ERROR HANLDLING
        $errors = [];

        if(is_input_empty($username, $password, $email)){
            $errors["empty_input"] = "Fill in all fields!";
        }

        if(is_email_invalid($email)){
            $errors["invalid_email"] = "Invalid email used!";
        }

        if(is_username_taken($pdo, $username)){
            $errors["username_taken"] = "username already taken!";
        }

        if(is_email_registerd($pdo, $email)){
            $errors["email_used"] = "Email already registered!";
        }

        if(is_password_small($password)){
            $errors["small_password"] = "Minimum password length is 5!";
        }

        if(!is_conditions_checked()){
            $errors["condition_check"] = "Must agree to the terms!";
        }

        // to include the sessions
        require_once 'config_session.inc.php';

        if($errors){
            $_SESSION["error_signup"] = $errors;

            $signup_data = [
                "username" => $username,
                "email" => $email,
            ];

            $_SESSION['signup_data'] = $signup_data;

            //go to home page if errors
            header("Location: ../index.php");
            die();
        }

        // if no error then create the user
        create_user($pdo, $username, $password, $email);

        // Fetching the data of the user just created;
        
        $result = fetch_user_data($pdo, $username);
        $user_id = $result['id'];

        create_user_image_data($pdo, $user_id);

        $pdo = null;
        $stmt = null;

        header("Location: ../index.php?signup=success");
        die();
        
    }
    catch(PDOException $e){
        die("Connection Failed :" . $e->getMessage());
    }

}
else{
    header("Location: ../index.php");
    die();
}