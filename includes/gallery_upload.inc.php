<?php

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    if(empty($_POST['filename'])){
        $filename = "gallery";
    }
    else{
        $filename = strtolower(str_replace(" ","-",$_POST['filename']));
    }

    $filetitle = $_POST['filetitle'];
    $filedesc = $_POST['filedesc'];
    $file = $_FILES['file'];

    $uploaded_file_name = $file['name'];
    $file_tmp_name = $file['tmp_name'];
    $file_size = $file['size'];
    $file_error = $file['error'];
    $filetype = $file['type'];

    $file_ext = explode('.',$uploaded_file_name);
    $file_actual_ext = strtolower(end($file_ext));

    $allowed = array('jpg','jpeg','png','pdf');

    require_once "dbh.inc.php";
    require_once "config_session.inc.php";
    require_once "./home/home_model.inc.php";

    // Error Handling
    $error = [];

    if(!in_array($file_actual_ext, $allowed)){
        $error["invalid_format"] = "wrong file format!";
    }

    if(!$file_error === 0){
        $error["error_upload"]  = "Error Uploading!";
    }
    
    // This is in bytes i.e 10^6 is 1 mb
    if(!($file_size < 10000000)){
        $error["large_size"] = "File of size greater than 10 mb not allowed";
    }
    
    if($error){
        print_r($error);
        header("Location: ../Home.php");
        die();
    }

    $file_new_name = $filename . uniqid('',true) . "." . $file_actual_ext;
    $fileDestination = './uploads/' . $file_new_name;

    $count_rows = count_rows($pdo);
    $order = $count_rows + 1;

    upload_image_info($pdo, $filetitle, $filedesc, $file_new_name, $order);

    move_uploaded_file($file_tmp_name, $fileDestination);

    $pdo = null;
    $stmt = null;

    header("Location: ../Home.php");
    die();
}
else{
    header("Location: ../Home.php");
}