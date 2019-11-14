<?php
//URL ejemplo
//echo 'edit.php?id=1name=franco&document=12345&email=franco@gmail.com';

$id = $_GET['id'];
$name = $_GET['name'];
$price = $_GET['price'];
$code = $_GET['code'];

echo '<br>id: ' . $id;
echo '<br>name: ' . $name;
echo '<br>price: ' . $price;
echo '<br>code: ' . $code;

//conexion

//cargo la conexion
include_once'conection.php';

$sql_edit = 'UPDATE products SET name=?, price=?, code=? WHERE id=?';
$sentence_edit = $pdo->prepare($sql_edit);
$sentence_edit->execute(array($name,$price,$code,$id));

header('location:adminProducts.php');

?>
