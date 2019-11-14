<?php
//READ DATA FROM DB
include_once 'conection.php'; //cargo la conexion
$sql_reader = 'SELECT * FROM users'; //var con consulta sql
$gsent = $pdo->prepare($sql_reader); //guardo la consulta en una var
$gsent->execute(); //ejecuto la consulta
$result = $gsent->fetchAll(); //guardo la consulta en un array
//var_dump($result); //muestro el array

//ADD DATA IN DB
if (!empty($_POST['name']) && !empty($_POST['document']) && !empty($_POST['email'])) {
    $name = $_POST['name'];
    $document = $_POST['document'];
    $email = $_POST['email'];

    $sql_add = 'INSERT INTO users (name,document,email) VALUES (?,?,?)';
    $sentence_add = $pdo->prepare($sql_add);
    $sentence_add->execute(array($name, $document, $email));

    header('location:adminUsers.php');
} else {
    //modal (no data to regist) JS  (pending) 
}

//EDIT DATA IN DB
if ($_GET) {
    $id = $_GET['id'];

    $sql_unique = 'SELECT * FROM users WHERE id=?';
    $gsent_unique = $pdo->prepare($sql_unique);
    $gsent_unique->execute(array($id));
    $result_unique = $gsent_unique->fetch();
    //var_dump($result_unique); //muestro el array
}

?>
<!doctype html>
<html lang="en">

<head>
    <!-- bootstrap -->
    <div class="bootstrap">
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
            <a href="login2view.html">
                <button type="button" class="btn btn-dark">Exit</button>
            </a>
        </nav>
    </div>
    </div>

    <title>Wiedii Snacks Users</title>
    <link rel="shortcut icon" type="image/x-icon" href="util/favicon.png">

</head>

<body>



    <div class="container mt-5">
        <a href="adminProducts.php">
            <button type="button" class="btn btn-info mb-4 p-3">GO TO ADMIN PRODUCTS</button>
        </a>
        <div class="row">
            <div class="col-md-6 mt-5">
                <!--mostrar los registros de la DB -->
                <h2 class = 'mb-3'>Users</h2>
                <?php foreach ($result as $data) : ?>
                    <div class="alert alert-dark text-uppercase" role="alert">
                        <?php echo $data['id']; ?>
                        .
                        <?php echo $data['name']; ?>
                        -
                        <?php echo $data['document']; ?>

                        <!-- edit button -->
                        <a href="adminUsers.php?id=<?php echo $data['id']; ?>">
                            <button class="btn-info float-right">Edit</button>
                        </a>
                        <!-- delete button -->
                        <a href="deleteUser.php?id=<?php echo $data['id']; ?>">
                            <button class="btn-danger mr-3 float-right">Delete</button>
                        </a>
                    </div>
                <?php endforeach ?>
            </div>

            <div class="col-md-6 mt-5">

                <!--Capturar datos para las insercion en la DB-->
                <?php if (!$_GET) : ?>
                    <form method="POST">
                        <h2>Add User</h2>
                        <input type="text" class="form-control mt-3" name="name" placeholder="Name">
                        <input type="text" class="form-control mt-3" name="document" placeholder="Document">
                        <input type="text" class="form-control mt-3" name="email" placeholder="Email">
                        <button class="btn btn-success mt-4">Add</button>
                    </form>
                <?php endif ?>

                <?php if ($_GET) : ?>
                    <form method="GET" action="editUser.php">
                        <h2>Edit User <?php echo $result_unique['id'] ?></h2>
                        <input type="text" class="form-control mt-3 text-uppercase" name="name" 
                        value="<?php echo $result_unique['name'] ?>">
                        <input type="text" class="form-control mt-3" name="document" 
                        value="<?php echo $result_unique['document'] ?>">
                        <input type="text" class="form-control mt-3" name="email" 
                        value="<?php echo $result_unique['email'] ?>">
                        <input type="hidden" name="id" 
                        value="<?php echo $result_unique['id'] ?>">
                        <button class="btn btn-primary mt-4">Edit</button>
                    </form>
                <?php endif ?>
            </div>
        </div>
    </div>

    <div class="javascript-adds">
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
        </script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
        </script>
    </div>

</body>

</html>