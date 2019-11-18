<?php
include_once 'conection.php';
//reconocer usuario
$id_user = $_GET['id_user'];
$sql_user = 'SELECT * FROM users WHERE id=?';
$sentence_user = $pdo->prepare($sql_user);
$sentence_user->execute(array($id_user));
$result_user = $sentence_user->fetch();
$name = $result_user['name'];
$name = strtoupper($name);
//reconocer producto
$id_product = $_GET['id_product'];
$sql_product = 'SELECT * FROM products WHERE id=?';
$sentence_product = $pdo->prepare($sql_product);
$sentence_product->execute(array($id_product));
$result_product = $sentence_product->fetch();
$product = $result_product['name'];
$product = strtoupper($product);

$msg = 'Hello, ' . $name .
'<br> You just bought: ' . $product .
'<br> It cost: ' . $result_product['price'] .
'<br><br> Your debt is for: ' . $result_user['debt'] ;

//compras SELECT FROM purchase
// $sql_purchase = 'SELECT * FROM purchase WHERE id_user=?';
// $sentence_purchase = $pdo->prepare($sql_purchase);
// $sentence_purchase->execute(array($id_user));
// $result_purchase = $sentence_purchase->fetchAll();

// echo $result_purchase;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

$mail = new PHPMailer(true);
try {
  //Server settings
  $mail->SMTPDebug = 0;                                       // Enable verbose debug output
  $mail->isSMTP();                                            // Send using SMTP
  $mail->Host       = 'smtp.gmail.com';                       // Set the SMTP server to send through
  $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
  $mail->Username   = 'nicoladicandiajaimes@gmail.com';       // SMTP username
  $mail->Password   = 'nicox2104';                            // SMTP password
  $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption
  $mail->Port       = 587;                                    // TCP port to connect to

  //Recipients
  $mail->setFrom('nicoladicandiajaimes@gmail.com', 'Wiedii Snacks');
  $mail->addAddress('nicola.dicandia@wiedii.co', $name);    // Add a recipient

  // Content
  $mail->isHTML(true);                                  // Set email format to HTML
  $mail->Subject = 'Purchase Notification';
  $mail->Body    = $msg;

  $mail->send();

} catch (Exception $e) {
  echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <nav class="navbar navbar-light bg-light">
    <a class="navbar-brand">
      <img src="util/mainlogoW.svg" width="50%" height="50%" class="d-inline-block align-top" alt="">
    </a>
  </nav>

  <title>Email</title>
</head>

<body>

  <div class="container mt-4">
    <center>
      <h2>Thank you for use</h2>
      <h1><b>WIEDII SNACKS</b></h1>
      <img class="mt-2" src="https://www.stickpng.com/assets/images/584856bce0bb315b0f7675ad.png" width="25%"></img>
      <h4 class="mt-2"><i>An email with the purchase details was send to you</i></h4>
      <a href="login1view.php">
        <button type="button" class="btn btn-success mt-2"> OK </button>
      </a>
    </center>
  </div>

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>