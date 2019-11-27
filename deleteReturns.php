<?php

include_once 'conection.php';

$id = $_GET['id'];
$sql_delete = 'DELETE FROM returns1 WHERE id=?';
$sentence_delete = $pdo->prepare($sql_delete);
$sentence_delete->execute(array($id));

header('location:adminReturns.php');
?>