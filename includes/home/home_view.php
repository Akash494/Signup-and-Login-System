<?php
// This file will be included in the HOme.php file

declare(strict_types=1);

function view_user_info(object $pdo){

    if(check_state($pdo) == 0){
        echo '
        <div class="h-[70px] w-[400px] bg-orange-100 mt-[20px] flex justify-evenly m-auto items-center">
         
            <img src="./includes/uploads/default_profile.png" alt="user_image" height="60" width="60" class="rounded-md">

            <div class="text-center font-bold text-2xl">
                Welcome '.$_SESSION["user_username"].'
            </div>
        
        </div> ';
    }
    else{
        // Finding the Extension of the file
        $sessionid = $_SESSION['user_id'];
        $filename = "./includes/uploads/profileImg".$sessionid."*";
        $fileinfo = glob($filename);
        $file_ext = explode('.',$fileinfo[0]);
        $file_actual_ext = end($file_ext);
        $file = "profileImg" . $sessionid . "." . $file_actual_ext;

        echo '
        <div class="h-[70px] w-[400px] bg-orange-100 mt-[20px] flex justify-evenly m-auto items-center">
         
            <img src="./includes/uploads/'.$file.' " alt="user_image" height="60" width="60" class="rounded-md">

            <div class="text-center font-bold text-2xl">
                Welcome '.$_SESSION["user_username"].'
            </div>
        
        </div> ';
    }
}

function check_upload_errors(){
    if(isset($_SESSION["errors"])){
        {   
            ?>
            <div class="text-center">
                Errors
            </div>
            <?php
        }
        $errors = $_SESSION["errors"];
        foreach($errors as $error){
            echo $error;
        }

        unset($_SESSION["errors"]);
    }
}

function view_upload_image_form(){
    if(isset($_SESSION['user_id'])){
        echo '<div class="flex flex-col items-center">

            <h1 class="text-2xl font-bold">Upload Images</h1>
            <div class="w-[890px] bg-orange-100 h-[300px] border-2 flex justify-center items-center">

                <form action="./includes/gallery_upload.inc.php" method="post" enctype="multipart/form-data" class="flex flex-col gap-6">
                    <input type="text" name="filename" placeholder="File Name...">
                    <input type="text" name="filetitle" placeholder="File Title...">
                    <input type="text" name="filedesc" placeholder="File Description...">
                    <input type="file" name="file"/>
                    <input type="submit" placeholder="Upload" class=" bg-white px-3 py-1 cursor-pointer">
                </form>

            </div>
        </div>';
    }
}
