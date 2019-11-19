<?php
include_once 'conection.php';

$id = $_GET['id'];
$name = $_GET['name'];
$document = $_GET['document'];
$email = $_GET['email'];
$pay = $_GET['pay'];

$sql_user = 'SELECT * FROM users WHERE id=?';
$sentence_user = $pdo->prepare($sql_user);
$sentence_user->execute(array($id));
$result_user = $sentence_user->fetch();

$new_debt = $result_user['debt'] - $pay;

//actualizo el usuario 
$sql_edit = 'UPDATE users SET name=?, document=?, email=?, debt=? WHERE id=?';
$sentence_edit = $pdo->prepare($sql_edit);
$sentence_edit->execute(array($name,$document,$email,$new_debt,$id));

if($new_debt = 0){
  //cambio todos los purchase de ese usuario a pagos (no se enviarian al correo)
  $sql_paid = 'UPDATE purchase SET paid=? WHERE id=?';
  // $sentence_
}

header('location:adminUsers.php?id='.$id);
?>