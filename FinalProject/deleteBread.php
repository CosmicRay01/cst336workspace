<?php

    include("dbConnection.php");
    $conn = getDatabaseConnection();
    $sql = "DELETE FROM bread 
            WHERE breadId = " . $_GET['breadId'];

    $stmt = $conn->prepare($sql);
    $stmt->execute();
    
    header("Location: admin.php");
    
?>