<?php
try {
//connectie database
    $pdo = new PDO("sqlite:../CRUD-DB.sqlite");
}catch(PDOException $e){
    echo $e->getMessage();
}
$ID = $_GET['ID'];
$sql = "DELETE FROM CRUD WHERE ID = $ID";
$stmt = $pdo->prepare($sql);
$stmt->execute();
header("location: ../index.php");