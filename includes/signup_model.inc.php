<?php

declare(strict_types=1);

function get_username(object $pdo, string $username){
    $query = "select username from users where username =:username;";
    $stmt = $pdo -> prepare($query);
    $stmt -> bindParam(':username',$username);
    $stmt -> execute();
    $result = $stmt -> fetch(PDO::FETCH_ASSOC);
    return $result;
}

function get_email(object $pdo, string $email){
    $query = "select username from users where email =:email;";
    $stmt = $pdo -> prepare($query);
    $stmt -> bindParam(':email',$email);
    $stmt -> execute();
    $result = $stmt -> fetch(PDO::FETCH_ASSOC);
    return $result;
}

function set_user(object $pdo, string $username, string $pwd, string $email){
    $query = "insert into users ( username, pwd, email ) values (:username, :pwd, :email);";
    $stmt = $pdo -> prepare($query);

    $options = [
        'cost' => 12
    ];
    $hashed_password = password_hash($pwd, PASSWORD_BCRYPT, $options);

    $stmt -> bindParam(':username',$username);
    $stmt -> bindParam(':pwd',$hashed_password);
    $stmt -> bindParam(':email',$email);
    $stmt -> execute();
}

function get_user_data(object $pdo, string $username){
    $query = "select * from users where username =:username;";
    $stmt = $pdo -> prepare($query);
    $stmt -> bindParam(':username',$username);
    $stmt -> execute();
    $result = $stmt -> fetch(PDO::FETCH_ASSOC);
    return $result;
}

function set_user_image_data(object $pdo, int $user_id){
    $query = "insert into images ( user_id, state ) values (:userid, :state);";
    $stmt = $pdo -> prepare($query);
    $stmt -> bindParam(':userid',$user_id);
    $state = 0;
    $stmt -> bindParam(':state', $state);
    $stmt -> execute();
}