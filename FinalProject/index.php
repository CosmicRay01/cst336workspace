<?php
session_start();


include 'dbConnection.php';
$conn = getDatabaseConnection();

function displayPastries() {
    global $conn;
    $sql = "SELECT * 
            FROM bread";
    $statement = $conn->prepare($sql);
    $statement->execute();
    $users = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $users;
}

function displayPastry($Id) {
    global $conn;
    $sql = "SELECT * 
            FROM bread
            WHERE breadId=$Id";
    $statement = $conn->prepare($sql);
    $statement->execute();
    $user = $statement->fetch(PDO::FETCH_ASSOC);
    return $user['breadName'];
}

function displayPrice($id) {
    global $conn;
    $sql = "SELECT * 
            FROM price
            WHERE priceId = " . $id ; 
    
    $statement = $conn->prepare($sql);
    $statement->execute();
    $candy = $statement->fetch(PDO::FETCH_ASSOC);
    return $candy;
}
?>
<!DOCTYPE html>
<html>
    <div id="page">
    <head>
         <style>
            @import url("css/style.css");
        </style>
        <title>Cypress Bakery Catalog</title>
    </head>
    <body background="image.JPG">

        <h1>Cypress Bakery Catalog</h1>
        <h2>1267 Broadway Ave, Seaside, CA 93955</h2></h2>
        
        <form action="login.php">
            <input type="submit" value="Admin Login" />
        </form>
        <br>
        <hr>
        <?php
        $users = displayPastries();
        
        foreach($users as $user) {
            $name = displayPastry($user['breadId']);
            $price = displayPrice($user['priceId']);
            
            echo "<a href='breadInfo.php?breadId=".$user['breadId']."'> $name </a> ";
            echo "<a> price: ". $price['priceValue'] ."</a>";
            
            echo"<br><hr>";
        }
        ?>
    </div> 
    </div> 
    </body> 
</html>