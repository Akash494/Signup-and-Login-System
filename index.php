<?php
    require_once "./includes/config_session.inc.php";
    require_once "./includes/signup_view.inc.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="main.css">
    <title>Signup Page</title>
</head>
<body>

    <div class="container flex gap-14">

        <div class="card ml-[400px]">

            <div class="card_title">
                <h1>Create Account</h1>
                <span>Already have an account? <a href="login.php?">Log In</a></span>
            </div>

            <div class="form">
                <form action="./includes/signup.inc.php" method="post">
                    <?php
                        set_signup_data();     
                    ?>
                </form>
            </div>    
        </div>

        <!--This Section will show either the errors or the successful message-->
        <div class="show_error flex flex-col justify-start w-[400px] h-[400px]">
            <?php 
            check_signup_errors();
            ?>
        </div>
        
    </div>

</body>
</html>