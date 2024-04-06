<?php
    require_once "./includes/dbh.inc.php";
    require_once "./includes/config_session.inc.php";
    require_once "./includes/home/home_model.inc.php";
    require_once "./includes/home/home_view.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Home Page</title>
</head>
<body>
    <div class=" container h-[100vh] w-[100vw] overflow-x-hidden">

        <?php   
            view_user_info($pdo);
        ?>
    
        <form action="./includes/home/home.inc.php" method="POST" enctype="multipart/form-data">
            <input type="file" name="userfile" />
            <input type="submit" value="Upload" class="cursor-pointer bg-red-500 px-2 py-1"/>
        </form>
    
        <br>
    
        <!-- <button onclick="resetImageStatus()">Reset the image</button> -->
        
        <form action="./includes/home/delete_image.inc.php" method="post">
            <input type="submit" value="Delete the image" class="cursor-pointer bg-red-500 px-2 py-1"/>
        </form>
    
        <br>
    
        <div>
            <?php
                check_upload_errors();
            ?>
        </div>
        
        <div class="flex flex-col items-center">

            <!-- Container 1 -->
            <h1 class="text-2xl font-bold">Gallery</h1>
            <?php
            echo '<div class="w-[890px] bg-orange-100 min-h-[280px] flex flex-wrap ">';

            $results = get_images($pdo);
            foreach($results as $row){
                $filename = $row['name'];
                $filetitle = $row['title'];
                $filedesc = $row['desc'];

            echo '
                <div class="flex flex-col mt-5 ml-6 mb-4 border-2 border-black min-h-[200px] max-h-[230px] w-[152px] bg-white">
                    <div class="h-[150px] w-[150px] bg-cover" style= "background-image : url(includes/uploads/'.$row['name'].');"></div>
                    <h3 class="font-bold">'.$filetitle.'</h3>
                    <div>'.$filedesc.'</div>
                </div>
            ';
            }
                // <div class="flex flex-col mt-5 ml-6 mb-4 border-2 border-black h-[250px] w-[152px] bg-slate-500">
                // <div class="h-[150px] w-[150px] bg-red-400"></div>
                // <h3>title</h3>
                // <div>desc</div>
                
            echo '</div>';
            ?>
    <!-- view_gallery_images($pdo); -->
            </div>
        </div>
        
        <br>

        <!-- Container 2 -->
        <?php
            view_upload_image_form();
        ?>
        
        <a href="./includes/logout_inc.php"><button class="px-2 py-2 bg-red-500">Log Out</button></a>

    </div>
    
    <!-- <div id='responseMessage'></div> -->
    
    <script>
        function resetImageStatus() {
            // Create a new XMLHttpRequest object
            var xhr = new XMLHttpRequest();
            
            // Define the PHP script URL
            var url = './includes/home/reset_image.inc.php';
            
            // Open a POST request to the PHP script
            xhr.open('POST', url, true);
            
            // Set the Content-Type header for the request
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            
            // Send the request with any necessary data (if required)
            xhr.send();
            
            // Optional: Handle response from the server
            xhr.onreadystatechange = function () {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        // Request was successful
                        document.getElementById('responseMessage').innerHTML = xhr.responseText;
                    } else {
                        // There was an error
                        console.error('Error:', xhr.status);
                    }
                }
            };
        }
    </script>
</body>
</html>