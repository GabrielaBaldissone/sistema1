<?php session_start();

if (!isset($_SESSION['usuario'])) {
    header('Location: ../index.php');
}

$mail = ($_SESSION['usuario']);

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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,200;0,300;1,200;1,300&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Contenido</title>
</head>


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
                url: 'buscarusuario.php',
                success: function(data) {
                    document.getElementById("datos_buscador").innerHTML = data;
                }
            });
        }
    </script>

    <div id="datos_buscador" class="container">
        <br />
        <br />
        <div>
            <table class="table">
                <thead>
                    <h4 style="position:relative; font-weight:bold;">Lista de Usuarios: </h4>
                    <div style="text-align:right; margin: 0 auto;">
                        <a class="btn btn-primary me-md-2" title="Agregar usuario" href="usuarios.php"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-person-plus" viewBox="0 0 16 16">
                                <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z" />
                                <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z" />
                            </svg> Agregar</a>
                    </div>

                    <tr>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Categoria</th>
                        <th>Acciones</th>

                    </tr>
                </thead>
                <tbody>
                    <?php

                    $result = $connec->prepare("SELECT id, name, lastname, role FROM users");
                    $result->execute();
                    $resultado = $result->fetchAll();


                    foreach ($resultado as $row) {

                    ?>
                        <tr>

                            <td><?php echo $row['name'] ?></td>
                            <td><?php echo $row['lastname'] ?></td>
                            <td><?php
                                if ($row['role'] == 1) : echo "Administrador";
                                elseif ($row['role'] == 2) : echo "Dirigente";
                                elseif ($row['role'] == 3) : echo "Invitado";
                                endif;
                                ?></td>
                            <td>
                                <div class="button-group">
                                    <form style="display:inline-block;" action="read.php" method="post">
                                        <button type="submit" name="id" value="<?php echo $row['id'] ?>" title="Ver" class="btn btn-info"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                                <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                                                <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                                            </svg></button>
                                    </form>
                                    <form style="display:inline-block;" action="update.php" method="post">
                                        <button type="submit" name="id" value="<?php echo $row['id'] ?>" title="Editar" class="btn btn-success"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                            </svg></button>
                                    </form>

                                <?php

                            }
                                ?>
                                </div>
                            </td>
                        </tr>

                </tbody>

            </table>

        </div>
    </div>
</body>

</html>