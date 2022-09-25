<?php
$servername = 'db';
$username = 'root';
$password = 'example';
$database = 'csy2028database';


try {
    // creating connection
    $pdo = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    // set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } 
  catch(PDOException $e) {
    echo "Connection failed : " . $e->getMessage();
  }



?>