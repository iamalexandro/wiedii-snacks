<?php
include_once 'conection.php';

$code = $_POST['code'];

$sql_product = 'SELECT * FROM products WHERE code=?';
$sentence_product = $pdo->prepare($sql_product);
$sentence_product->execute(array($code));
$result_product = $sentence_product->fetch();

if (!$result_product) {
    echo 'Invalid product';
    die();
}

$id_user = $_GET['id_user'];

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

        <nav class="navbar navbar-light bg-light">
            <a class="navbar-brand">
                <img src="util/mainlogoW.svg" width="50%" height="50%" class="d-inline-block align-top" alt="">
            </a>
        </nav>
    </div>

    <title>Wiedii Snacks Purchase</title>
</head>

<body>
    <div class="container">
        <div class="col-md-6 mt-4">
            <center>
                <h4 class="text-uppercase"><?php echo $result_product['name'] ?></h4>
                <img class="mt-4" src="https://image.flaticon.com/icons/svg/2224/2224197.svg" width="50%">
                <h5 class="text-uppercase mt-4">
                    price: <?php echo $result_product['price']?> $
                </h5>
            </center>
            <a href="welcome.php">
                <img class="mt-3 d-inline-block ml-4" src="https://image.flaticon.com/icons/svg/1632/1632600.svg"
                 width="20%">
            </a>
            <a href="bill.php?id_user=<?php echo $id_user ?>&id_product=<?php echo $result_product['id']?>">
                <img class="mt-3 d-inline-block float-right mr-4"
                src="https://image.flaticon.com/icons/svg/1632/1632596.svg" width="20%">
            </a>
            <h5 class="mt-3 ml-2 d-inline-block float-left mr-4">DECLINE</h5>
            <h5 class="mt-3 float-right mr-4">BUY</h5>
        </div>
    </div>

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
</body>

</html>