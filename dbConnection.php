<?php


function getDatabaseConnection($dbname='heroku_e025c2bcd9ffba75c'){
    
    $host = 'localhost';//cloud 9
    // $dbname = 'tcp';
    $username = 'root';
    $password = '';
    
    //using different database variables in Heroku
    if  (strpos($_SERVER['HTTP_HOST'], 'herokuapp') !== false) {
        $url = parse_url(getenv("CLEARDB_DATABASE_URL"));
        $host = $url["us-cdbr-iron-east-03.cleardb.net"];
        $dbname = substr($url["heroku_e025c2bcd9ffba75c"], 1);
        $username = $url["b4ec28ac117d04"];
        $password = $url["e77c8602"];
    } 
    
    //creates db connection
    $dbConn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    
    //display errors when accessing tables
    $dbConn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    return $dbConn;
    
}




?>