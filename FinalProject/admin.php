<?php
session_start();

if (!isset($_SESSION['username'])) { //checks whether admin has logged in
    
    header("Location: index.php");
    exit();
    
}

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
    return $user['breadName']. " ". $user['breadNam'];
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
        
        <title>Admin Page </title>
        
        <script>
            function confirmDelete(breadName) {
                return confirm("Are you sure you want to\ndelete " + breadName + " from the catalog?");
            }
        </script>
    </head>
    <body  background="image.JPG">
    <div id="mainPage">
        <h1> Cypress Bakery Catalog </h1>
        <h2> ADMIN PAGE</h2>
        
        <hr>
        
        <form action="addBread.php">
            
            <input type="submit" value="Add New Pastry" />
            
        </form>
         <br />
         <br>
          <form action="logout.php">
            <input type="submit" value="Logout" />
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
             echo "<form action='updateBread.php' style='display:inline' onsubmit='return'>
             <input type='hidden' name='breadId' value='".$user['breadId']."' />
                     <input type='submit' value='Update'>
                  </form>";
            //echo "[<a href='updateBread.php?breadId=".$user['breadId']."'> Update </a> ]";
            echo "<form action='deleteBread.php' style='display:inline' onsubmit='return confirmDelete(\"".$user['breadName']."\")'>
                     <input type='hidden' name='breadId' value='".$user['breadId']."' />
                     <input type='submit' value='Delete'>
                  </form>";
            echo"<br><hr>";
        }
        ?>
    </div> 
    </div> 
    </body> 
</html>