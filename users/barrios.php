<?php session_start();

if (!isset($_SESSION['usuario'])) {
    header('Location: ../index.php');
}

require 'nav.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = ucfirst($_POST['name']);

    $errores = '';

    if (empty($name)) {
        $errores .= '<li> Por favor, rellena todos los datos correctamente</li>';
    } else {


        $statement = $connec->prepare('SELECT * FROM districts WHERE name = :name');
        $statement->execute(array(':name' => $name));
        $resultado = $statement->fetch();

        if ($resultado != false) {
            $errores .= '<li>Ese barrio ya existe.</li>';
        }
    }

    if ($errores == '') {
        $statement = $connec->prepare('INSERT INTO districts (name) 
    VALUES (:name)');
        $statement->execute(array(
            ':name' => $name,
        ));
        $error = '';
        $resultados = $statement;

        if ($resultados == false) {
            $error .= " <li>Error al agregar el barrio </li>";
        } else {
            header('Location: barrios.php');
        }
    }
}

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
    <title>Agregar barrio</title>
</head>

<body>
    
    <div class="card text-center card w-75" style="position:relative; margin: 10px auto">
        <form style="position:relative; margin:auto" action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" >
            <br />
            <h5 style="position:relative; margin:10px auto; text-align:center; font-weight:bold;">Nombre de barrio:</h5>

            <input type="text" name="name" required></input>
            <br /><br />
            <button type="submit" title="Agregar barrio" class="btn btn-success"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-square" viewBox="0 0 16 16">
                    <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z" />
                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                </svg> Agregar</button>
            <br /><br />

            <?php if (!empty($errores)) : ?>
                <div>
                    <ul>
                        <?php echo $errores; ?>
                    </ul>
                </div>
            <?php endif ?>
            <?php if (!empty($error)) : ?>
                <div>
                    <ul>
                        <?php echo $error; ?>
                    </ul>
                </div>
            <?php endif ?>
        </form>
    </div>
    <div class="card w-75" style="position:relative; margin: 10px auto">
        <table class="table table-striped table-responsive" style="position:relative; margin:auto">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php

                $result = $connec->prepare("SELECT id, name FROM districts ORDER BY name ASC");
                $result->execute();
                $resultado = $result->fetchAll();

                foreach ($resultado as $row) {
                ?>
                    <tr>
                        <td><?php echo $row['name'] ?> </td>
                        <td>
                            <div class="button-group">
                                <form action="updatebarrio.php" method="post">
                                    <button type="submit" name="id" value="<?php echo $row['id'] ?>" title="Editar" class="btn btn-success"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                        </svg></button>
                                <?php
                            }
                                ?>
                            </div>
                        </td>
                    </tr>
            </tbody>
        </table>
    </div>
</body>

</html>