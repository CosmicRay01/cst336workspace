<?php

session_start();

include 'dbConnection.php';

$conn = getDatabaseConnection();

function displayCandy() {
    global $conn;
    $sql = "SELECT * 
            FROM candy
            WHERE candyId = " . $_GET['candyId'] ; 
    
    $statement = $conn->prepare($sql);
    $statement->execute();
    $candy = $statement->fetch(PDO::FETCH_ASSOC);
    return $candy;
}



/*

function getCandyNames()
{
    global $conn;
    
    $sql= "SELECT brandName FROM `candy` c 
    JOIN brand b
    WHERE c.brandId=b.brandId";
    //AND c.brandId = " . $_GET['brandId'];
    
    $statement = $conn->prepare($sql);
    $statement->execute();
    $dName = $statement->fetch(PDO::FETCH_ASSOC);
    
    foreach($dName as $so)
    {
     return $so;
    }
       
    
      //return $bName;
    
    
}*/

function getAllergyName()
{
    global $conn;
    
    $sql= "SELECT allergyDesc FROM `candy` c
            JOIN allergies a
            WHERE c.allergyId=a.allergyId
            AND c.allergyId IS NOT NULL";
            
    
    $statement = $conn->prepare($sql);
    $statement->execute();
    $bName = $statement->fetch(PDO::FETCH_ASSOC);
    
    foreach($bName as $idk)
    {
        return ucfirst($idk);
    }
}

?>

<!DOCTYPE html>
<html>
    <div id="infoPage">
    <head>
        

        <title> Candy Info </title>
        
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">

        <style>
            @import url("css/style.css");
    
        </style>
        
          <div id="title">
              Candy Shop 
        </div>  
        
    </head>
    
    <body  background="mainImg2.jpg">
        
       
        
        <br /><br />
        
        <div id='infoBox'>
        
        <?php
       
        $candy = displayCandy();
       // $dName = getCandyNames();
        
        echo" <h2>Candy Information: </h2>";
        echo "<br>";
        echo "Candy Name: " . ucfirst($candy['candyName']);
        echo "<br />";
        echo "Calories: " . ucfirst($candy['caloriesId']);
        echo "<br />";
        echo "Type: " . ucfirst($candy['candyType']);
        echo "<br />";
        echo "Brand: " ;
     
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
        
        
        
        ?>
        
        </div>
        
        <br></br>
        
        <form action="index.php">
            
            <input type="submit" value="Back" />
            
        </form>
        </div>
    </body>     
</html>