<?php

session_start();

include 'dbConnection.php';

$conn = getDatabaseConnection();

function displayCandy() {
    global $conn;
    $sql = "SELECT * 
            FROM bread
            WHERE breadId = " . $_GET['breadId'] ; 
    
    $statement = $conn->prepare($sql);
    $statement->execute();
    $candy = $statement->fetch(PDO::FETCH_ASSOC);
    return $candy;
}

function displayType($id) {
    global $conn;
    $sql = "SELECT * 
            FROM type
            WHERE typeId = " . $id ; 
    
    $statement = $conn->prepare($sql);
    $statement->execute();
    $candy = $statement->fetch(PDO::FETCH_ASSOC);
    return $candy;
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
        

        <title> Cypress Bakery Catalog </title>
        
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">

        <style>
            @import url("css/style.css");
    
        </style>
        
          <div id="title">
              Cypress Bakery Catalog 
        </div>  
        
    </head>
    
    <body  background="image.JPG">
        
       
        
        <br /><br />
        
        <div id='infoBox'>
        
        <?php
       
        $candy = displayCandy();
        $type = displayType($candy['typeId']);
        $price = displayPrice($candy['priceId']);
        
        echo" <h2>Bread Information: </h2>";
        echo "<br>";
        echo "Bread Name: " . ucfirst($candy['breadName']);
        echo "<br />";
        echo "Price: " . $price['priceValue'];
        echo "<br />";
        echo "Type of bread: " . $type['typeOfBread'];
        echo "<br>";
        echo "Ingredients: " . ucfirst($candy['ingredients']);
        echo "<br />";
        //echo "Brand: " ;
     /*
        // This is where Brand Name of Candy is located.
        
        $bName = $candy['brandId'];
        $sql = "SELECT brandName FROM brand WHERE brandId = '$bName'";
        $stmt = $conn->query($sql);	
        $brandResults = $stmt->fetchAll();
        foreach ($brandResults as $brand) 
        {
        	echo ucfirst($brand['brandName'])   . "<br />";

        }
        
        
      echo "Allergies: ";
      $aName = $candy['allergyId'];
      $sql = "SELECT allergyDesc FROM allergies WHERE allergyId = '$aName'";
      $stmt = $conn->query($sql);	
      $allergyName = $stmt->fetchAll();
      
       foreach ($allergyName as $allergies) 
       {
      	echo ucfirst($allergies['allergyDesc'])   . "<br />";
       } 
        */
        
        
        ?>
        
        </div>
        
        <br></br>
        
        <form action="admin.php">
            
            <input type="submit" value="Back" />
            
        </form>
        </div>
    </body>     
</html>