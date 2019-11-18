<?php
include_once 'conection.php';

if ($_POST) {
  $id = $_POST['id'];

  $sql_confirm = 'SELECT * FROM users WHERE id=?';
  $sentence_confirm = $pdo->prepare($sql_confirm);
  $sentence_confirm->execute(array($id));
  $result_confirm = $sentence_confirm->fetch();

  if (!$result_confirm) {
    echo 'Invalid User';
    die();
  }

  // echo 'El id de la persona es: '.$result_confirm['id'];

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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- navbar bootstrap -->
    <nav class="navbar navbar-light bg-light">
      <a class="navbar-brand">
        <img src="util/mainlogoW.svg" width="50%" height="50%" class="d-inline-block align-top" alt="">
      </a>
    </nav>
  </div>

  <title>Wiedii Snacks Welcome</title>
</head>

<body>
  <center>
    <div class="container">
      <h2 class="mt-2">
        WELCOME
      </h2>
      <h4 class="mt-2 text-uppercase"><?php echo $result_confirm['name'] ?></h4>
      <img class="mt-3 mb-4" src="https://image.flaticon.com/icons/svg/236/236831.svg" width="40%">

      <form method="POST" action=purchase.php?id_user=<?php echo $id ?>>
        <i>What are you gonna buy ?</i>
        <input type="text" class="form-control mt-3" name="code" placeholder="code product" />
        <button class="btn btn-success mt-4 inline-block float-right">SCAN</button>
      </form>
      <a href="login1view.php">
        <button class="btn btn-danger mt-4 float-left">BACK</button>
      </a>

    </div>
  </center>

  <div class=adds-javascript>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" 
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" 
    crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" 
    crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" 
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" 
    crossorigin="anonymous"></script>
  </div>

</body>

</html>