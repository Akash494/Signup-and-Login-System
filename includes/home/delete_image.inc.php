<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    include '../dbh.inc.php'; 
    include '../config_session.inc.php';
    include './home_model.inc.php';

    $sessionid = $_SESSION['user_id'];
    $filename = "../uploads/profileImg".$sessionid."*";
    // Find the file which has this path
    // output something like -> ../uploads/profileImg9.jpg
    $fileinfo = glob($filename);
    // split with .. 
    $file_ext = explode('.',$fileinfo[0]);
    $file_actual_ext = end($file_ext);

    $file = "../uploads/profileImg".$sessionid.".".$file_actual_ext;

    if(!unlink($file)){
        echo "unable to Delete the file!";
    }
    else{
        echo "File Deleted!";
    }

    reset_image_status($pdo);

    header("Location: ../../Home.php");
    die();
}
else{
    header("Location: ../../Home.php");
    die();
}