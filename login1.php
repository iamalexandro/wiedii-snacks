<?php
include_once 'conection.php';

$id = $_POST['id'];

$sql_confirm = 'SELECT * FROM users WHERE id=?';
$sentence_confirm = $pdo->prepare($sql_confirm);
$sentence_confirm->execute(array($id));
$result_confirm = $sentence_confirm->fetch();

if (!$result_confirm) {
  echo 'Invalid User';
  die();
}

header('location:welcome.php');
?>