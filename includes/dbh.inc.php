<?php
    $dsn = "mysql:host=localhost;dbname=my_testing_sql";
    $dbusername = "root";
    $dbpassword = "pass123";

    try{
        $pdo = new PDO($dsn,$dbusername,$dbpassword);
        $pdo -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOEXCEPTION $e){
        echo "Connection to the Database failed :" . $e->getMessage();
    }