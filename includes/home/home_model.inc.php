<?php
declare(strict_types=1);
// include "../dbh.inc.php";

function check_state(object $pdo){
    $query = "select * from images where user_id = :user_id;";
    $stmt = $pdo -> prepare($query);
    $id = $_SESSION['user_id'];
    $stmt -> bindParam(':user_id',$id);
    $stmt -> execute();
    $result = $stmt -> fetch(PDO::FETCH_ASSOC);
    return $result['state'];
}

function set_image_status(object $pdo){
    $query = "update images set state = :state where user_id = :user_id;";
    $stmt = $pdo -> prepare($query);
    $state = 1;
    $id = $_SESSION['user_id'];
    $stmt -> bindParam(':state',$state);
    $stmt -> bindParam(':user_id',$id);
    $stmt -> execute();
}

function reset_image_status(object $pdo){
    $query = "update images set state = :state where user_id = :user_id;";
    $stmt = $pdo -> prepare($query);
    $state = 0;
    $id = $_SESSION['user_id'];
    $stmt -> bindParam(':state',$state);
    $stmt -> bindParam(':user_id',$id);
    $stmt -> execute();
}

function count_rows(object $pdo){
    $query = "select * from gallery;";
    $stmt = $pdo -> prepare($query);
    $stmt -> execute();
    // $results = $stmt -> fetchAll(PDO::FETCH_ASSOC);
    // counting the number of rows
    $rowCount = $stmt->rowCount();
    return $rowCount;
}

function upload_image_info(object $pdo, string $title, string $desc, string $name, string $order){
    $query = "insert into gallery (title,`desc`,name,`order`) values (:title,:desc,:name,:order);";
    $stmt = $pdo -> prepare($query);
    
    $stmt -> bindParam(':title',$title);
    $stmt -> bindParam(':desc',$desc);
    $stmt -> bindParam(':name',$name);
    $stmt -> bindParam(':order',$order);
    $stmt -> execute();

    $rowCount = $stmt->rowCount();
    
    if ($rowCount > 0) {
        echo "Data inserted successfully. Rows affected: $rowCount<br>";
        
        // Optionally, retrieve the last inserted ID
        $lastInsertedId = $pdo->lastInsertId();
        echo "Last inserted ID: $lastInsertedId<br>";
    } else {
        echo "No data inserted.<br>";
    }
}

function get_images(object $pdo){
    $query = "select * from gallery;";
    $stmt = $pdo -> prepare($query);
    $stmt -> execute();
    $results = $stmt -> fetchAll(PDO::FETCH_ASSOC);
    return $results;
}



