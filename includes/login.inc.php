<?php

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $username = $_POST['username'];
    $password = $_POST['password'];

    try{
        require_once 'dbh.inc.php';
        require_once 'login_model.inc.php';
        require_once 'login_contr.inc.php';

        //ERROR HANLDLERS

        $errors = [];

        if(is_input_empty($username, $password)){
            $errors["empty_input"] = "Fill in all fields!";
        }

        // Getting user information from our database
        $result = get_users($pdo, $username);

        if(is_username_wrong($result)){
            $errors["incorrect_username"] = "Incorrect Username!";
        }

        $options = ['cost' => 12];
        $hashedPwd = password_hash($password,PASSWORD_BCRYPT,$options);

        if(!is_username_wrong($result) && is_password_wrong($password, $result['pwd'])){
            $errors['incorrect_password'] = "Incorrect password!";
        }

        // to include the sessions
        require_once 'config_session.inc.php';

        if($errors){
            $_SESSION["error_login"] = $errors;

            //go to home page if errors
            header("Location: ../login.php?errors");
            die();
        }

        // Creating a new session id using the user id
        $newSessionId = session_create_id();
        $sessionId = $newSessionId . "_" . $result["id"];
        session_id($sessionId);

        $_SESSION["user_id"] = $result["id"];
        $_SESSION["user_username"] = htmlspecialchars($result["username"]);

        // Coded to make sure to start the session time from when user logged in .
        $_SESSION['last_registration'] = time();


        // if no error then login the user into the website
        header("Location: ../Home.php?login=success");

        // Closing the connections
        $pdo = null;
        $stmt = null;

        die();
        
    }
    catch(PDOException $e){
        die("Connection Failed :" . $e->getMessage());
    }

}
else{
    header("Location: ../login.php?invalid_page_access");
    die();
}