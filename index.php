<?php
//READ DATA FROM DB 
include_once 'conections.php'; //cargo la conexion
$sql_reader = 'SELECT * FROM users'; //var con consulta sql
$gsent = $pdo->prepare($sql_reader); //guardo la consulta en una var
$gsent->execute(); //ejecuto la consulta
$result = $gsent->fetchAll(); //guardo la consulta en un array
//var_dump($result); //muestro el array

//ADD DATA IN DB
    if ($_POST) {
        $name = $_POST['name'];
        $document = $_POST['document'];
        $email = $_POST['email'];

        $sql_add = 'INSERT INTO users (name,document,email) VALUES (?,?,?) ';
        $sentencia_agregar = $pdo->prepare($sql_add);
        $sentencia_agregar->execute(array($name, $document, $email));
        header('location:index.php');
    }else{
        
    }
?> 
<!doctype html>
<html lang="en">

<head>
    <div class="bootstrap">

        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

        <!-- navbar bootstrap-->
        <nav class="navbar navbar-dark bg-light">
            <a class="navbar-brand">
                <img src="util/mainlogoW.svg" width="50%" height="50%" class="d-inline-block align-top" alt="">
            </a>
            <button type="button" class="btn btn-dark">Exit</button>
        </nav>
    </div>

    <title>Wiedii Snacks</title>
    <link rel="shortcut icon" type="image/x-icon" href="util/favicon.png">

</head>

<body>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 mt-5">
                <!--mostrar los registros de la DB -->
                <h2>Users</h2>
                <?php foreach ($result as $data) : ?>
                    <div class="alert alert-dark text-uppercase" role="alert">
                        <?php echo $data['id']; ?>
                        .
                        <?php echo $data['name']; ?>
                        -
                        <?php echo $data['document']; ?>
                    </div>
                <?php endforeach ?>
            </div>

            <div class="col-md-6 mt-5">
                <h2>Add User</h2>
                <!--Capturar datos para las insercion en la BD-->
                <form method="POST">
                    <input type="text" class="form-control mt-3" name="name" placeholder="Name">
                    <input type="text" class="form-control mt-3" name="document" placeholder="Document">
                    <input type="text" class="form-control mt-3" name="email" placeholder="Email">
                    <button class="btn btn-success mt-4">Add</button>
                    <button class="btn btn-dark mt-4 ml-3">Clean</button>
                </form>
            </div>
        </div>
    </div>

    <div class="javascript-adds">
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </div>

</body>

</html>