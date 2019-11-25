<?php
include_once 'conection.php';
session_start();
if (!isset($_SESSION['user'])) {
  header('Location:shop.php');
}
date_default_timezone_set('America/Bogota');
$actual_date = date("Y-m-d H:i:s");
$id_user = $_GET['id_user'];
//consulta cart
$sql_cart = 'SELECT * FROM cart';
$sentence_cart = $pdo->prepare($sql_cart);
$sentence_cart->execute();
$result_cart = $sentence_cart->fetchAll();
// var_dump($result_cart);

$money = 0;
//registro compras
foreach ($result_cart as $items) {
  $id_item = $items['id_product'];
  $cost_item = $items['price'];

  $sql_purchase = 'INSERT INTO purchase (id_user,id_product,cost,date1) VALUES (?,?,?,?)';
  $sentence_purchase = $pdo->prepare($sql_purchase);
  $sentence_purchase->execute(array($id_user, $id_item, $cost_item, $actual_date));
  
  $money += $cost_item;
}

$sql_user = 'SELECT * FROM users WHERE id=?';
$sentence_user = $pdo->prepare($sql_user);
$sentence_user->execute(array($id_user));
$result_user = $sentence_user->fetch();

$debt = $result_user['debt'];
$debt += $money;

// UPDATE USER DEBT
$sql_update = 'UPDATE users SET debt=? WHERE id=?';
$sentence_update = $pdo->prepare($sql_update);
$sentence_update->execute(array($debt, $id_user));

header('location:email.php?id_user='.$id_user);
