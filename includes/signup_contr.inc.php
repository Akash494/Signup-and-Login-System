<?php

declare(strict_types=1);

function is_input_empty(string $username,string $pwd, string $email){
    if(empty($username) || empty($pwd) || empty($email)){
        return true;
    } else{
        return false;
    }
}

function is_email_invalid(string $email){
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        return true;
    } else{
        return false;
    }
}

function is_username_taken(object $pdo, string $username){
    if(get_username($pdo, $username)){
        return true;
    }
    else{
        return false;
    }
}

function is_email_registerd(object $pdo, string $email){
    if(get_email($pdo, $email)){
        return true;
    }
    else{
        return false;
    }   
}

function is_password_small(string $pwd){
    if(strlen($pwd) < 5){
        return true;
    }
    else{
        return false;
    }
}

function is_conditions_checked(){
    if(isset($_POST['checkbox']) && $_POST['checkbox'] == 'yes'){
        return true;
    }
    else{
        return false;
    }
}

function create_user(object $pdo, string $username, string $pwd, string $email){
    set_user($pdo, $username, $pwd, $email);
}

function fetch_user_data(object $pdo, string $username){
    return get_user_data($pdo, $username);
}

function create_user_image_data(object $pdo, int $user_id){
    set_user_image_data($pdo, $user_id);
}