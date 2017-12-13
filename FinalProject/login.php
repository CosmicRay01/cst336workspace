<!DOCTYPE html>
<html>
    <head>
         <style>
            @import url("css/style.css");
        </style>
        <title>Admin Login Page </title>
        <style type="text/css">
        input[type=submit] {
            padding: 10px 20px;
            font-size: 25px;
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
         <div id="page">
        
       <h1> Admin Login </h1>
        
        <form method="POST" action="loginProcess.php">
            
            Username: <input type="text" name="username"/> <br />
            
            Password: <input type="password" name="password"/> <br /> <br>
            
            <input type="submit" name="login" value="Login"/>
            
            
        </form>
         </div>

    </body>
</html>