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
// echo $result_user['name'] . '<br>';
// echo 'You did buy: ' . $result_product['name'] . '<br>';
// echo 'And it cost: ' . $result_product['price'];

//INSERT INTO purchase
$cost = $result_product['price'];

$sql_purchase = 'INSERT INTO purchase (id_user,id_product,cost) VALUES (?,?,?)';
$sentence_purchase = $pdo->prepare($sql_purchase);
$sentence_purchase->execute(array($id_user, $id_product, $cost));

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
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
  integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

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
      <img src="https://cdn3.iconfinder.com/data/icons/flat-actions-icons-9/792/Tick_Mark_Dark-512.png" 
      width="25%" class=mt-3>
      <h5 class="text-uppercase"> <b>Your purchase was processed successfully</b> </h5>
      <h6>___________________________</h6>
      <h5 class="text-uppercase mt-4">
        <?php echo $result_user['name'] ?>
      </h5>
      <h5 class="mt-2">
        You did buy: <b class="text-uppercase"><?php echo $result_product['name'] ?></b> 
      </h5>
      <h5 class="mt-2">
        And it cost: <b class="text-uppercase"><?php echo $result_product['price'] ?> $</b> 
      </h5>
      <h5 class="mt-2">
        Your debt is for: <b class="text-uppercase"><?php echo $result_user['debt'] ?> $</b>
      </h5>
      <a href="login1view.php">
        <button type="button" class="btn btn-success mt-3">EXIT</button>
      </a>
    </div>
    
  </center>



  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>