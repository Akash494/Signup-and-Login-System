<?php

ini_set('session.use_only_cookies',1);
ini_set('session.use_strict_mode',1);

session_set_cookie_params(
    [
        'lifetime' => 1800,
        'domain' => 'localhost',
        'path' => '/',
        'secure' => true,
        'httponly' => true
    ]
);

session_start();

if(isset($_SESSION["user_id"])){

    // When user is logged in run this
    if(!isset($_SESSION['last_registration'])){
        regenerate_session_id_loggedin();
    }
    
    else{
        $interval = 60*30;
        if(time() - $_SESSION['last_registration'] >= $interval){
            regenerate_session_id_loggedin();
        }
    }

} 

else{
    // When user not logged in run this
    if(!isset($_SESSION['last_registration'])){
        regenerate_session_id();
    }
    
    else{
        $interval = 60 * 30;
        if(time() - $_SESSION['last_registration'] >= $interval){
            regenerate_session_id();
        }
    }
}

function regenerate_session_id(){

    session_regenerate_id(true);

    $_SESSION['last_registration'] = time();
}


function regenerate_session_id_loggedin(){
    $id = $_SESSION["user_id"];
    $username = $_SESSION["user_username"];

    session_regenerate_id(true);
    $newSessionId = session_create_id();
    $sessionId = $newSessionId . "_" . $_SESSION["user_id"];
    session_id($sessionId);
    
    $_SESSION['last_registration'] = time();
    $_SESSION["user_id"] = $id;
    $_SESSION["user_username"] = $username;
}