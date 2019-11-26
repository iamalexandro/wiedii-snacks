<?php
include_once 'conection.php';
session_start();
if (!isset($_SESSION['user'])) {
  header('Location:shop.php');
}

date_default_timezone_set('America/Bogota');
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

//INSERT INTO purchase
$cost = $result_product['price'];
$actual_date = date("Y-m-d H:i:s");

$sql_purchase = 'INSERT INTO purchase (id_user,id_product,cost,date1) VALUES (?,?,?,?)';
$sentence_purchase = $pdo->prepare($sql_purchase);
$sentence_purchase->execute(array($id_user, $id_product, $cost, $actual_date));

//UPDATE USER DEBT
$debt = $result_user['debt'] + $result_product['price'];

$sql_update = 'UPDATE users SET debt=? WHERE id=?';
$sentence_update = $pdo->prepare($sql_update);
$sentence_update->execute(array($debt, $id_user));


?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="css/bootstrap.min.css">

  <nav class="navbar navbar-light bg-light">
    <a class="navbar-brand">
      <img src="util/mainlogoW.svg" width="50%" height="50%" class="d-inline-block align-top" alt="">
    </a>
  </nav>

  <title>Wiedii Snacks Bill</title>
</head>

<body>

  <center>
    <div class='container'>
      <img src="https://cdn3.iconfinder.com/data/icons/flat-actions-icons-9/792/Tick_Mark_Dark-512.png" width="25%">
      <h6 class="text-uppercase"> <b>Your purchase was processed successfully</b> </h6>
      <h6>_______________________</h6>
      <h5 class="text-uppercase mt-3">
        <?php echo $result_user['name'] ?>
      </h5>
      <h6 class="mt-4">
        You did buy: <b class="text-uppercase"><?php echo $result_product['name'] ?></b>
      </h6>
      <h6 class="mt-2">
        It cost: <b class="text-uppercase"><?php echo $result_product['price'] ?> $</b>
      </h6>
      <h6 class="mt-2">
        your debt is for: <b class="text-uppercase"><?php echo $debt ?> $</b>
      </h6>
      <!-- Send email with debt -->
      <form action="GET">
        <a href="email.php?id_user=<?php echo $id_user ?>&id_product=<?php echo $id_product?>">
          <button type="button" class="btn btn-success mt-2">EXIT</button>
        </a>
      </form>
    </div>
  </center>
</body>

</html>