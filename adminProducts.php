<?php
//READ DATA FROM DB
include_once 'conection.php'; //cargo la conexion
$sql_reader = 'SELECT * FROM products'; //var con consulta sql
$gsent = $pdo->prepare($sql_reader); //guardo la consulta en una var
$gsent->execute(); //ejecuto la consulta
$result = $gsent->fetchAll(); //guardo la consulta en un array
//var_dump($result); //muestro el array

//ADD DATA IN DB
if ($_POST) {
  $name = $_POST['name'];
  $price = $_POST['price'];
  $code = $_POST['code'];

  $sql_add = 'INSERT INTO products (name,price,code) VALUES (?,?,?)';
  $sentence_add = $pdo->prepare($sql_add);
  $sentence_add->execute(array($name, $price, $code));

  header('location:adminProducts.php');
}

//EDIT DATA IN DB
if ($_GET) {
  $id = $_GET['id'];

  $sql_unique = 'SELECT * FROM products WHERE id=?';
  $gsent_unique = $pdo->prepare($sql_unique);
  $gsent_unique->execute(array($id));
  $result_unique = $gsent_unique->fetch();

  $nameP = $result_unique['name'];
  $nameP = strtoupper($nameP);
  
}

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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <nav class="navbar navbar-light bg-light">
      <a class="navbar-brand">
        <img src="util/mainlogoW.svg" width="50%" height="50%" class="d-inline-block align-top" alt="">
      </a>
      <a href="login2view.php">
        <button type="button" class="btn btn-dark">Exit</button>
      </a>
    </nav>
  </div>

  <title>Wiedii Snacks Products</title>
  <link rel="shortcut icon" type="image/x-icon" href="util/favicon.png">

</head>

<body>


  <div class="container mt-4">
    <a href="adminUsers.php">
      <button type="button" class="btn btn-primary p-3">GO TO ADMIN USERS</button>
    </a>
    <div class="row">
      <div class="col-md-6 mt-4">
        <!--mostrar los registros de la DB -->
        <h2>Products</h2>
        <?php foreach ($result as $data) : ?>
          <div class="alert alert-dark text-uppercase mt-3" role="alert">
            <?php echo $data['id']; ?>
            .
            <?php echo $data['name']; ?>
            -
            <?php echo $data['price'] . ' $'; ?>

            <!-- edit button -->
            <a href="adminProducts.php?id=<?php echo $data['id']; ?>">
              <button class="btn-light float-right">edit</button>
            </a>
            <!-- delete button -->
            <a href="deleteProducts.php?id=<?php echo $data['id']; ?>">
              <button class="btn-danger float-right mr-3">Delete</button>
            </a>
          </div>
        <?php endforeach ?>
      </div>

      <div class="col-md-6 mt-4">

        <!-- agregar usuarios -->
        <?php if (!$_GET) : ?>
          <form method="POST">
            <h2>Add Products</h2>
            <input type="text" class="form-control mt-3" name="name" placeholder="Name" required>
            <input type="text" class="form-control mt-3" name="price" placeholder="Price" required>
            <input type="text" class="form-control mt-3" name="code" placeholder="Code" required>
            <button class="btn btn-success mt-4">Add</button>
          </form>
        <?php endif ?>
          <!-- editar usuario -->
        <?php if ($_GET) : ?>
          <form method="GET" action="editProducts.php">
            <h2>Edit Product: <?php echo $nameP ?></h2>
            <input type="text" class="form-control mt-3 text-uppercase" name="name" 
            value="<?php echo $result_unique['name'] ?>" required>
            <input type="text" class="form-control mt-3" name="price" value="<?php echo $result_unique['price'] ?>" required>
            <input type="text" class="form-control mt-3" name="code" value="<?php echo $result_unique['code'] ?>" required>
            <input type="hidden" name="id" value="<?php echo $result_unique['id'] ?>">
            <button class="btn btn-success mt-4 float-left">Edit</button>
          </form>
          <a href="adminProducts.php">
            <button class="btn btn-danger mt-4 ml-3 float">Cancel</button>
          </a>
        <?php endif ?>
      </div>
    </div>
  </div>

  <div class="javascript-adds">
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" 
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" 
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
  </div>

</body>

</html>