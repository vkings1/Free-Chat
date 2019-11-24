<?php
    
     //set a dsn
     $dsn = "mysql:host=localhost;dbname=chatsys";

    $username = 'root';
    $password = '';
   
     try {

        //connection to the database
         $conn = new PDO($dsn, $username, $password);
         // set the PDO error mode to exception
         $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);       
     } catch (PDOExceptio $e) {
        {
            echo "Connection failed: " . $e->getMessage();
        }
        $conn = null;
     }


?>