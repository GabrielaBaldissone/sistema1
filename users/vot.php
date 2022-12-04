<?php session_start();

if (!isset($_SESSION['usuario'])) {
    header('Location: ../index.php');
}
require 'nav.php';

$mail = ($_SESSION['usuario']);

$nombre = $connec->prepare("SELECT name, lastname, role FROM users WHERE email = '$mail'");
$nombre->execute();
$dirigente = $nombre->fetch();

// Agregar votante

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $namev = ucfirst($_POST['namev']);
    $lastnamev = ucfirst($_POST['lastnamev']);
    $dniv = $_POST['dniv'];
    $addressv = $_POST['addressv'];
    $districtsv = ($_POST['id_districtsv']);
    $phonev = $_POST['phonev'];

    $erroresv = '';

    if (empty($dniv)) {
        $dniv = rand(1, 999999);
    }

    $comparardni = $connec->prepare('SELECT * FROM persons WHERE dni = :dni');
    $comparardni->execute(array(':dni' => $dniv));
    $resultadov = $comparardni->fetch();

    if ($resultadov != false) {
        $erroresv .= 'DNI ya existente ';
    } else {

        $addvotante = $connec->prepare('INSERT INTO persons (name, lastname, dni, address, phone) 
            VALUES (:name, :lastname, :dni, :address, :phone)');
        $addvotante->execute(array(
            ':name' => $namev,
            ':lastname' => $lastnamev,
            ':dni' => $dniv,
            ':address' => $addressv,
            ':phone' => $phonev
        ));
        $addresultado = $addvotante->fetch();

        // ID de la persona.
        $id_person = $connec->prepare('SELECT id FROM persons WHERE dni = :dni');
        $id_person->execute(array(':dni' => $dniv));
        $resultid = $id_person->fetch();

        // Guardar barrio del ID de la persona.
        $barrio = $connec->prepare('INSERT INTO district_person (id_district, id_person) VALUES(:id_district, :id_person)');
        $barrio->execute(array(
            ':id_district' => $districtsv,
            ':id_person' => $resultid[0]
        ));
        $resultbarrio = $barrio->fetch();

        // ID del dirigente que agregó la persona
        $id_dirigente = $connec->prepare("SELECT id FROM users WHERE email = :email");
        $id_dirigente->execute(
            array(
                ':email' => $_SESSION['usuario']
            )
        );
        $resul_id_dirigente = $id_dirigente->fetch();

        // Guardar la relación de la persona y el dirigente
        $person_user = $connec->prepare('INSERT INTO person_user (id_user, id_person) VALUES(:id_user, :id_person)');
        $person_user->execute(array(
            ':id_user' => $resul_id_dirigente[0],
            ':id_person' => $resultid[0]
        ));
        $resultperson_user = $person_user->fetchAll();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,200;0,300;1,200;1,300&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Contenido</title>
</head>
<script type="text/javascript">
    function ConfirmDelete() {
        var respuesta = confirm("¿Seguro desea eliminar?");

        if (respuesta == true) {
            return true;
        } else {
            return false;
        }
    }
</script>

<body>

    <?php
    if ($dirigente['role'] == 1 or $dirigente['role'] == 2) {
    ?>

        <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
            <br />
            <h5 style="position:relative; margin:10px auto; text-align:center; font-weight:bold;">Formulario para agregar votante:</h5>
            <br />
            <div class="table-responsive" style="max-width: 90%; position:relative; margin:10px auto;">
                <table class="table">
                    <tbody>
                        <tr>
                            <td style="font-weight:bold;"> Nombre <label style="color:red">*</label></td>
                            <td style="font-weight:bold;"> Apellido <label style="color:red">*</label></td>
                            <td style="font-weight:bold;"> DNI <label style="color:red">*</label></td>
                            <td style="font-weight:bold;"> Domicilio </td>
                            <td style="font-weight:bold;"> Barrio </td>
                            <td style="font-weight:bold;"> Teléfono </td>
                        </tr>
                        <tr>
                            <td> <input type="text" class="form-control" name="namev" required> </input> </td>
                            <td> <input type="text" class="form-control" name="lastnamev" required> </input> </td>
                            <td> <input type="number" class="form-control" min="1000000" max="99999999" placeholder="sin puntos" name="dniv" required> </input> </td>
                            <td> <input type="text" class="form-control" name="addressv"> </input> </td>
                            <td><select class="form-select" name="id_districtsv">
                                <option></option>
                                    <?php

                                    $result = $connec->prepare("SELECT * FROM districts ORDER BY name ASC");
                                    $result->execute();
                                    $resultado = $result->fetchAll();

                                    foreach ($resultado as $row) {
                                        echo
                                        '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
                                    }
                                    ?>
                                </select></td>
                            <td> <input type="number" class="form-control" name="phonev"> </input> </td>
                        </tr>
                    </tbody>
                </table>
                <?php if (!empty($erroresv)) : ?>
                    <div style="margin: 10px 0; padding: 12px; border-radius: 4px 4px 4px 4px;" class="alert alert-danger alert-dismissible fade show col-md-3" role="alert">
                        <strong><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-exclamation-lg" viewBox="0 0 16 16">
                                <path d="M7.005 3.1a1 1 0 1 1 1.99 0l-.388 6.35a.61.61 0 0 1-1.214 0L7.005 3.1ZM7 12a1 1 0 1 1 2 0 1 1 0 0 1-2 0Z" />
                            </svg> <?php echo $erroresv; ?></strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif ?>
                <label style="position:relative; margin:10px auto; color:red">* Dato obligatorio.</label>
            </div>
            <button style="position:relative; margin:10px auto; text-align: center; display: flex;" type="submit" class="btn btn-success">Agregar votante</button>
        </form>
    <?php
    }
    ?>
    <hr>
    <br />
    <div class="container mt-5">
        <div class="col-8">
            <div class="mb-3">
                <label class="form-label" style="font-weight:bold;"> Buscador: </label>
                <input onkeyup="buscar_ahora($('#buscar').val());" style="width: 300px;" class="form-control" type="text" placeholder="nombre, apellido o dni" id="buscar" name="buscar">
            </div>
        </div>
    </div>
    <script type="text/javascript">
        function buscar_ahora(buscar) {
            var parametros = {
                "buscar": buscar
            };
            $.ajax({
                data: parametros,
                type: 'POST',
                url: 'buscador.php',
                success: function(data) {
                    document.getElementById("datos_buscador").innerHTML = data;
                }
            });
        }
    </script>

    <div id="datos_buscador" class="table-responsive" style="max-width: 90%; position:relative; margin:10px auto;">
        <h5 style="position:relative; margin:10px auto; text-align:center; font-weight:bold;">Lista de votantes:</h5>
        <br />
        <table class="table" style="position:relative; margin:auto">
            <thead>
                <tr>
                    <td style="font-weight:bold;"> N° </td>
                    <td style="font-weight:bold;"> Nombre </td>
                    <td style="font-weight:bold;"> Apellido </td>
                    <td style="font-weight:bold;"> DNI </td>
                    <td style="font-weight:bold;"> Domicilio </td>
                    <td style="font-weight:bold;"> Barrio </td>
                    <td style="font-weight:bold;"> Teléfono </td>
                    <?php
                    if ($dirigente['role'] == 1 or $dirigente['role'] == 2) {
                    ?>
                        <td style="font-weight:bold;"> Acciones </td>
                    <?php
                    }
                    ?>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($dirigente['role'] == 1 || $dirigente['role'] == 3) {
                    $votants = $connec->prepare("SELECT * 
                    FROM persons P
                    JOIN person_user U
                    ON P.id = U.id_person");
                    $votants->execute();
                    $resulvotants = $votants->fetchAll();
                    $i = 1;
                    foreach ($resulvotants as $row) {

                ?>
                        <tr>
                            <td> <?php echo  $i; ?> </td>
                            <td> <?php echo $row['name']  ?> </td>
                            <td> <?php echo $row['lastname'] ?> </td>
                            <td> <?php if (strlen($row['dni']) > 6) : echo $row['dni'];
                                            endif ?></td>
                            <td> <?php echo $row['address'] ?> </td>
                            <td> <?php
                                    $result1 = $connec->prepare("SELECT name
                             FROM districts D
                             JOIN district_person P
                             ON D.id = P.id_district
                             WHERE P.id_person = " . $row['id_person']);
                                    $result1->execute();
                                    $name_dis = $result1->fetch();
                                    echo $name_dis[0];
                                    ?> </td>
                            <td> <?php echo $row['phone'] ?> </td>
                            <td>
                                <?php
                                if ($dirigente['role'] == 1) {
                                ?>
                                    <!-- ID de files -->
                                    <div class="button-group">
                                        <form style="display:inline-block;" action="upperson.php" method="post">
                                            <button type="submit" name="id" value="<?php echo $row['id_person'] ?>" title="Editar" class="btn btn-success"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                                </svg></button>
                                        </form>
                                        <form style="display:inline-block;" action="deleteperson.php" method="post">
                                            <button type="submit" name="id" value="<?php echo $row['id_person'] ?>" title="Eliminar" class="btn btn-danger" onclick="return ConfirmDelete()"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                                                </svg></button>
                                        </form>
                                    <?php
                                } ?>
                                    </div>
                            </td>
                        </tr>
                    <?php
                        $i++;
                    }
                } else {
                    $id = $connec->prepare("SELECT id FROM users WHERE email ='$mail'");
                    $id->execute();
                    $rid = $id->fetch();

                    $votants = $connec->prepare("SELECT * 
                    FROM persons P
                    JOIN person_user U
                    ON P.id = U.id_person
                    WHERE '$rid[0]' = U.id_user");
                    $votants->execute();
                    $resulvotants = $votants->fetchAll();
                    $i = 1;
                    foreach ($resulvotants as $row) {
                    ?>

                        <tr>
                            <td> <?php echo  $i; ?> </td>
                            <td> <?php echo $row['name']  ?> </td>
                            <td> <?php echo $row['lastname'] ?> </td>
                            <td> <?php if (strlen($row['dni']) > 6) : echo $row['dni'];
                                            endif ?></td>
                            <td> <?php echo $row['address'] ?> </td>
                            <td> <?php
                                    $result1 = $connec->prepare("SELECT name
                             FROM districts D
                             JOIN district_person P
                             ON D.id = P.id_district
                             WHERE P.id_person = " . $row['id_person']);
                                    $result1->execute();
                                    $name_dis = $result1->fetch();
                                    echo $name_dis[0];
                                    ?> </td>
                            <td> <?php echo $row['phone'] ?> </td>

                            <td>
                                <!-- ID de files -->
                                <div class="button-group">
                                    <form style="display:inline-block;" action="upperson.php" method="post">
                                        <button type="submit" name="id" value="<?php echo $row['id_person'] ?>" title="Editar" class="btn btn-success"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                            </svg></button>
                                    </form>
                                    <form style="display:inline-block;" action="deleteperson.php" method="post">
                                        <button type="submit" name="id" value="<?php echo $row['id_person'] ?>" title="Eliminar" class="btn btn-danger" onclick="return ConfirmDelete()"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                                <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                                            </svg></button>
                                    </form>
                                </div>
                            </td>
                    <?php
                        $i++;
                    }
                }
                    ?>
                        </tr>
            </tbody>
        </table>
    </div>
</body>

</html>