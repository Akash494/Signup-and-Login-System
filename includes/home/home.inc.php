<?php

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $file = $_FILES['userfile'];
    // var_dump($file);
    $file_name = $file['name'];
    $file_tmp_name = $file['tmp_name'];
    $file_size = $file['size'];
    $file_error = $file['error'];
    $filetype_ = $file['type'];

    $file_ext = explode('.',$file_name);
    $file_actual_ext = strtolower(end($file_ext));

    $allowed = array('jpg','jpeg','png','pdf');

    require_once "../dbh.inc.php";
    require_once "../config_session.inc.php";
    require_once "./home_model.inc.php";

    // Error Handling
    $error = [];

    if(!in_array($file_actual_ext, $allowed)){
        $error["invalid_format"] = "wrong file format!";
    }

    if(!$file_error == 0){
        $error["error_upload"]  = "Error Uploading!";
    }
    
    // This is in bytes i.e 10^6 is 1 mb
    if(!($file_size < 10000000)){
        $error["large_size"] = "File of size greater than 10 mb not allowed";
    }
    
    if($error){
        $_SESSION["errors"] = $error;
        header("Location: ../../Home.php");
        die();
    }

    //create a unique number which is current time in micro seconds -> uniqid('',true)
    $id = $_SESSION['user_id'];
    $file_new_name = "profileImg". $id . "." . $file_actual_ext;
    $fileDestination = '../uploads/' . $file_new_name;

    move_uploaded_file($file_tmp_name, $fileDestination);
    
    set_image_status($pdo);

    header("Location: ../../Home.php");
    die();
}

else{
    header("Location: ../../Home.php");
    die();
}