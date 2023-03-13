<?php session_start();

if (!isset($_SESSION['usuario'])) {
    header('Location: ../index.php');
}

require('nav.php');

$result = $connec->prepare("SELECT * FROM districts ORDER BY name ASC");
$result->execute();
$resultado = $result->fetchAll();

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
    <br />
    <h5 style="position:relative; margin:10px auto; text-align:center; font-weight:bold;">Planilla de votantes:</h5>
    <br />

    <form id="formulario" method="POST">
        <div id="persona1">
            <div class="container border border-5">
                <div class="row">
                    <div class="col">
                        <label>Nombre</label>
                        <br />
                        <input type="text" name="name1"> </input>
                    </div>
                    <div class="col order-1">
                        <label>Apellido</label>
                        <br />
                        <input type="text" name="lastname1"> </input>
                    </div>
                    <div class="col order-2">
                        <label>DNI</label>
                        <br />
                        <input type="number" name="dni1"> </input>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label>Direccion</label>
                        <br />
                        <input type="text" name="address1" > </input>
                    </div>
                    <div class="col order-1">
                        <label>Barrio</label>
                        <br />
                        <select name="id_districts1">
                            <?php
                            foreach ($resultado as $row) {
                                echo
                                '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col order-2">
                        <label>Telefono</label>
                        <br />
                        <input type="number" name="phone1"> </input>
                    </div>
                </div>
                
            </div>
        </div>
        <br />
        <div id="persona2">
            <div class="container border border-5">
                <div class="row">
                    <div class="col">
                        <label>Nombre</label>
                        <br />
                        <input type="text" name="name2"> </input>
                    </div>
                    <div class="col order-1">
                        <label>Apellido</label>
                        <br />
                        <input type="text" name="lastname2"> </input>
                    </div>
                    <div class="col order-2">
                        <label>DNI</label>
                        <br />
                        <input type="number" name="dni2"> </input>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label>Direccion</label>
                        <br />
                        <input type="text" name="address2" > </input>
                    </div>
                    <div class="col order-1">
                        <label>Barrio</label>
                        <br />
                        <select name="id_districts2">
                            <?php
                            foreach ($resultado as $row) {
                                echo
                                '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col order-2">
                        <label>Telefono</label>
                        <br />
                        <input type="number" name="phone2"> </input>
                    </div>
                </div>
                
            </div>
        </div>
        <br />
        <div id="persona3">
            <div class="container border border-5">
                <div class="row">
                    <div class="col">
                        <label>Nombre</label>
                        <br />
                        <input type="text" name="name3"> </input>
                    </div>
                    <div class="col order-1">
                        <label>Apellido</label>
                        <br />
                        <input type="text" name="lastname3"> </input>
                    </div>
                    <div class="col order-2">
                        <label>DNI</label>
                        <br />
                        <input type="number" name="dni3"> </input>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label>Direccion</label>
                        <br />
                        <input type="text" name="address3" > </input>
                    </div>
                    <div class="col order-1">
                        <label>Barrio</label>
                        <br />
                        <select name="id_districts3">
                            <?php
                            foreach ($resultado as $row) {
                                echo
                                '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col order-2">
                        <label>Telefono</label>
                        <br />
                        <input type="number" name="phone3"> </input>
                    </div>
                </div>
                
            </div>
        </div>
        <br />
        <div id="persona4">
            <div class="container border border-5">
                <div class="row">
                    <div class="col">
                        <label>Nombre</label>
                        <br />
                        <input type="text" name="name4"> </input>
                    </div>
                    <div class="col order-1">
                        <label>Apellido</label>
                        <br />
                        <input type="text" name="lastname4"> </input>
                    </div>
                    <div class="col order-2">
                        <label>DNI</label>
                        <br />
                        <input type="number" name="dni4"> </input>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label>Direccion</label>
                        <br />
                        <input type="text" name="address4" > </input>
                    </div>
                    <div class="col order-1">
                        <label>Barrio</label>
                        <br />
                        <select name="id_districts4">
                            <?php
                            foreach ($resultado as $row) {
                                echo
                                '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col order-2">
                        <label>Telefono</label>
                        <br />
                        <input type="number" name="phone4"> </input>
                    </div>
                </div>
                
            </div>
        </div>
        <button style="position:relative; margin:10px auto; text-align: center; display: flex;" type="submit" onclick="add()" class="btn btn-success">Agregar Planilla</button>
    </form>
</body>

<script>
    const add = () => {
        const dni1 = document.getElementById("dni1");
        const dni2 = document.getElementById("dni2");
        var formulario = document.getElementById("formulario");
        var request = new XMLHttpRequest();
        request.open("POST", "add.php");
        request.send(new FormData(formulario));
    }
</script>
</html>