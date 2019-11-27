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

//si tengo objetos en el carrito listarlos
$active = false;
$bill = 0;
//agregar item, SI YA HAY UN ELEMENTO E N EL CARRITO +1 amount
if ($_POST) {
  $code = $_POST['code'];
  //verifico si existe el producto en el carrito
  $sql_cartE = 'SELECT * FROM cart WHERE code=?';
  $sentence_cartE = $pdo->prepare($sql_cartE);
  $sentence_cartE->execute(array($code));
  $result_cartE = $sentence_cartE->fetch();
  $id_item = $result_cartE['id'];

  if($result_cartE){
    //Existe un item en el carrito, amount +1
    $sql_item = 'UPDATE cart set amount=amount+1 WHERE id=?';
    $sentence_item = $pdo->prepare($sql_item);
    $sentence_item->execute(array($id_item));
    //consultar el item en el carrito
    $sql_item = 'SELECT * FROM cart WHERE id=?';
    $sentence_item = $pdo->prepare($sql_item);
    $sentence_item->execute(array($id_item));
    $result_item = $sentence_item->fetch();
    //reconozco el id del producto y la cantidad
    $id_product = $result_item['id_product'];
    $amount = $result_item['amount'];
    //consultar el precio unitario del item en products
    $sql_product = 'SELECT * FROM products WHERE id=?';
    $sentence_product = $pdo->prepare($sql_product);
    $sentence_product->execute(array($id_product));
    $result_product = $sentence_product->fetch();

    $price = $result_product['price'];
    $newPrice = $price * $amount;
    // actualizar price
    $sql_itemU = 'UPDATE cart set price=? WHERE id=?';
    $sentence_itemU = $pdo->prepare($sql_itemU);
    $sentence_itemU->execute(array($newPrice, $id_item));
    
  }else{
  //consulto la tabla producto
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
  //show cart start
  $sql_cart2 = 'SELECT * FROM cart';
  $sentence_cart2 = $pdo->prepare($sql_cart2);
  $sentence_cart2->execute();
  $result_cart = $sentence_cart2->fetchAll();
  //live bill
  foreach ($result_cart as $items) {
    $bill += $items['price'];
  }
  $active = true;
  }
}
//mostrar la vista
if ($active == false) {
  // show cart at start
  $sql_cart2 = 'SELECT * FROM cart';
  $sentence_cart2 = $pdo->prepare($sql_cart2);
  $sentence_cart2->execute();
  $result_cart = $sentence_cart2->fetchAll();
  foreach ($result_cart as $items) {
    $bill += $items['price'];
  }
}
// reconocer botones
if ($_GET) {
  $id_button = $_GET['id_button'];

  if ($id_button == 'buy') {
    if (!$result_cart) {
      header('location:welcome.php?id_user=' . $id_user);
    } else {
      header('location:bill.php?id_user=' . $id_user);
    }
  }
  if ($id_button == 'back') {
    //clean cart and exit
    $sql_cart = 'DELETE FROM cart WHERE id_user=?';
    $sentence_cart = $pdo->prepare($sql_cart);
    $sentence_cart->execute(array($id_user));
    header('location:logoutShop.php');
  }
  if ($id_button == 'plus') {
    $id_item = $_GET['id_item'];
    // actualizar amount
    $sql_item = 'UPDATE cart set amount=amount+1 WHERE id=?';
    $sentence_item = $pdo->prepare($sql_item);
    $sentence_item->execute(array($id_item));

    //consultar el item en el carrito
    $sql_item = 'SELECT * FROM cart WHERE id=?';
    $sentence_item = $pdo->prepare($sql_item);
    $sentence_item->execute(array($id_item));
    $result_item = $sentence_item->fetch();
    //reconozco el id del producto y la cantidad
    $id_product = $result_item['id_product'];
    $amount = $result_item['amount'];
    //consultar el precio unitario del item en products
    $sql_product = 'SELECT * FROM products WHERE id=?';
    $sentence_product = $pdo->prepare($sql_product);
    $sentence_product->execute(array($id_product));
    $result_product = $sentence_product->fetch();

    $price = $result_product['price'];
    $newPrice = $price * $amount;
    // actualizar price
    $sql_itemU = 'UPDATE cart set price=? WHERE id=?';
    $sentence_itemU = $pdo->prepare($sql_itemU);
    $sentence_itemU->execute(array($newPrice, $id_item));

    header('location:welcome.php?id_user=' . $id_user);
  }
  if ($id_button == 'less') {
    $id_item = $_GET['id_item'];
    //consultar el item en el carrito para verificar amount
    $sql_item = 'SELECT * FROM cart WHERE id=?';
    $sentence_item = $pdo->prepare($sql_item);
    $sentence_item->execute(array($id_item));
    $result_item = $sentence_item->fetch();

    //reconozco el id del producto y la cantidad
    $id_product = $result_item['id_product'];
    $amount = $result_item['amount'];

    if ($amount > 1) {
      // actualizar amount
      $sql_item = 'UPDATE cart set amount=amount-1 WHERE id=?';
      $sentence_item = $pdo->prepare($sql_item);
      $sentence_item->execute(array($id_item));

      //reconozco el nuevo amount 
      $sql_item = 'SELECT * FROM cart WHERE id=?';
      $sentence_item = $pdo->prepare($sql_item);
      $sentence_item->execute(array($id_item));
      $result_item = $sentence_item->fetch();
      $newAmount = $result_item['amount'];

      //consultar el precio unitario del item en products
      $sql_product = 'SELECT * FROM products WHERE id=?';
      $sentence_product = $pdo->prepare($sql_product);
      $sentence_product->execute(array($id_product));
      $result_product = $sentence_product->fetch();

      $price = $result_product['price'];
      $newPrice = $price * $newAmount;

      // actualizar price
      $sql_itemU = 'UPDATE cart set price=? WHERE id=?';
      $sentence_itemU = $pdo->prepare($sql_itemU);
      $sentence_itemU->execute(array($newPrice, $id_item));

      header('location:welcome.php?id_user=' . $id_user);
    } else {
      header('location:deleteCart.php?id_user=' . $id_user . '&id_item=' . $id_item);
    }
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
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- navbar bootstrap -->
    <nav class="navbar navbar-light bg-light">
      <a class="navbar-brand">
        <img src="util/mainlogoW.svg" width="40%" height="40%" class="d-inline-block align-top" alt="">
      </a>
    </nav>
  </div>
  <title>Wiedii Snacks Welcome</title>
</head>

<body>
  <div class="container">
    <center>
      <h6 class="text-uppercase mt-2"><b><?php echo $name ?></b> <b style="color:red;"><?php echo $debt ?> $ </b></h6>
      <!-- Formulario -->
      <div class="container">
        <form method="POST">
          <input type="text" class="form-control mt-2 iniline-block float-left mb-2" name="code"
           placeholder="code product" id="focus" style="width:130px" required>
          <button class="btn btn-info inline-block float-right mt-2 ml-2 mb-2">ADD</button>
        </form>
      </div>
      <!-- list of products -->

      <!-- listado with buttons -->
      <div style="height:200px;width:235px;overflow:auto;border:1px solid white;padding:2%;text-align:left">
        <?php $count = 1 ?>
        <?php foreach ($result_cart as $data) : ?>
          <?php
            $name = $data['name'];
            $name = strtoupper($name);
            $id_item = $data['id'];
            $id_product = $data['id_product'];
            $amount = $data['amount'];
            $sql_product = 'SELECT * FROM products WHERE id=?';
            $sentence_product = $pdo->prepare($sql_product);
            $sentence_product->execute(array($id_product));
            $result_product = $sentence_product->fetch();
            ?>
          <div class="alert alert-secondary" style="margin-bottom:5px; height:40px; text-align:left;
           padding:6px;padding-top:6px;">
            <div class="contenido" style="padding-bottom:0%">
              <small><?php echo $amount ?> <b><?php echo $name; ?> :</b></small>
              <small><?php echo $result_product['price']; ?> $</small>

              <!-- PLUS ITEM -->
              <a href="welcome.php?id_user=<?php echo $id_user ?>&id_item=<?php echo $id_item ?>&id_button=plus">
                <button class="btn-info float-right ml-2" style="height:27px; width:25px; text-align:center;">
                  <p><b>+</b></p>
                </button>
              </a>
              <!-- LESS ITEM -->
              <a href="welcome.php?id_user=<?php echo $id_user ?>&id_item=<?php echo $id_item ?>&id_button=less">
                <button class="btn-danger float-right p-0" style="height:27px; width:25px;">
                  <h4>-</h4>
                </button>
              </a>
            </div>
          </div>
          <?php $i++ ?>
        <?php endforeach ?>
      </div>

      <!-- BUY BUTTON -->
      <form method="GET" action="welcome.php">
        <a href="welcome.php?id_user=<?php echo $id_user ?>&id_button=buy" class="btn btn-success mt-2 
        inline-block float-right">BUY</a>
      </form>
      <h6 class="inline-block float-right mr-2 mt-3" style="color:green"> <?php echo $bill ?> $</h6>
      <!-- EXIT BUTTON -->
      <form action="GET" action="welcome.php">
        <a href="welcome.php?id_user=<?php echo $id_user ?>&id_button=back" class="btn btn-danger mt-2 
        inline-block float-left">BACK</a>
      </form>
    </center>

    <script src="js/jquery.js"></script>
    <script src="js/functions.js"></script>

</body>

</html>