<?php session_start();

if (!isset($_SESSION['usuario'])) {
    header('Location: ../index.php');
}
require 'nav.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,200;0,300;1,200;1,300&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>View usuario</title>
</head>

<body>

    <div class="card" style="width: 25rem; top: 20px; margin: 0 auto;">
        <svg style="margin: 0 auto;" xmlns="http://www.w3.org/2000/svg" width="70" height="70" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
            <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z" />
        </svg>
        <form name="add_person" class="card-body" style="margin: 0 auto;">
            <?php

            $result = $connec->prepare("SELECT name, lastname, dni, email, role FROM users WHERE id=" . $_POST['id']);
            $result->execute();
            $resultado = $result->fetchAll();

            foreach ($resultado as $row) {

            ?>
                <h6 style="font-weight:bold;">Nombre:</h6>
                <p><?php echo $row['name'] ?></p>
                <h6 style="font-weight:bold;">Apellido:</h6>
                <p><?php echo $row['lastname'] ?></p>
                <h6 style="font-weight:bold;">D.N.I.:</h6>
                <p><?php echo $row['dni'] ?></p>
                <h6 style="font-weight:bold;">Email:</h6>
                <p><?php echo $row['email'] ?></p>
                <h6 style="font-weight:bold;">Categoria:</h6>
                <p> <?php
                    if ($row['role'] == 1) : echo "Administrador";
                    elseif ($row['role'] == 2) : echo "Dirigente";
                    elseif ($row['role'] == 3) : echo "Invitado";
                    endif;
                    ?>
                </p>
            <?php  }
            ?>
        </form>
        <a style=" margin: 0 auto;" href="contenido.php" type="submit" title="Volver" class="btn btn-success"><svg xmlns="http://www.w3.org/2000/svg" width="40" height="17" fill="currentColor" class="bi bi-arrow-left-square" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M15 2a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2zM0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm11.5 5.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z" />
            </svg>Volver</a>
        <br />
    </div>

</body>

</html>