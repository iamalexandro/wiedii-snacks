<?php
include_once 'conection.php';
session_start();
if (!isset($_SESSION['user'])) {
  header('Location:shop.php');
}
$id_user = $_GET ['id_user'];
$id_item = $_GET['id_item'];

$sql_delete = 'DELETE FROM cart WHERE id=?';
$sentence_delete = $pdo->prepare($sql_delete);
$sentence_delete->execute(array($id_item));

header('location:welcome.php?id_user='.$id_user);
