<?php
session_start();
include 'dbConnection.php';
$conn = getDatabaseConnection();

// Order by Price function
function orderPrice($count) {
    global $conn;
    if($count == 1) {
        $sql = "SELECT * FROM `candy` ORDER BY `candy`.`priceId` ASC";
    }
    else {
        $sql = "SELECT * FROM `candy` ORDER BY `candy`.`priceId` DESC"; 
    }
    $statement = $conn->prepare($sql);
    $statement->execute();
    $candies = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $candies;
}

// Order by Calories function
function orderCal($count) {
    global $conn;
    if($count == 1) {
        $sql = "SELECT * FROM `candy` ORDER BY `candy`.`caloriesId` ASC"; 
    }
    else {
        $sql = "SELECT * FROM `candy` ORDER BY `candy`.`caloriesId` DESC";
    }
    $statement = $conn->prepare($sql);
    $statement->execute();
    $candies = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $candies;
}

// Show Only Type function
function showType($count2) {
    global $conn;
    if($count2 == 1) {
        $sql = "SELECT * FROM candy 
        WHERE candyType = 'sweet'
        ORDER BY candyName ASC";         
    }
    elseif($count2 == 2) {
        $sql = "SELECT * FROM candy 
        WHERE candyType = 'sour'
        ORDER BY candyName ASC";
    }
    elseif($count2 == 3) {
        $sql = "SELECT * FROM candy 
        WHERE candyType = 'chocolate'
        ORDER BY candyName ASC";
    }
    elseif($count2 == 4) {
        $sql = "SELECT * FROM candy
        WHERE candyType = 'spicy'
        ORDER BY candyName ASC";
    }
    else {
        $sql = "SELECT * FROM candy 
        ORDER BY candyName ASC";
    }

    $statement = $conn->prepare($sql);
    $statement->execute();
    $candies = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $candies;
}

// Display Candy function
function displayCandy() {
    global $conn;
    $sql = "SELECT * 
            FROM candy
            ORDER BY candyName ASC";
    $statement = $conn->prepare($sql);
    $statement->execute();
    $candies = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $candies;
}
?>

<!DOCTYPE html>
<html>
  <div id="page"> 
    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
        
        <style>
            @import url("css/style.css");
        </style>
        
        <title>
            Candy Shop
        </title>
        
        <script>
            // Confirm Add to Cart function
            function confirmAddToCart(candyName) {
                return confirm("Are you sure you want to add " + candyName + " to shopping cart?");
            }
        </script>
        
        <meta charset="utf-8"/>
        
        <div id="title">
            Candy Shop 
        </div>
    </head>
    
    <body background="mainImg2.jpg">
        <br></br>
        <div id="mainPage">
            <br>
            <p>
                <a href="shoppingcart.php">
                    <img src="viewcart.png" alt="View Shopping Cart" style="height: 120px">
                </a>
            </p>
            <br>
            <form action='index.php' style='display:inline' method="get">
                <input type="submit" name="candyType" value="Show Only" />
                <input type="radio" id="sweet" name="type" value="1">
                <label for="sweet">Sweet</label>
                <input type="radio" id="sour" name="type" value="2">
                <label for="sour">Sour</label>
                <input type="radio" id="chocolate" name="type" value="3">
                <label for="chocolate">Chocolate</label>
                <input type="radio" id="spicy" name="type" value="4">
                <label for="spicy">Spicy</label>
            </form>
            <br />
            <br />
            <form action='index.php' style='display:inline' method="get">
                <input type="submit" name="cal" value="Order by Calories" /> 
                <input type="radio" id="ascending" name="ordering" value="1">
                <label for="ascending">Ascending</label>
                <input type="radio" id="descending" name="ordering" value="2">
                <label for="descending">Descending</label>
            </form>
            <br />
            <br />
            <form action='index.php' style='display:inline' method="get">
                <input type="submit" name="price" value="Order by Price" />
                <input type="radio" id="ascending1" name="ordering" value="1">
                <label for="ascending1">Ascending</label>
                <input type="radio" id="descending1" name="ordering" value="2">
                <label for="descending1">Descending</label>
            </form>
            <br />
            <form 
                action='index.php' method="get">
            </form>
            <br />
            
            <?php
            // Sorts Candy Shop's inventory based off Radio Buttons
            $order = $_GET['ordering'];
            $type = $_GET['type'];
            
            if(isset($_GET['candyType'])) {
                $candies = showType($type);
            }
            elseif(isset($_GET['cal'])) {
                $candies = orderCal($order);
            }
            elseif(isset($_GET['price'])) {
                $candies = orderPrice($order);
            }
            else {
                $candies = displayCandy();
            }
            
            // Displays Candy Shop's inventory
            foreach($candies as $candy) {
                $candyname = $candy['candyName'];
                echo "<h3><a href='candyInfo.php?candyId=".$candy['candyId']."'> $candyname </a></h3>";
                echo "Calories: ".$candy['caloriesId'];
                echo str_repeat("&nbsp;", 3); 
                echo " Price: $".$candy['priceId'];
                echo str_repeat("&nbsp;", 3); 
                echo "<form action='addtocart.php' style='display:inline' onsubmit='return confirmAddToCart(\"".$candy['candyName']."\")'>
                         <input type='hidden' name='candyId' value='".$candy['candyId']."' />
                         <input type='submit' value='Add To Cart'>
                      </form>";
                echo "<br>";
                echo"<hr>";
            }
            ?>
        </div>
    </body>   
</html>