<?php
include_once 'conection.php';
session_start();
if ($_POST) {
  $password = $_POST['password'];

  $sql_confirm = 'SELECT * FROM users WHERE password=?';
  $sentence_confirm = $pdo->prepare($sql_confirm);
  $sentence_confirm->execute(array($password));
  $result_confirm = $sentence_confirm->fetch();

  if (!$result_confirm) {
    echo "<script> alert('invalid user') </script>";
  } else {
    $login = $password;
    $_SESSION['admin'] = $login;

    if (isset($_SESSION['admin'])) {
      header('location:adminUsers.php');
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <!-- bootstrap -->
  <a href=""></a>
  <div class="bootstrap">
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <!-- navbar bootstrap-->
    <nav class="navbar navbar-light bg-light">
      <a class="navbar-brand">
        <img src="util/mainlogoW.svg" width="50%" height="50%" class="d-inline-block align-top" alt="">
      </a>
      
    </nav>
  </div>

  <title>Wiedii Snacks Login</title>
  <link rel="shortcut icon" type="image/x-icon" href="util/favicon.png" />
</head>

<body>
  <div class="container mt-5">
    <div class="row" style="justify-content:center">
      <div class="col-md-4">
        <center>
          <form method="POST">
            <h1 class="mt-5"> <b>WIEDII SNACKS</b> </h1>
            <h3 class="mt-3"> <b>ADMIN</b> </h3>
            <input type="password" class="form-control mt-4" name="password" placeholder="password" required autofocus />
            <button class="btn btn-success mt-4">ENTER</button>
          </form>
        </center>
      </div>
    </div>
  </div>

</body>

</html>