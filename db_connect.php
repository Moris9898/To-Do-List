<?php
$host ="localhost";
$name = "root";
$pass="";
$db_name="to_do_list";
try {
    $conn = new PDO("mysql:host=$host;dbname=$db_name", $name, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Connected Failed " . $e->getMessage();
} 