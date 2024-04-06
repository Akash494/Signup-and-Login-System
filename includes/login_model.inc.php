<?php

declare(strict_types=1);

function get_users(object $pdo, string $username){
    $query = "select * from users where username =:username;";
    $stmt = $pdo -> prepare($query);
    $stmt -> bindParam(':username',$username);
    $stmt -> execute();
    $result = $stmt -> fetch(PDO::FETCH_ASSOC);
    return $result;
}