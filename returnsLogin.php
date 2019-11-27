<?php
include_once 'conection.php';
session_start();

if ($_POST) {
  $id = $_POST['id'];

  $sql_confirm = 'SELECT * FROM users WHERE id=?';
  $sentence_confirm = $pdo->prepare($sql_confirm);
  $sentence_confirm->execute(array($id));
  $result_confirm = $sentence_confirm->fetch();

  if (!$result_confirm) {
    echo "<script> alert('invalid user') </script>";
  } else {
    $login = $id;
    $_SESSION['user'] = $login;

    if (isset($_SESSION['user'])) {
      header('location:returns.php?id_user=' . $id);
    }
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <div class="bootstap adds">
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
</head>

<body>
  <center>
    <div>
      <h1 class="titulo mt-4" style="color:red;"><b>RETURNS</b></h1>
      <img class="userimg" src="util/user.png" width="50%" />
      <!-- imagen huella -->
      <!-- <img class="finger" src="https://image.flaticon.com/icons/png/512/125/125503.png" 
        width="15%" height="15%"/> -->
    </div>
  </center>
  <!-- inicio de sesion -->
  <center>
    <div class="col-md-6 m4">

      <form method="POST">
        <input type="number" class="form-control mt-3" name="id" placeholder="id" id="focus" required>
        <button class="btn btn-success mt-4 inline-block float-right" id="enter">ENTER</button>
      </form>
      <a href="shop.php">
        <button class="btn btn-danger mt-4 inline-block float-left" id="enter">BACK</button>
      </a>
    </div>
  </center>

  <script src="js/jquery.js"></script>
  <script src="js/functions.js"></script>
</body>

</html>