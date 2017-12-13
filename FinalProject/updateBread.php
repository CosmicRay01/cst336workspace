<?php
session_start();

if (!isset($_SESSION['username'])) { //validates that admin has indeed logged in
    
    header("Location: index.php");
    
}

 include("dbConnection.php");
 $conn = getDatabaseConnection();



function getUserInfo($breadId) {
    global $conn;    
    $sql = "SELECT * 
            FROM bread
            WHERE breadId = $breadId";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $record = $stmt->fetch();
    //print_r($record);
    return $record;
}

if (isset($_GET['updateUserForm'])) { //admin has submitted form to update user
    //UPDATE `bread` SET `breadName` = 'Bollio', `ingredients` = 'Flour' WHERE `bread`.`breadId` = 1
    $n = $_GET['breadName'];
    $p = $_GET['priceId'];
    $i =  $_GET['ingredients'];
    $t = $_GET['typeId'];
    $sql = "UPDATE `bread` SET `breadName` = '$n', `priceId` = '$p', `typeId` = '$t', `ingredients` = '$i' WHERE `bread`.`breadId` = 1";
	$namedParameters = array();
	$namedParameters[":fName"] = $_GET['breadName'];
	$namedParameters[":lName"] = $_GET['priceId'];
	$namedParameters[":bType"] = $_GET['typeId'];
	$namedParameters[":i"] = "Flour";
	$namedParameters[":breadId"] = $_GET['breadId'];
    $stmt = $conn->prepare($sql);
    $stmt->execute($namedParameters);
    
    header("Location: admin.php"); /* Redirect browser */
    exit();
}



if (isset($_GET['breadId'])) {
    
    $userInfo = getUserInfo($_GET['breadId']);
    
    
}



?>

<!DOCTYPE html>
<html>
     <div id="page">
    <head>
        <title> Admin: Updating Bread Information </title>
        <style>
            @import url("css/style.css");
            input[type=submit] {
            padding: 10px 20px;
            font-size: 20px;
            cursor: pointer;
            text-decoration: none;
            outline: none;
            color: white;
            background: black;
            border: 5px;
            border-radius: 20%;
            float: left;
        }
        
        input[type=text], input[type=password] {
            font-size: 20px;
            }
        </style>
    </head>
    <body background="image.JPG">

    <h1> Admin Section </h1>
    <h2> Updating Bread Info </h2>

    <fieldset>
        
        <legend> Update User </legend>
        
        <form>
            
            <input type="hidden" name="breadId" value="<?=$userInfo['breadId']?>" />
            <input type="hidden" name="breadId" value="<?=$userInfo['breadId']?>" />
            Bread Name: <input type="text" name="breadName" required value="<?=$userInfo['breadName']?>" /> <br>
            Price:   <select name="priceId">
                        <option value=""> Select One </option>
                        <option value = 1>$0.25</option>
                        <option value = 2>$0.50</option>
                        <option value = 3>$1.00</option>
                        <option value = 4>$1.50</option>
                        <option value = 5>$2.00</option>
                        <option value = 6>$2.50</option>
                    </select>
            Type:   <select name="typeId">
                        <option value=""> Select One </option>
                        <option value = 1>Mexican</option>
                        <option value = 2>French</option>
                        <option value = 3>Muffin</option>
                        <option value = 4>Cookie</option>
                    </select>
            Ingredients: <input type="text" name="ingredients" required value="<?=$userInfo['ingredients']?>"/> <br>
            <hr>
            <input type="submit" name="updateUserForm" value="Update User!"/>
        </form>
         <br>
         <br>
        <form action="admin.php">
            
            <input type="submit" value="Back" />
            
        </form>

        
    </fieldset>
  

    </body>
     </div>
</html>