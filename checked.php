<?php
include "db_connect.php";
if(isset($_POST['id'])) {
    $id = $_POST['id'];
    if(empty($id)) {
        echo 'error';
    } else {
        $todo = $conn->prepare("SELECT id, checked FROM todo WHERE id=?");
        $todo->execute(array($id));
        $to = $todo->fetch();
        $uid = $to['id'];
        $uchecked = $to['checked'];
        $check = $uchecked ? 0 : 1 ;
        $stmt = $conn->query("UPDATE todo SET checked=$check WHERE id=$uid ");
        if($stmt) {
            echo $uchecked;
        } else {
            echo "error";
        }
        $conn = null;
        exit();
    }
} else {
    header("Location: index.php");
}
