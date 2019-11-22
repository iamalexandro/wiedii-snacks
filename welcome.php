<?php
include_once 'conection.php';
session_start();
if (!isset($_SESSION['user'])) {
  header('Location:shop.php');
}
//reconocer id del usuario
$id_user = $_GET['id_user'];
$sql_confirm = 'SELECT * FROM users WHERE id=?';
$sentence_confirm = $pdo->prepare($sql_confirm);
$sentence_confirm->execute(array($id_user));
$result_confirm = $sentence_confirm->fetch();

$name = $result_confirm['name'];

//reconocr producto
$arr_products=[];
// var_dump($arr_products);

$i=0;

if($_POST){
  $code = $_POST['code'];

  $sql_product = 'SELECT * FROM products WHERE code=?';
  $sentence_product = $pdo->prepare($sql_product);
  $sentence_product->execute(array($code));
  $result_product = $sentence_product->fetch();

  $nameProduct = $result_product['name'];
  $priceProduct = $result_product['price'];

  if($result_product){
    array_push($arr_products,$nameProduct,$priceProduct);
  }
}
var_dump($arr_products);

?>

<!doctype html>
<html lang="en">
<head>
  <div class="bootstrap adds">
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- navbar bootstrap -->
    <nav class="navbar navbar-light bg-light">
      <a class="navbar-brand">
        <img src="util/mainlogoW.svg" width="50%" height="50%" class="d-inline-block align-top" alt="">
      </a>
    </nav>
  </div>
  <title>Wiedii Snacks Welcome</title>
</head>
<body>
  <div class="container">
    <center>
      <h6 class="text-uppercase mt-2"><b><?php echo $name ?></b> </h6>
      <i>What are you gonna buy ?</i>
      <!-- Formulario -->
        <form method="POST">
          <input type="text" class="form-control mt-2 inline-block float-left" name="code" placeholder="code product" id="focus">
          <button class="btn btn-info mt-4 inline-block float-left ml-2">ADD</button>
        </form>

      <!-- confirmar compra -->
      <!-- <form action="GET" action=purchase.php?id_user=<?php echo $id_user?>>
        <button class="btn btn-success mt-4 inline-block float-right">BUY</button>
      </form> -->
      <!-- salir -->
      
    </center>

    <div class=adds-javascript>
      <!-- Optional JavaScript -->
      <!-- jQuery first, then Popper.js, then Bootstrap JS -->
      <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
      <script src="js/jquery.js"></script>
      <script src="js/functions.js"></script>
    </div>

</body>

</html>