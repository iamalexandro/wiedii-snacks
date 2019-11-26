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
      header('location:welcome.php?id_user=' . $id);
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
      <h2 class="titulo mt-3"> <b>SNACKS</b></h2>
      <h2 class="titulo"><b>STORE</b></h2>
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
        <input type="number" class="form-control " name="id" placeholder="id" id="focus" required>
        <button class="btn btn-success mt-3 inline-block float-right">ENTER</button>
      </form>
      <a href="returns.php?id_user=<?php echo $id_user ?>&id_button=back" class="btn btn-danger mt-3 inline-block float-left">:(</a>
    </div>
  </center>

  <script src="js/jquery.js"></script>
  <script src="js/functions.js"></script>
</body>

</html>