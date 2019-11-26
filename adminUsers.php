<?php
include_once 'conection.php'; //cargo la conexion

session_start();
if(!isset($_SESSION['admin']) ){
  header('Location:admin.php');
}

//READ DATA FROM DB
$sql_reader = 'SELECT * FROM users'; //var con consulta sql
$gsent = $pdo->prepare($sql_reader); //guardo la consulta en una var
$gsent->execute(); //ejecuto la consulta
$result = $gsent->fetchAll(); //guardo la consulta en un array
//var_dump($result); //muestro el array

//ADD DATA IN DB
if ($_POST) {
  $name = $_POST['name'];
  $document = $_POST['document'];
  $email = $_POST['email'];

  $sql_add = 'INSERT INTO users (name,document,email) VALUES (?,?,?)';
  $sentence_add = $pdo->prepare($sql_add);
  $sentence_add->execute(array($name, $document, $email));

  header('location:adminUsers.php');
} else

  //EDIT DATA IN DB
  if ($_GET) {
    $id = $_GET['id'];

    $sql_unique = 'SELECT * FROM users WHERE id=?';
    $gsent_unique = $pdo->prepare($sql_unique);
    $gsent_unique->execute(array($id));
    $result_unique = $gsent_unique->fetch();

    $nameU = $result_unique['name'];
    $nameU = strtoupper($nameU);
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
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <nav class="navbar navbar-light bg-light">
      <a class="navbar-brand">
        <img src="util/mainlogoW.svg" width="50%" height="50%" class="d-inline-block align-top" alt="">
      </a>
      <u class="navbar">
        <a href="adminProducts.php" class="navbar-brand">
          <button class="btn btn-outline-secondary mr-2">Products</button>
        </a>
        <a href="logoutAdmin.php">
          <button type="button" class="btn btn-outline-danger">Exit</button>
        </a>
      </u>
    </nav>

    <title>Wiedii Snacks Users</title>
    <link rel="shortcut icon" type="image/x-icon" href="util/favicon.png">

</head>

<body>

  <div class="container mt-4">
    <h1 class="display-4">ADMIN USERS</h1>
    <div class="row">
      <div class="col-md-6 mt-4">
        <!--mostrar los registros de la DB -->
        <h2>Users</h2>
        <?php foreach ($result as $data) : ?>
          <div class="alert alert-dark text-uppercase mt-3" role="alert">
            <?php echo $data['id']; ?>
            .
            <?php echo $data['name']; ?>
            -
            <?php echo $data['document']; ?>

            <!-- edit button -->
            <a href="adminUsers.php?id=<?php echo $data['id']; ?>">
              <button class="btn-light float-right">Edit</button>
            </a>
            <!-- delete button -->
            <a href="deleteUser.php?id=<?php echo $data['id']; ?>">
              <button class="btn-danger mr-3 float-right">Delete</button>
            </a>
          </div>
        <?php endforeach ?>
      </div>

      <div class="col-md-6 mt-4">

        <!-- agregar usuarios -->
        <?php if (!$_GET) : ?>
          <form method="POST">
            <h2>Add User</h2>
            <label class="mt-3">Nombre</label>
            <input type="text" class="form-control text-uppercase" name="name" required>
            <label class="mt-3">Document</label>
            <input type="number" class="form-control" name="document" required>
            <label class="mt-3">Email</label>
            <input type="text" class="form-control" name="email" required>
            <button class="btn btn-success mt-4">Add</button>
          </form>
        <?php endif ?>

        <!-- editar usuarios -->
        <?php if ($_GET) : ?>
          <form method="GET" action="editUser.php">
            <h2>Edit User: <?php echo $nameU ?></h2>
            <label class="mt-3">Name</label>
            <input type="text" class="form-control text-uppercase" name="name" value="<?php echo $result_unique['name'] ?>" required>
            <label class="mt-3">Document</label>
            <input type="number" class="form-control" name="document" value="<?php echo $result_unique['document'] ?>" requiered>
            <label class="mt-3">Email</label>
            <input type="text" class="form-control" name="email" value="<?php echo $result_unique['email'] ?>" required>
            <label class="mt-3">Debt: <?php echo $result_unique['debt'] ?> $</label>
            <br>
            <label>Pay</label>
            <input type="number" class="form-control" name="pay" placeholder="0.00 $">
            <input type="hidden" name="id" value="<?php echo $result_unique['id'] ?>">
            <button class="btn btn-success mt-4 float-left">Edit</button>
          </form>
          <a href="adminUsers.php">
            <button class="btn btn-danger mt-4 ml-3 float">Cancel</button>
          </a>
        <?php endif ?>
      </div>
    </div>
  </div>
</body>

</html>