<?php

session_start();

include 'dbConnection.php';

$conn = getDatabaseConnection();



?>

<!DOCTYPE html>
<html>

    
    <head>
        
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
        <link href="css/style.css" media="all" rel="stylesheet" type="text/css"/>

        <title> Shopping Cart </title>
        
      <div id="title">
              Candy Shop 
        </div>  
    </head>
    
    <body background="mainImg2.jpg">


        <br /><br />
        
        
        <div id="checkoutPage">
        
        
        
        <?php
        
        

      echo "<div id='cartBox'>";
            
            echo"<h2>Current item(s) in cart: </h2><br>";
            echo "<hr>";
           $displaycart = $_SESSION['cart'];
           $displayprice = $_SESSION['price'];
       
    
           for($i = 0 ; $i < count($displaycart) ; $i++) 
           {
                echo $displaycart[$i] . "&nbsp;&nbsp;    $" . $displayprice[$i];
                echo '<br>';
                echo "<hr>";
           }
           
           
           
           if($displayprice!=NULL)
           {
                echo  "<strong>Total: $". array_sum($displayprice)."</strong>" ;
    
           }
           else
           {
               echo "Cart is empty.";
           }
 
            
         echo "</div>";
         
        
       
       
         echo "<div id='shoppingButtons'>";
         echo "<form action='index.php' style='display:inline'>
                    <input type='submit' value='Back' />
                </form>
         
                <form method='POST' action='' style='display:inline'>
                    <input type='submit' name='clearButton'  value='Clear Shopping Cart'>
                </form>";
        
         if (isset($_POST['clearButton'])) 
            { 
               session_destroy();
               echo "<meta http-equiv='refresh' content='0'>";
            } 
      
        echo "</div>";
        ?>
         </div>
      
        
        
    </body>     
</html>