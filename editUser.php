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

echo 'id entrante: '.$id.'<br>';
$new_debt = $result_user['debt'] - $pay;

if($new_debt == 0){
  echo 'IF EMTRY<br>';
  //cambio todos los purchase de ese usuario a pagos (no se enviarian al correo)
  $data = 1;
  $sql_paid = 'UPDATE purchase SET paid=? WHERE id_user=?';
  $sentence_paid = $pdo->prepare($sql_paid);
  $sentence_paid->execute(array($data,$id));
  $result_paid = $sentence_paid->fetchAll();
}

//actualizo el usuario 
$sql_edit = 'UPDATE users SET name=?, document=?, email=?, debt=? WHERE id=?';
$sentence_edit = $pdo->prepare($sql_edit);
$sentence_edit->execute(array($name,$document,$email,$new_debt,$id));

header('location:adminUsers.php?id='.$id);
?>