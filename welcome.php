<?php
include_once 'conection.php';
session_start();
if (!isset($_SESSION['user'])) {
  header('Location:shop.php');
}
date_default_timezone_set('America/Bogota');
//reconocer id del usuario
$id_user = $_GET['id_user'];
$sql_confirm = 'SELECT * FROM users WHERE id=?';
$sentence_confirm = $pdo->prepare($sql_confirm);
$sentence_confirm->execute(array($id_user));
$result_confirm = $sentence_confirm->fetch();
$name = $result_confirm['name'];
$debt = $result_confirm['debt'];

$bill;
//cart
if ($_POST) {
  $code = $_POST['code'];

  $sql_product = 'SELECT * FROM products WHERE code=?';
  $sentence_product = $pdo->prepare($sql_product);
  $sentence_product->execute(array($code));
  $result_product = $sentence_product->fetch();

  $nameProduct = $result_product['name'];
  $priceProduct = $result_product['price'];
  $id_product = $result_product['id'];

  //insert cart
  $sql_cart = 'INSERT INTO cart (name,price,id_product,code,id_user) VALUES (?,?,?,?,?)';
  $sentence_cart = $pdo->prepare($sql_cart);
  $sentence_cart->execute(array($nameProduct, $priceProduct, $id_product, $code, $id_user));

  //show cart
  $sql_cart2 = 'SELECT * FROM cart';
  $sentence_cart2 = $pdo->prepare($sql_cart2);
  $sentence_cart2->execute();
  $result_cart = $sentence_cart2->fetchAll();

  //live cost
  foreach ($result_cart as $items) {
    $bill += $items['price'];
  }
}

if ($_GET) {
  $id_button = $_GET['id_button'];
  if ($id_button == 'back') {
    //clean cart and exit
    $sql_cart = 'DELETE FROM cart WHERE id_user=?';
    $sentence_cart = $pdo->prepare($sql_cart);
    $sentence_cart->execute(array($id_user));
    header('location:logoutShop.php');
  }
}

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
      <h6 class="text-uppercase mt-2"><b><?php echo $name ?></b> <b style="color:red;"> <?php echo $debt ?> $ </b></h6>
      <i>What are you gonna buy ?</i>
      <!-- Formulario -->
      <div class="container">
        <form method="POST">
          <input type="text" class="form-control mt-3 iniline-block float-left" name="code" placeholder="code product" id="focus" style="width:130px" required>
          <button class="btn btn-info inline-block float-right mt-3 ml-2">ADD</button>
        </form>
      </div>
      <!-- list of products -->
      <?php $msg ?>

      <?php $i = 1 ?>
      <?php foreach ($result_cart as $data) : ?>
        <?php $name = $data['name'] ?>
        <?php $name = strtoupper($name) ?>
        <?php $price = $data['price'] ?>
        <?php $msg .= $i . '. ' . $name . ' - ' . $price . ' $ ' . $line ?>
        <?php $i++ ?>
      <?php endforeach ?>

      <textarea class="mt-3" rows="6" cols="25"> <?php echo $msg ?> </textarea>
      <!-- <div class="panel panel-default">
        <div class="panel-body">A Basic Panel</div>
      </div> -->


      <!-- confirmar compra -->
      <form method="GET" action="welcome.php">
        <a href="bill2.php?id_user=<?php echo $id_user ?>" class="btn btn-success mt-2 inline-block float-right" id="buy">BUY</a>
      </form>
      <h6 class="inline-block float-right mr-2 mt-3" style="color:green"> <?php echo $bill ?> $</h6>
      <!-- salir -->
      <form action="GET" action="welcome.php">
        <a href="welcome.php?id_user=<?php echo $id_user ?>&id_button=back" class="btn btn-danger mt-2 inline-block float-left">BACK</a>
      </form>

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