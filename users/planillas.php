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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,200;0,300;1,200;1,300&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Contenido</title>
</head>

<script type="text/javascript">
    function ConfirmDelete() {
        var respuesta = confirm("¿Seguro desea eliminar la planilla?");

        if (respuesta == true) {
            return true;
        } else {
            return false;
        }
    }
</script>

<body>

    <div class="container mt-5">
        <div class="col-8">
            <div class="mb-3">
                <label class="form-label" style="font-weight:bold;"> Buscador: </label>
                <input onkeyup="buscar_ahora($('#buscar').val());" style="width: 300px;" class="form-control" type="text" placeholder="Buscar" id="buscar" name="buscar">
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
                url: 'buscarpla.php',
                success: function(data) {
                    document.getElementById("datos_buscador").innerHTML = data;
                }
            });
        }
    </script>

    <div >
        <br /> <br />
        <div id="datos_buscador" class="container">
            <table class="table">
                <div style="display:inline-block;" class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <?php
                    $mail = ($_SESSION['usuario']);

                    $role = $connec->prepare("SELECT role FROM users WHERE email ='$mail'");
                    $role->execute();
                    $roles = $role->fetch();

                    if ($roles['role'] == 1 or $roles['role'] == 2) {
                    ?>
                        <a class="btn btn-secondary" href="votantesadd.php"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-plus" viewBox="0 0 16 16">
                                <path d="M8 6.5a.5.5 0 0 1 .5.5v1.5H10a.5.5 0 0 1 0 1H8.5V11a.5.5 0 0 1-1 0V9.5H6a.5.5 0 0 1 0-1h1.5V7a.5.5 0 0 1 .5-.5z" />
                                <path d="M14 4.5V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h5.5L14 4.5zm-3 0A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V4.5h-2z" />
                            </svg> Planilla </a>
                    <?php
                    }
                    ?>
                </div>
                <thead>
                    <tr>
                        <th>Planilla N°</th>
                        <th>Dirigente </th>
                        <th>Acciones </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($roles['role'] == 1 || $roles['role'] == 3) {
                        $result = $connec->prepare("SELECT name, lastname, id_file
                        FROM users U
                        JOIN file_user F
                        ON U.id = F.id_user
                        ORDER BY id_file DESC");
                        $result->execute();
                        $resultado = $result->fetchAll();

                        foreach ($resultado as $row) {
                    ?>
                            <tr>
                                <!-- ID de files -->
                                <td><?php echo $row['id_file'] ?></td>

                                <!-- NAME de USERS (La persona que creo la planilla) -->
                                <td><?php echo $row['name'] . " " . $row['lastname'] ?></td>
                                <td>
                                    <!-- ID de files -->
                                    <div class="button-group">
                                        <form style="display:inline-block;" action="votantesread.php" method="post">
                                            <button type="submit" name="id" value="<?php echo $row['id_file'] ?>" title="Ver" class="btn btn-info"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                                    <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                                                    <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                                                </svg></button>
                                        </form>
                                        <?php
                                        if ($roles['role'] == 1) {
                                        ?>
                                            <form style="display:inline-block;" action="uppla.php" method="post">
                                                <button type="submit" name="id" value="<?php echo $row['id_file'] ?>" title="Editar" class="btn btn-success"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                                    </svg></button>
                                            </form>
                                            <form style="display:inline-block;" action="deletefile.php" method="post">
                                                <button type="submit" name="id" value="<?php echo $row['id_file'] ?>" title="Eliminar" class="btn btn-danger" onclick="return ConfirmDelete()"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                                        <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                                                    </svg></button>
                                            </form>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                </td>
                            <?php
                        }
                    } else {
                        $id = $connec->prepare("SELECT id FROM users WHERE email ='$mail'");
                        $id->execute();
                        $rid = $id->fetch();

                        $result = $connec->prepare("SELECT name, lastname, id_file
                        FROM users U
                        JOIN file_user F
                        ON U.id = F.id_user
                        WHERE '$rid[0]' = F.id_user
                        ORDER BY id_file DESC");
                        $result->execute();
                        $resultado = $result->fetchAll();

                        foreach ($resultado as $row) {
                            ?>
                            <tr>
                                <!-- ID de files -->
                                <td><?php echo $row['id_file'] ?></td>

                                <!-- NAME de USERS (La persona que creo la planilla) -->
                                <td><?php echo $row['name'] . " " . $row['lastname'] ?></td>
                                <td>
                                    <!-- ID de files -->
                                    <div class="button-group">

                                        <form style="display:inline-block;" action="votantesread.php" method="post">
                                            <button type="submit" name="id" value="<?php echo $row['id_file'] ?>" title="Ver" class="btn btn-info"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                                    <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                                                    <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                                                </svg></button>
                                        </form>
                                        <form style="display:inline-block;" action="uppla.php" method="post">
                                            <button type="submit" name="id" value="<?php echo $row['id_file'] ?>" title="Editar" class="btn btn-success"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                                </svg></button>
                                        </form>
                                        <form style="display:inline-block;" action="deletefile.php" method="post">
                                            <button type="submit" name="id" value="<?php echo $row['id_file'] ?>" title="Eliminar" class="btn btn-danger" onclick="return ConfirmDelete()"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                                                </svg></button>
                                        </form>
                                    </div>
                                </td>
                        <?php
                        }
                    }
                        ?>
                            </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>