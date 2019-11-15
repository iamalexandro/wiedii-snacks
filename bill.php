<?php
include_once 'conection.php';

//reconocer usuario
$id_user = $_GET['id_user'];
$sql_user = 'SELECT * FROM users WHERE id=?';
$sentence_user = $pdo->prepare($sql_user);
$sentence_user->execute(array($id_user));
$result_user = $sentence_user->fetch();
//reconocer producto
$id_product = $_GET['id_product'];
$sql_product = 'SELECT * FROM products WHERE id=?';
$sentence_product = $pdo->prepare($sql_product);
$sentence_product->execute(array($id_product));
$result_product = $sentence_product->fetch();
//comprobar
echo $result_user['name'] . '<br>';
echo 'You did buy: ' . $result_product['name'] . '<br>';
echo 'And it cost: ' . $result_product['price'];

//INSERT INTO purchase

$cost = $result_product['price'];

$sql_purchase = 'INSERT INTO purchase (id_user,id_product,cost) VALUES (?,?,?)';
$sentence_purchase = $pdo->prepare($sql_purchase);
$sentence_purchase->execute(array($id_user,$id_product,$cost));


?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Wiedii Snacks Bill</title>
  </head>
  <body>
    <h1>Congrats fat</h1>

    <a href="login1view.php">
      <button>FINISH</button>
    </a>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" 
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" 
    crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" 
    crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" 
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" 
    crossorigin="anonymous"></script>
  </body>
</html>
