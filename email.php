<?php
include_once 'conection.php';
session_start();
if (!isset($_SESSION['user'])) {
  header('Location:shop.php');
}
echo loading;
//reconocer usuario
$id_user = $_GET['id_user'];
$sql_user = 'SELECT * FROM users WHERE id=?';
$sentence_user = $pdo->prepare($sql_user);
$sentence_user->execute(array($id_user));
$result_user = $sentence_user->fetch();
$name = $result_user['name'];
$name = strtoupper($name);
//reconocer cart

$sql_cart = 'SELECT * FROM cart';
$sentence_cart = $pdo->prepare($sql_cart);
$sentence_cart->execute();
$result_cart = $sentence_cart->fetchAll();

$item="";
$cost;
foreach($result_cart as $items){
  $item.= $items['name'].", ";
  $cost += $items['price'];
}
$item = strtoupper($item);

$msg = 'Hello, ' . $name .
'<br> You just bought: ' . $item .
'<br> It cost: ' . $cost . ' $'.
'<br><br> Your debt is for: ' . $result_user['debt']. ' $' .
'<br><br><br> Purchase History<br><br>';

$sql_purchase = 'SELECT * FROM purchase WHERE id_user=? AND paid=0 ORDER BY date1 DESC';
$sentence_purchase = $pdo->prepare($sql_purchase);
$sentence_purchase->execute(array($id_user));
$result_purchase = $sentence_purchase->fetchAll();
$i=1;
foreach($result_purchase as $data){
  $id_p = $data['id_product'];
  $query = 'SELECT * FROM products WHERE id=?';
  $sql = $pdo->prepare($query);
  $sql->execute(array($id_p));
  $result = $sql->fetch();
  $nameP = $result['name'];
  $nameP = strtoupper($nameP);
  $msg .= $i .'. '.$data['date1'].' | '. $nameP.' ------> '.$data['cost'].'<br><br>';
  $i = $i+1;
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

// clean cart and exit
$sql_cart = 'DELETE FROM cart WHERE id_user=?';
$sentence_cart = $pdo->prepare($sql_cart);
$sentence_cart->execute(array($id_user));
header('location:logoutShop.php');

?>

