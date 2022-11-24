<?php session_start();

if (!isset($_SESSION['usuario'])) {
    header('Location: ../index.php');
}

require('nav.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,200;0,300;1,200;1,300&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Agregar planilla</title>
</head>

<body>

    <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
        <br />
        <h5 style="position:relative; margin:10px auto; text-align:center; font-weight:bold;">Planilla de votantes:</h5>

        <!-- Primera persona -->
        <div class="table-responsive" style="max-width: 90%; position:relative; margin:10px auto;">
            <table class="table">
                <tbody>
                    <tr>
                        <td style="font-weight:bold;"> N° </td>
                        <td style="font-weight:bold;"> Nombre </td>
                        <td style="font-weight:bold;"> Apellido </td>
                        <td style="font-weight:bold;"> DNI <label style="color:red">*</label></td>
                        <td style="font-weight:bold;"> Domicilio </td>
                        <td style="font-weight:bold;"> Barrio </td>
                        <td style="font-weight:bold;"> Teléfono </td>
                    </tr>
                    <tr>
                        <td type="number" name="orden"> 1 </td>
                        <td> <input type="text" name="name1" value="<?php if (isset($name)) echo $name ?>"> </input> </td>
                        <td> <input type="text" name="lastname1" value="<?php if (isset($lastname)) echo $lastname ?>"> </input> </td>
                        <td> <input type="number" name="dni1" value="<?php if (strlen($dni) >= 7) : echo $dni;
                                                                        endif ?>" required> </input> </td>
                        <td> <input type="text" name="address1" value="<?php if (isset($address)) echo $address ?>"> </input> </td>
                        <td><select name="id_districts1" value="<?php if (isset($districts)) echo $districts ?>">
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
                        <td> <input type="number" name="phone1" value="<?php if (isset($phone)) echo $phone ?>"> </input> </td>
                    </tr>
                </tbody>
            </table>
            <?php if (!empty($errores)) : ?>
                <div style="margin: 10px 0; padding: 12px; border-radius: 4px 4px 4px 4px;" class="alert alert-danger alert-dismissible fade show col-md-3" role="alert">
                    <strong><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-exclamation-lg" viewBox="0 0 16 16">
                            <path d="M7.005 3.1a1 1 0 1 1 1.99 0l-.388 6.35a.61.61 0 0 1-1.214 0L7.005 3.1ZM7 12a1 1 0 1 1 2 0 1 1 0 0 1-2 0Z" />
                        </svg> <?php echo $errores; ?></strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif ?>
        </div>

        <!-- Segunda persona -->
        <div class="table-responsive" style="max-width: 90%; position:relative; margin:10px auto;">
            <table class="table">
                <tbody>
                    <tr>
                        <td style="font-weight:bold;"> N° </td>
                        <td style="font-weight:bold;"> Nombre </td>
                        <td style="font-weight:bold;"> Apellido </td>
                        <td style="font-weight:bold;"> DNI <label style="color:red">*</label></td>
                        <td style="font-weight:bold;"> Domicilio </td>
                        <td style="font-weight:bold;"> Barrio </td>
                        <td style="font-weight:bold;"> Teléfono </td>
                    </tr>
                    <tr>
                        <td type="number" name="orden"> 2 </td>
                        <td> <input type="text" name="name2" value="<?php if (isset($name2)) echo $name2 ?>"> </input> </td>
                        <td> <input type="text" name="lastname2" value="<?php if (isset($lastname2)) echo $lastname2 ?>"> </input> </td>
                        <td> <input type="number" name="dni2" value="<?php if (strlen($dni2) >= 7) : echo $dni2;
                                                                        endif ?>"> </input> </td>
                        <td> <input type="text" name="address2" value="<?php if (isset($address2)) echo $address2 ?>"> </input> </td>
                        <td><select name="id_districts2" value="<?php if (isset($districts2)) echo $districts2 ?>">
                                <?php

                                $result2 = $connec->prepare("SELECT * FROM districts ORDER BY name ASC");
                                $result2->execute();
                                $resultado2 = $result2->fetchAll();

                                foreach ($resultado2 as $row) {
                                    echo "
                        <option value=" . $row['id'] . ">" . $row['name'] . "</option>
                        ";
                                }
                                ?>
                            </select> </td>

                        <td> <input type="number" name="phone2" value="<?php if (isset($phone2)) echo $phone2 ?>"> </input> </td>
                    </tr>
                </tbody>
            </table>
            <?php if (!empty($errores2)) : ?>
                <div style="margin: 10px 0; padding: 12px; border-radius: 4px 4px 4px 4px;" class="alert alert-danger alert-dismissible fade show col-md-3" role="alert">
                    <strong><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-exclamation-lg" viewBox="0 0 16 16">
                            <path d="M7.005 3.1a1 1 0 1 1 1.99 0l-.388 6.35a.61.61 0 0 1-1.214 0L7.005 3.1ZM7 12a1 1 0 1 1 2 0 1 1 0 0 1-2 0Z" />
                        </svg> <?php echo $errores2; ?></strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif ?>
        </div>

        <!-- Tercera persona -->
        <div class="table-responsive" style="max-width: 90%; position:relative; margin:10px auto;">
            <table class="table">
                <tbody>
                    <tr>
                        <td style="font-weight:bold;"> N° </td>
                        <td style="font-weight:bold;"> Nombre </td>
                        <td style="font-weight:bold;"> Apellido </td>
                        <td style="font-weight:bold;"> DNI <label style="color:red">*</label></td>
                        <td style="font-weight:bold;"> Domicilio </td>
                        <td style="font-weight:bold;"> Barrio </td>
                        <td style="font-weight:bold;"> Teléfono </td>
                    </tr>
                    <tr>
                        <td type="number" name="orden"> 3 </td>
                        <td> <input type="text" name="name3" value="<?php if (isset($name3)) echo $name3 ?>"> </input> </td>
                        <td> <input type="text" name="lastname3" value="<?php if (isset($lastname3)) echo $lastname3 ?>"> </input> </td>
                        <td> <input type="number" name="dni3" value="<?php if (strlen($dni3) >= 7) : echo $dni3;
                                                                        endif ?>"> </input> </td>
                        <td> <input type="text" name="address3" value="<?php if (isset($address3)) echo $address3 ?>"> </input> </td>
                        <td><select name="id_districts3" value="<?php if (isset($districts3)) echo $districts3 ?>">
                                <?php

                                $result3 = $connec->prepare("SELECT * FROM districts ORDER BY name ASC");
                                $result3->execute();
                                $resultado3 = $result3->fetchAll();

                                foreach ($resultado3 as $row) {
                                    echo "
                        <option value=" . $row['id'] . ">" . $row['name'] . "</option>
                        ";
                                }
                                ?>
                            </select></td>

                        <td> <input type="number" name="phone3" value="<?php if (isset($phone3)) echo $phone3 ?>"> </input> </td>

                    </tr>
                </tbody>
            </table>
            <?php if (!empty($errores3)) : ?>
                <div style="margin: 10px 0; padding: 12px; border-radius: 4px 4px 4px 4px;" class="alert alert-danger alert-dismissible fade show col-md-3" role="alert">
                    <strong><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-exclamation-lg" viewBox="0 0 16 16">
                            <path d="M7.005 3.1a1 1 0 1 1 1.99 0l-.388 6.35a.61.61 0 0 1-1.214 0L7.005 3.1ZM7 12a1 1 0 1 1 2 0 1 1 0 0 1-2 0Z" />
                        </svg> <?php echo $errores3; ?></strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif ?>
        </div>

        <!-- Cuarta persona -->
        <div class="table-responsive" style="max-width: 90%; position:relative; margin:10px auto;">
            <table class="table">
                <tbody>
                    <tr>
                        <td style="font-weight:bold;"> N° </td>
                        <td style="font-weight:bold;"> Nombre </td>
                        <td style="font-weight:bold;"> Apellido </td>
                        <td style="font-weight:bold;"> DNI <label style="color:red">*</label></td>
                        <td style="font-weight:bold;"> Domicilio </td>
                        <td style="font-weight:bold;"> Barrio </td>
                        <td style="font-weight:bold;"> Teléfono </td>
                    </tr>
                    <tr>
                        <td type="number" name="orden"> 4 </td>
                        <td> <input type="text" name="name4" value="<?php if (isset($name4)) echo $name4 ?>"> </input> </td>
                        <td> <input type="text" name="lastname4" value="<?php if (isset($lastname4)) echo $lastname4 ?>"> </input> </td>
                        <td> <input type="number" name="dni4" value="<?php if (strlen($dni4) >= 7) : echo $dni4;
                                                                        endif ?>"> </input> </td>
                        <td> <input type="text" name="address4" value="<?php if (isset($address4)) echo $address4 ?>"> </input> </td>
                        <td><select name="id_districts4" value="<?php if (isset($districts4)) echo $districts4 ?>">
                                <?php

                                $result4 = $connec->prepare("SELECT * FROM districts ORDER BY name ASC");
                                $result4->execute();
                                $resultado4 = $result4->fetchAll();

                                foreach ($resultado4 as $row) {
                                    echo "
                        <option value=" . $row['id'] . ">" . $row['name'] . "</option>
                        ";
                                }
                                ?>
                            </select></td>

                        <td> <input type="number" name="phone4" value="<?php if (isset($phone4)) echo $phone4 ?>"> </input> </td>
                    </tr>
                </tbody>
            </table>
            <?php if (!empty($errores4)) : ?>
                <div style="margin: 10px 0; padding: 12px; border-radius: 4px 4px 4px 4px;" class="alert alert-danger alert-dismissible fade show col-md-3" role="alert">
                    <strong><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-exclamation-lg" viewBox="0 0 16 16">
                            <path d="M7.005 3.1a1 1 0 1 1 1.99 0l-.388 6.35a.61.61 0 0 1-1.214 0L7.005 3.1ZM7 12a1 1 0 1 1 2 0 1 1 0 0 1-2 0Z" />
                        </svg> <?php echo $errores4; ?></strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif ?>
            <label style="position:relative; margin:10px auto; color:red">* Dato obligatorio.</label>
            <?php if (!empty($error)) : ?>
                <div style="margin: 10px 0; padding: 12px; border-radius: 4px 4px 4px 4px;" class="alert alert-danger alert-dismissible fade show col-md-3" role="alert">
                    <strong><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-exclamation-lg" viewBox="0 0 16 16">
                            <path d="M7.005 3.1a1 1 0 1 1 1.99 0l-.388 6.35a.61.61 0 0 1-1.214 0L7.005 3.1ZM7 12a1 1 0 1 1 2 0 1 1 0 0 1-2 0Z" />
                        </svg> <?php echo $error; ?></strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif ?>
        </div>
        <button style="position:relative; margin:10px auto; text-align: center; display: flex;" type="submit" class="btn btn-success">Agregar Planilla</button>
    </form>
</body>

</html>