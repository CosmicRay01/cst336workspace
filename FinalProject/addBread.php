<?php
session_start();

if (!isset($_SESSION['username'])) { //validates that admin has indeed logged in
    
    header("Location: index.php");
    
}

 include("dbConnection.php");
 $conn = getDatabaseConnection();

function getDepartmentInfo(){
    global $conn;        
    $sql = "SELECT deptName, departmentId 
            FROM tc_department 
            ORDER BY deptName";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $records = $stmt->fetchAll();
    
    return $records;
    
}


if (isset($_GET['addUserForm'])){
    //the administrator clicked on the "Add User" button
    $n = $_GET['breadName'];
    $p = $_GET['priceId'];
    $i =  $_GET['ingredients'];
    $t = $_GET['typeId'];
    
    //"INSERT INTO `tc_user` (`userId`, `firstName`, `lastName`, `email`, `universityId`, `gender`, `phone`, `role`, `deptId`) VALUES (NULL, 'a', 'a', 'a', '1', 'm', '1', '1', '1');
    
    $sql = "INSERT INTO bread
            (breadName, priceId, ingredients, typeId)
            VALUES
            (:n, :p, :i, :t)";
    $namedParameters = array();
    $namedParameters[':n'] =  $n;
    $namedParameters[':p'] =  $p;
    $namedParameters[':i'] =  $i;
    $namedParameters[':t'] =  $t;
    
    $stmt = $conn->prepare($sql);
    $stmt->execute($namedParameters);
    
    echo "User has been added successfully!";
    header("Location: admin.php"); /* Redirect browser */
    exit();
            
}

?>

<!DOCTYPE html>
<html>
    <head>
        <style>
            @import url("css/style.css");
        </style>
        
        <title> Adding New User </title>
    </head>
    <body background="image.JPG">
        <div id = "page">

    <h1> Admin Section </h1>

    <fieldset>
        
        <legend> Add New Pastry </legend>
        
        <form>
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
                <input type="submit" name="addUserForm" value="Add User!"/>
        </form>
        
        <form action="admin.php">
            
            <input type="submit" value="Back" />
            
        </form>
        
    </fieldset>

    </div>
    </body>
</html>