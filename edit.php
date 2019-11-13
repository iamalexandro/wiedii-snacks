<?php
//URL ejemplo
//echo 'edit.php?id=1name=franco&document=12345&email=franco@gmail.com';

$id = $_GET['id'];
$name = $_GET['name'];
$document = $_GET['document'];
$email = $_GET['email'];

echo '<br>id: ' . $id;
echo '<br>name: ' . $name;
echo '<br>document: ' . $document;
echo '<br>email: ' . $email;

//conexion

//cargo la conexion
include_once'conection.php';

$sql_edit = 'UPDATE users SET name=?, document=?, email=? WHERE id=?';
$sentence_edit = $pdo->prepare($sql_edit);
$sentence_edit->execute(array($name,$document,$email,$id));

header('location:admin.php');
