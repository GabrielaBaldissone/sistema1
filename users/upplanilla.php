<?php session_start();

if (!isset($_SESSION['usuario'])) {
    header('Location: ../index.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,200;0,300;1,200;1,300&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Update Planilla</title>
</head>

<body>
    <?php
        require 'nav.php';
    ?>
    <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
        <br />
        <h5 style="position:relative; margin:10px auto; text-align:center; font-weight:bold;">Planilla de votantes:</h5>

        <div class="table-responsive" style="max-width: 90%; position:relative; margin:10px auto;">
            <table class="table">
                <tbody>
                    <tr>
                        <td style="font-weight:bold;"> N° </td>
                        <td style="font-weight:bold;"> Nombre </td>
                        <td style="font-weight:bold;"> Apellido </td>
                        <td style="font-weight:bold;"> DNI </td>
                        <td style="font-weight:bold;"> Domicilio </td>
                        <td style="font-weight:bold;"> Barrio </td>
                        <td style="font-weight:bold;"> Teléfono </td>
                    </tr>
                    <?php

                    $id_file = $_POST['id'];
                    $result = $connec->prepare("SELECT id_person, name, lastname, dni, address, phone
                        FROM persons P 
                        JOIN file_person F
                        ON P.id = F.id_person
                        WHERE F.id_file = '$id_file'");
                    $result->execute();
                    $i = 1;
                    while ($resultado = $result->fetch()) {
                        $id_person = $resultado['id_person'];

                    ?>
                        <tr>
                            <td hidden> <input type="text" name="id2[<?php $resultado['id_person'] ?>]" value="<?php echo $id_person ?>">
                            <td><?php echo $i ?></td>
                            <td> <input type="text" name="name[<?php $resultado['id_person'] ?>]" value="<?php echo $resultado['name'] ?>"> </input> </td>
                            <td> <input type="text" name="lastname[<?php $resultado['id_person'] ?>]" value="<?php echo $resultado['lastname'] ?>"> </input> </td>
                            <td> <input type="number" name="dni[<?php $resultado['id_person'] ?>]" value="<?php if (strlen($resultado['dni']) >= 7) : echo $resultado['dni'];
                                                                                                            endif ?>"> </input> </td>
                            <td> <input type="text" name="address[<?php $resultado['id_person'] ?>]" value="<?php echo $resultado['address'] ?>"> </input> </td>
                            <td><select name="district[<?php $resultado['id_person'] ?>]">
                                    <?php
                                    $resul = $connec->prepare("SELECT name
                                   FROM districts D
                                   JOIN district_person P
                                   ON D.id = P.id_district
                                   WHERE P.id_person = " . $id_person);
                                    $resul->execute();
                                    $name_dis = $resul->fetch();

                                    $result1 = $connec->prepare("SELECT * FROM districts ORDER BY name ASC");
                                    $result1->execute();
                                    while ($resultado2 = $result1->fetch()) {

                                        $id_dis = $resultado2[0];
                                        $na_dis = $resultado2[1];

                                        if ($na_dis == $name_dis[0]) { ?>
                                            <option value="<?php echo $id_dis; ?>" selected><?php echo $na_dis; ?></option>
                                        <?php } else { ?>
                                            <option value="<?php echo $id_dis; ?>"><?php echo $na_dis; ?></option>
                                    <?php
                                        }
                                    }
                                    ?>
                                </select></td>

                            <td> <input type="number" name="phone[<?php $resultado['id_person'] ?>]" value="<?php echo $resultado['phone'] ?>"> </input> </td>
                        </tr>
                    <?php
                        $i++;
                    }
                    ?>
                </tbody>
            </table>
            <?php if (!empty($error)) : ?>
                <div style="margin: 10px 0; padding: 12px; border-radius: 4px 4px 4px 4px; width: 50%;" class="alert alert-danger alert-dismissible fade show col-md-3" role="alert">
                    <strong><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-exclamation-lg" viewBox="0 0 16 16">
                            <path d="M7.005 3.1a1 1 0 1 1 1.99 0l-.388 6.35a.61.61 0 0 1-1.214 0L7.005 3.1ZM7 12a1 1 0 1 1 2 0 1 1 0 0 1-2 0Z" />
                        </svg> <?php echo $error; ?></strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif ?>
            <?php if (!empty($error1)) : ?>
                <div class="alert alert-success alert-dismissible fade show col-md-4" role="alert">
                    <strong><?php echo $error1; ?></strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php
            endif
            ?>
        </div>
        <form action="uppla.php" method="post">
            <button style="position:relative; margin:10px auto; text-align: center; display: flex;" type="submit" name="id" value="<?php echo $id_file ?>" title="Guardar" class="btn btn-success"><svg xmlns="http://www.w3.org/2000/svg" width="40" height="20" fill="currentColor" class="bi bi-file-earmark-arrow-down" viewBox="0 0 16 16">
                    <path d="M8.5 6.5a.5.5 0 0 0-1 0v3.793L6.354 9.146a.5.5 0 1 0-.708.708l2 2a.5.5 0 0 0 .708 0l2-2a.5.5 0 0 0-.708-.708L8.5 10.293V6.5z" />
                    <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z" />
                </svg> Guardar Cambios </button>
        </form>
        <form action="planillas.php" method="post">
            <button style="position:relative; margin:10px auto; text-align: center; display: flex;" type="submit" name="id" title="Volver" class="btn btn-success"><svg xmlns="http://www.w3.org/2000/svg" width="40" height="20" fill="currentColor" class="bi bi-arrow-left-square" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M15 2a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2zM0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm11.5 5.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z" />
                </svg> Volver </button>
        </form>
    </form>
</body>

</html>