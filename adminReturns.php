<?php
include_once 'conection.php'; //cargo la conexion

session_start();
if (!isset($_SESSION['admin'])) {
  header('Location:admin.php');
}

//READ DATA FROM DB
$sql_reader = 'SELECT * FROM returns1'; //var con consulta sql
$gsent = $pdo->prepare($sql_reader); //guardo la consulta en una var
$gsent->execute(); //ejecuto la consulta
$result = $gsent->fetchAll(); //guardo la consulta en un array
//var_dump($result); //muestro el array


?>
<!doctype html>
<html lang="en">

<head>
  <!-- bootstrap -->
  <div class="bootstrap">
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <nav class="navbar navbar-light bg-light">
      <a class="navbar-brand">
        <img src="util/mainlogoW.svg" width="50%" height="50%" class="d-inline-block align-top" alt="">
      </a>
      <u class="navbar">
        <a href="adminProducts.php" class="navbar-brand">
          <button class="btn btn-outline-secondary mr-2">Admin Products</button>
        </a>
        <a href="adminUsers.php" class="navbar-brand">
          <button class="btn btn-outline-secondary mr-2">Admin Users</button>
        </a>
        <a href="logoutAdmin.php">
          <button type="button" class="btn btn-outline-danger">Exit</button>
        </a>
      </u>
    </nav>

    <title>Wiedii Snacks Returns</title>
    <link rel="shortcut icon" type="image/x-icon" href="util/favicon.png">

</head>

<body>

  <div class="container mt-4">
    <h1 class="display-4">ADMIN RETURNS</h1>
    <div class="row">
      <div class="col-md-6 mt-4">
        <!--mostrar los registros de la DB -->
        <h2>RETURNS</h2>
        <?php foreach ($result as $data) : ?>
          <?php $id_user = $data['id_user'];?>
          <?php $id_product = $data['id_product'];?>
          <?php
            $sql1 = 'SELECT * FROM users WHERE id=?';
            $sentence1 = $pdo->prepare($sql1);
            $sentence1->execute(array($id_user));
            $result1 = $sentence1->fetch();
            $nameUser = $result1['name'];
            $nameUser = strtoupper($nameUser);

            $sql2 = 'SELECT * FROM products WHERE id=?';
            $sentence2 = $pdo->prepare($sql2);
            $sentence2->execute(array($id_product));
            $result2 = $sentence2->fetch();
            $nameProduct = $result2['name'];
            $nameProduct = strtoupper($nameProduct);
            ?>
          <div class="alert alert-danger mt-3" role="alert">
            <?php echo $nameUser; ?>
            returns: 
            <?php echo $nameProduct; ?>
            <!-- check button -->
            <a href="deleteReturns.php?id=<?php echo $data['id']; ?>">
              <button class="btn-success float-right">CHECK</button>
            </a>
          </div>
        <?php endforeach ?>
      </div>

      </div>
    </div>
  </div>
</body>

</html>