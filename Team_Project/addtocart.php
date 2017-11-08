<?php

session_start();

include 'dbConnection.php';

$conn = getDatabaseConnection();

function displayCandy() {
    global $conn;
    $sql = "SELECT * 
            FROM candy
            WHERE candyId = " . $_GET['candyId'];
    $statement = $conn->prepare($sql);
    $statement->execute();
    $candy = $statement->fetch(PDO::FETCH_ASSOC);
    return $candy;
}

    $candy = displayCandy();
    
    $candyname = $candy['candyName'];
    
    
    $_SESSION['cart'][] = $candyname;

       
    header("Location: index.php");
        
        

?>
