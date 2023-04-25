<?php session_start();

if (!isset($_SESSION['usuario'])) {
    header('Location: ../index.php');
}

include('../db.php');
$connec = connect();

$mail = ($_SESSION['usuario']);

$nombre = $connec->prepare("SELECT name, lastname, role FROM users WHERE email = '$mail'");
$nombre->execute();
$dirigente = $nombre->fetch();

?>

<table class="table">
    <thead>
        <tr>
            <th>Planilla N°</th>
            <th>Dirigente </th>
            <th>Acciones </th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($dirigente['role'] == 1 || $dirigente['role'] == 3) {
            $buscador = $connec->prepare("SELECT name, lastname, id_file
                                        FROM users U
                                        JOIN file_user P
                                        ON U.id = P.id_user
                                        WHERE id_file LIKE LOWER('%" . $_POST["buscar"] . "%')");
            $buscador->execute();
            $resultado = $buscador->fetchAll();


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
                            if ($dirigente['role'] == 1) {
                            ?> 
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
                        WHERE name LIKE LOWER('%" . $_POST["buscar"] . "%') OR 
                        lastname LIKE LOWER('%" . $_POST["buscar"] . "%')");
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