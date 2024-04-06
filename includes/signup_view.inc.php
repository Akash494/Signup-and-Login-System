<?php

declare(strict_types=1);

function set_signup_data(){

    if( isset($_SESSION['signup_data']['username']) && !isset($_SESSION["error_signup"]["username_taken"]) )
    {
        echo '<input type="text" name="username" id="username" placeholder="UserName" value = " '. $_SESSION["signup_data"]["username"] .'" />' ;
    }
    else{
        echo '<input type="text" name="username" id="username" placeholder="UserName" />';
    }
    
    echo '<input type="password" name="password" placeholder="Password" id="password" />';
    
    if(isset($_SESSION['signup_data']['email']) && !isset($_SESSION["error_signup"]["invalid_email"]) && !isset($_SESSION["error_signup"]["email_used"]) )
    {
        echo '<input type="email" name="email" placeholder="Email" id="email" value = " '. $_SESSION["signup_data"]["email"] .'" />' ;
    }
    else{
        echo '<input type="email" name="email" placeholder="Email" id="email" />' ;
    }

    echo '<button >Sign Up</button>';
    echo '<div class="flex gap-5 mt-[8px]">';

    echo '<input type="checkbox" name="checkbox" id="terms" class="bg-[#e2e2e2]" value="yes" /> <span class="text-[0.9rem]">I have read and agree to the <a href="#" />Terms of Service</a></span>';

    echo '</div>';

    unset($_SESSION['signup_data']);
}


function check_signup_errors(){

    if(isset($_SESSION['error_signup'])){
        $errors = $_SESSION['error_signup'];

        echo '<h2 class="font-bold ml-[120px]"> Errors </h2>';
        foreach($errors as $error){
            echo '<br>';
            echo "<div class='bg-[#ffffff] h-[40px] w-[300px] flex items-center justify-center rounded-md'>";
            echo "<p class='text-black'>" . $error . "</p>";
            echo '</div>';
        }
        unset($_SESSION['error_signup']);
    }

    else if(isset($_GET['signup']) && $_GET['signup'] === 'success'){
        echo "<div class='bg-[#ffffff] h-[40px] w-[300px] flex items-center justify-center'>";
        echo "<p class='text-black'>" . "Signedup Successfully!" . "</p>";
        echo '</div>';
    }
}