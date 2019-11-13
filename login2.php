<?php
include_once 'conection.php';

$document_login = $_POST['document'];

$sql_confirm = 'SELECT * FROM users WHERE document=?';
$sentence_confirm = $pdo->prepare($sql_confirm);
$sentence_confirm->execute(array($document_login));
$result_confirm = $sentence_confirm->fetch();

if (!$result_confirm) {
    echo 'Invalid User';
    die();
}
header('location:admin.php');
