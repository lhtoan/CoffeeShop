<?php
    function connectdb() {
        $host = "localhost";
        $username = "root";
        $password = "";
        $dbname = "coffee_shop";

        try {
            $conn = @new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // echo "Connected successfully";
        } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
            return $conn;
    }
    
?>