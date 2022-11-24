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
    <title>Agregar votantes</title>
</head>

<body>
    <form >
        <br />
        <h5 style="position:relative; margin:10px auto; text-align:center; font-weight:bold;" >Planilla de votantes:</h5>

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
                    $resultado = $result->fetchAll();
                    $i = 1;
                    foreach ($resultado as $row) {
                    ?>

                        <tr>
                            <td> <?php echo  $i; ?> </td>
                            <td> <?php echo $row['name']  ?> </td>
                            <td> <?php echo $row['lastname'] ?> </td>
                            <td> <?php if (strlen($row['dni']) >= 7) : echo $row['dni'];
                                    endif ?> </td>
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
                        </tr>
                    <?php
                        $i++;
                    }
                    ?>

                </tbody>

            </table>
        </div>

    </form>
    <div style="position:center; margin: 0 auto; text-align: center;">
        <a href="planillas.php" type="submit" class="btn btn-success"><svg xmlns="http://www.w3.org/2000/svg" width="50" height="20" fill="currentColor" class="bi bi-arrow-left-square" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M15 2a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2zM0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm11.5 5.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z" />
            </svg>Volver</a>
    </div>
</body>

</html>