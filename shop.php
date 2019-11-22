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
        header('location:welcome.php?id_user='.$id);
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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />

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
      <img class="userimg" src="util/user.png" width="50%"/>
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
        <button class="btn btn-success mt-3">ENTER</button>
      </form>

    </div>
  </center>


  <div class="javascrip adds">
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="js/jquery.js"></script>
    <script src="js/functions.js"></script>
  </div>


</body>

</html>