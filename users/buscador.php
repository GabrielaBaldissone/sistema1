<?php session_start();

if (!isset($_SESSION['usuario'])) {
    header('Location: ../index.php');
}

include('../db.php');
$connec = connect();

$email = ($_SESSION['usuario']);

$nombre = $connec->prepare("SELECT * FROM users WHERE email = '$email'");
$nombre->execute();
$dirigente = $nombre->fetch();


$buscador = $connec->prepare("SELECT * 
FROM persons P
JOIN person_user U
ON P.id = U.id_person
WHERE name LIKE LOWER('%" . $_POST["buscar"] . "%') OR 
lastname LIKE LOWER('%" . $_POST["buscar"] . "%') OR
dni LIKE LOWER('%" . $_POST["buscar"] . "%')");
$buscador->execute();
$resultado = $buscador->fetchAll();
?>

<h5 class="card-tittle"> Resultados encontrados: </h5>
<?php
if ($dirigente['role'] == 1 || $dirigente['role'] == 3) {
?>
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
                if ($dirigente['role'] == 1 || $dirigente['role'] == 2) {
                ?>
                    <td style="font-weight:bold;"> Acciones </td>
                <?php  } ?>
            </tr>
        </thead>
        <?php
        $i = 1;
        foreach ($resultado as $row) { ?>
            <tbody>
                <tr>
                    <td> <?php echo $i; ?> </td>
                    <td> <?php echo $row['name']  ?> </td>
                    <td> <?php echo $row['lastname'] ?> </td>
                    <td> <?php if (strlen($row['dni']) >= 7) : echo $row['dni'];
                            endif ?></td>
                    <td> <?php echo $row['address']  ?> </td>
                    <td> <?php
                            $result = $connec->prepare("SELECT name
                             FROM districts D
                             JOIN district_person P
                             ON D.id = P.id_district
                             WHERE P.id_person = " . $row['id_person']);
                            $result->execute();
                            $name_dis = $result->fetch();
                            echo $name_dis[0];
                            ?> </td>
                    <td> <?php echo $row['phone'] ?> </td>
                    <td>
                        <?php
                        if ($dirigente['role'] == 1 || $dirigente['role'] == 2) {
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

                            </div>
                        <?php
                        }
                        ?>
                    </td>
                </tr>
            <?php
            $i++;
        } ?>
            </tbody>
    </table>
<?php } elseif ($dirigente['role'] == 2) {

    $buscador = $connec->prepare("SELECT * 
FROM persons P
JOIN person_user U
ON P.id = U.id_person AND U.id_user = '$dirigente[id]' 
WHERE name LIKE LOWER('%" . $_POST["buscar"] . "%') OR 
lastname LIKE LOWER('%" . $_POST["buscar"] . "%') OR
dni LIKE LOWER('%" . $_POST["buscar"] . "%')");
    $buscador->execute();
    $resultado = $buscador->fetchAll();
?>

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
                if ($dirigente['role'] == 1 || $dirigente['role'] == 2) {
                ?>
                    <td style="font-weight:bold;"> Acciones </td>
                <?php  } ?>
            </tr>
        </thead>
        <?php
        $i = 1;
        foreach ($resultado as $row) { ?>
            <tbody>
                <tr>
                    <td> <?php echo $i; ?> </td>
                    <td> <?php echo $row['name']  ?> </td>
                    <td> <?php echo $row['lastname'] ?> </td>
                    <td> <?php if (strlen($row['dni']) >= 7) : echo $row['dni'];
                            endif ?></td>
                    <td> <?php echo $row['address']  ?> </td>
                    <td> <?php
                            $result = $connec->prepare("SELECT name
                             FROM districts D
                             JOIN district_person P
                             ON D.id = P.id_district
                             WHERE P.id_person = " . $row['id_person']);
                            $result->execute();
                            $name_dis = $result->fetch();
                            echo $name_dis[0];
                            ?> </td>
                    <td> <?php echo $row['phone'] ?> </td>
                    <td>
                        <?php
                        if ($dirigente['role'] == 1 || $dirigente['role'] == 2) {
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

                            </div>
                        <?php
                        }
                        ?>
                    </td>
                </tr>
            <?php
            $i++;
        } ?>
            </tbody>
    </table>
<?php
} ?>