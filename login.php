<?php
    require_once "./includes/config_session.inc.php";
    require_once "./includes/login_view.inc.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="login_style.css">
    <title>Login Page</title>
</head>
<body>

    <div class="container flex gap-14">

        <div class="card ml-[400px]">

            <div class="card_title">
                <h1>Login To Account</h1>
                <span>Don't have an account? <a href="index.php">Sign Up</a></span>
            </div>

            <div class="form">
                <form action="./includes/login.inc.php" method="post">
                    <input type="text" name="username" id="username" placeholder="UserName" />

                    <input type="password" name="password" placeholder="Password" id="password" />

                    <button >Log In</button>
                </form>
            </div>
            
        </div>

        <!--This Section will show either the errors or the successful message-->
        <div class="show_error flex flex-col justify-start w-[400px] h-[310px]">
            <?php 
                is_logged_in();
                check_login_errors();
            ?>
        </div>
        
    </div>

</body>
</html>