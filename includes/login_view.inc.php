<?php

declare(strict_types=1);

function is_logged_in(){
    if(!isset($_SESSION["user_id"]) && !isset($_GET["loggedout"])){
        ?>
            <div class="bg-white rounded-sm font-bold h-[30px] flex items-center justify-center">
                You are not logged in!
            </div>
        <?php
    }
    else{
        ?>
            <div class="bg-white rounded-sm font-bold h-[30px] flex items-center justify-center">
                You logged Out successfully!
            </div>
        <?php
    }
}

function check_login_errors(){

    if(isset($_SESSION['error_login'])){
        $errors = $_SESSION['error_login'];

        echo '<h2 class="font-bold ml-[120px]"> Errors </h2>';
        foreach($errors as $error){
            echo '<br>';
            echo "<div class='bg-[#ffffff] h-[40px] w-[300px] flex items-center justify-center rounded-md'>";
            echo "<p class='text-black'>" . $error . "</p>";
            echo '</div>';
        }

        unset($_SESSION['error_login']);
    }

    // else if(isset($_GET['signup']) && $_GET['signup'] === 'success'){
    //     echo "<div class='bg-[#ffffff] h-[40px] w-[300px] flex items-center justify-center'>";
    //     echo "<p class='text-black'>" . "Signedup Successfully!" . "</p>";
    //     echo '</div>';
    // }
}