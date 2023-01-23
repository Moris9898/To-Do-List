<?php
include "db_connect.php";
$id = isset($_GET['do']) && is_numeric($_GET['do']) ? intval($_GET['do']) : 0 ;

if(isset($id)) {
    $stmt = $conn->prepare("DELETE FROM todo WHERE id = :bid");
    $stmt->bindParam(":bid", $id);
    $stmt->execute();
    header("Location: index.php");
} else {
    header("Loaction: index.php");
}