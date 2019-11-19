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
'<br> It cost: ' . $result_product['price'] . ' $'.
'<br><br> Your debt is for: ' . $result_user['debt']. ' $' .
'<br><br><br> Purchase History<br><br>';

//compras SELECT FROM purchase
$sql_purchase = 'SELECT * FROM purchase WHERE id_user=?';
$sentence_purchase = $pdo->prepare($sql_purchase);
$sentence_purchase->execute(array($id_user));
$result_purchase = $sentence_purchase->fetchAll();

foreach($result_purchase as $data){
  $id_p = $data['id_product'];
  $query = 'SELECT * FROM products WHERE id=?';
  $sql = $pdo->prepare($query);
  $sql->execute(array($id_p));
  $result = $sql->fetch();
  $nameP = $result['name'];
  $nameP = strtoupper($nameP);
  $msg .= $nameP.' ------> '.$data['cost'].' $ <br><br>';
}


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
  $mail->Password   = '#';                            // SMTP password
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

header('location:login1view.php');

?>

