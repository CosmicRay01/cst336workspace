<?php

include '../../../dbConnection.php';

$conn = getDatabaseConnection();

function getDeviceTypes() {
    global $conn;
    $sql = "SELECT DISTINCT(deviceType)
            FROM `tc_device` 
            ORDER BY deviceType";
    
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    foreach ($records as $record) {
        
        echo "<option> "  . $record['deviceType'] . "</option>";
        
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Lab 5: Device Search </title>
    </head>
    <body>
        
        <h1> Technology Center: Checkout System </h1>
        
        <form>
            Device: <input type="text" name="deviceName" placeholder="Device Name"/>
            Type: 
            <select name="deviceType">
                <option>Select One</option>
                <?=getDeviceTypes()?>
            </select>
            
            <input type="checkbox" name="available" id="available">
            <label for="available"> Available </label>
            
            <input type="submit" value="Search!" >
        </form>
        

    </body>
</html>