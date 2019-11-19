<?php
include_once 'conection.php';
if (isset($_POST['submit'])) {
  $password = $_POST['password'];

  $sql_confirm = 'SELECT * FROM users WHERE password=?';
  $sentence_confirm = $pdo->prepare($sql_confirm);
  $sentence_confirm->execute(array($password));
  $result_confirm = $sentence_confirm->fetch();

  if (!$result_confirm) {
    echo 'Invalid User';
    die();
  }
  header('location:adminUsers.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <!-- bootstrap -->
  <div class="bootstrap">
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />

    <!-- navbar bootstrap-->
    <nav class="navbar navbar-light bg-light">
      <a class="navbar-brand">
        <img src="util/mainlogoW.svg" width="50%" height="50%" class="d-inline-block align-top" alt="" />
      </a>
      <a href="index.html">
        <button type="button" class="btn btn-dark">Exit</button>
      </a>
    </nav>
  </div>

  <title>Wiedii Snacks Login</title>
  <link rel="shortcut icon" type="image/x-icon" href="util/favicon.png" />
</head>

<body>
  <div class="container mt-5">
    <div class="row">
      <div class="col-md-12">
        <center>
          <form method="POST">
            <h3 class="mt-5">Welcome to Wiedii Snacks</h3>
            <input type="password" class="form-control mt-5" name="password" placeholder="password" required autofocus />
            <button type="submit" name="submit" class="btn btn-success mt-4">ENTER</button>
          </form>
        </center>
      </div>
    </div>
  </div>

  <!--libraries-->
  <div class="libraries-js">
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </div>
</body>

</html>