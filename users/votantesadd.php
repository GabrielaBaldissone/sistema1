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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
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
                        <input type="text" class="form-control m-1" placeholder="Nombres" id="name1" name="name1"> </input>
                    </div>
                    <div class="col order-1">
                        <input type="text" class="form-control m-1" placeholder="Apellidos" id="lastname1" name="lastname1"> </input>
                    </div>
                    <div class="col order-2">
                        <input type="number" class="form-control m-1" min="99999" max="99999999" placeholder="DNI sin puntos" id="dni1" name="dni1" required> </input>
                        <div id="resultado1" class="m-1"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <input type="text" class="form-control m-1" placeholder="Direccion" id="address1" name="address1" > </input>
                    </div>
                    <div class="col order-1">
                        <select  class="form-select m-1" id="id_districts1" name="id_districts1">
                            <option>Barrio</option>
                            <?php
                            foreach ($resultado as $row) {
                                echo
                                '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col order-2">
                        <input type="number" class="form-control m-1" placeholder="Telefono" id="phone1" name="phone1"> </input>
                    </div>
                </div>
                
            </div>
        </div>
        <br />
        <div id="persona2">
            <div class="container border border-5">
                <div class="row">
                    <div class="col">
                        <input type="text" class="form-control m-1" placeholder="Nombres" name="name2"> </input>
                    </div>
                    <div class="col order-1">
                        <input type="text" class="form-control m-1" placeholder="Apellidos" name="lastname2"> </input>
                    </div>
                    <div class="col order-2">
                        <input type="number" class="form-control m-1" min="99999" max="99999999" placeholder="DNI sin puntos" id="dni2" name="dni2"> </input>
                        <div id="resultado2" class="m-1"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <input type="text" class="form-control m-1" placeholder="Direccion" name="address2" > </input>
                    </div>
                    <div class="col order-1">
                        <select  class="form-select m-1" name="id_districts2">
                            <option>Barrio</option>
                            <?php
                            foreach ($resultado as $row) {
                                echo
                                '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col order-2">
                        <input type="number" class="form-control m-1" placeholder="Telefono" name="phone2"> </input>
                    </div>
                </div>
                
            </div>
        </div>
        <br />
        <div id="persona3">
            <div class="container border border-5">
                <div class="row">
                    <div class="col">
                        <input type="text" class="form-control m-1" placeholder="Nombres" name="name3"> </input>
                    </div>
                    <div class="col order-1">
                        <input type="text" class="form-control m-1" placeholder="Apellidos" name="lastname3"> </input>
                    </div>
                    <div class="col order-2">
                        <input type="number" class="form-control m-1" min="99999" max="99999999" placeholder="DNI sin puntos" id="dni3" name="dni3"> </input>
                        <div id="resultado3" class="m-1"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <input type="text" class="form-control m-1" placeholder="Direccion" name="address3" > </input>
                    </div>
                    <div class="col order-1">
                        <select  class="form-select m-1" name="id_districts3">
                            <option>Barrio</option>
                            <?php
                            foreach ($resultado as $row) {
                                echo
                                '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col order-2">
                        <input type="number" class="form-control m-1" placeholder="Telefono" name="phone3"> </input>
                    </div>
                </div>
                
            </div>
        </div>
        <br />
        <div id="persona4">
            <div class="container border border-5">
                <div class="row">
                    <div class="col">
                        <input type="text" class="form-control m-1" placeholder="Nombres" name="name4"> </input>
                    </div>
                    <div class="col order-1">
                        <input type="text" class="form-control m-1" placeholder="Apellidos" name="lastname4"> </input>
                    </div>
                    <div class="col order-2">
                        <input type="number" class="form-control m-1" min="99999" max="99999999" placeholder="DNI sin puntos" id="dni4" name="dni4"> </input>
                        <div id="resultado4" class="m-1"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <input type="text" class="form-control m-1" placeholder="Direccion" name="address4" > </input>
                    </div>
                    <div class="col order-1">
                        <select  class="form-select m-1" name="id_districts4">
                            <option>Barrio</option>
                            <?php
                            foreach ($resultado as $row) {
                                echo
                                '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col order-2">
                        <input type="number" class="form-control m-1" placeholder="Telefono" name="phone4"> </input>
                    </div>
                </div>
                
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col">
                    <div id="repetido"></div>
                </div>
            </div>
        </div>
        <button style="position:relative; margin:10px auto; text-align: center; display: flex;" onclick="add()" id="boton" class="btn btn-success">Agregar Planilla</button>
    </form>
</body>

<script>
    let response = [];
    const boton = document.getElementById("boton");
    let name1 = document.getElementById("name1");
    let lastname1 = document.getElementById("lastname1");
    let address1 = document.getElementById("address1");
    let id_districts1 = document.getElementById("id_districts1");
    let phone1 = document.getElementById("phone1");
    $(document).ready(function(){
                         
        $("#dni1").keyup(function(e){
            let dni = $("#dni1").val();
            $("#resultado1").queue(function(n) {                            
                $("#resultado1").html('<img src="Ajax-loader.gif" />');                  
                    $.ajax({
                        type: "POST",
                        url: "verification.php",
                        data: "dni="+dni,
                        dataType: "html",
                        error: function(response){
                            $("#resultado1").html("<span style='font-weight:bold;color:red;'>Error</span>");
                        },
                        success: function(data){ 
                            response[0] = data;
                            if(data === "<span style='font-weight:bold;color:orange;'>DNI existente pero sin planilla</span>"){
                                (async () => {
                                    try {
                                        var datos = { dni: dni };
                                        var init = {
                                            method: "POST",
                                            headers: {
                                                'Content-Type': 'application/json'
                                            },
                                            body: JSON.stringify(datos)
                                        };
                                        var response = await fetch('pruebaFetch.php', init);
                                        if (response.ok) {
                                            var respuesta = await response.json();
                                            name1.value = respuesta.name;
                                            lastname1.value = respuesta.lastname;
                                            address1.value = respuesta.address;
                                            id_districts1.value = respuesta.district.id;
                                            phone1.value = respuesta.phone;
                                            console.log(respuesta);
                                            document.close();
                                        } else {
                                            throw new Error(response.statusText);
                                        }
                                    } catch (err) {
                                        console.log("Error al realizar la petición AJAX: " + err.message);
                                    }
                                })();
                            }
                            $("#resultado1").html(data);
                            n();
                        }
                    });                     
                });                   
            });    

        $("#dni2").keyup(function(e){
            let consulta = $("#dni2").val();
            $("#resultado2").queue(function(n) {                            
                $("#resultado2").html('<img src="Ajax-loader.gif" />');                  
                    $.ajax({
                        type: "POST",
                        url: "verification.php",
                        data: "dni="+consulta,
                        dataType: "html",
                        error: function(response){
                            $("#resultado2").html("<span style='font-weight:bold;color:red;'>Error</span>");
                        },
                        success: function(data){ 
                            response[1] = data;
                            $("#resultado2").html(data);
                            n();
                        }
                    });                     
                });                   
            });    

        $("#dni3").keyup(function(e){
            let consulta = $("#dni3").val();
            $("#resultado3").queue(function(n) {                            
                $("#resultado3").html('<img src="Ajax-loader.gif" />');                  
                    $.ajax({
                        type: "POST",
                        url: "verification.php",
                        data: "dni="+consulta,
                        dataType: "html",
                        error: function(response){
                            $("#resultado3").html("<span style='font-weight:bold;color:red;'>Error</span>");
                        },
                        success: function(data){ 
                            response[2] = data;
                            $("#resultado3").html(data);
                            n();
                        }
                    });                     
                });                   
            });  
            
        $("#dni4").keyup(function(e){
        let consulta = $("#dni4").val();
        $("#resultado4").queue(function(n) {                            
            $("#resultado4").html('<img src="Ajax-loader.gif" />');                  
                $.ajax({
                    type: "POST",
                    url: "verification.php",
                    data: "dni="+consulta,
                    dataType: "html",
                    error: function(response){
                        $("#resultado4").html("<span style='font-weight:bold;color:red;'>Error</span>");
                    },
                    success: function(data){ 
                        response[3] = data;
                        $("#resultado4").html(data);
                        n();
                    }
                });                     
            });                   
        });  
    });



    const add = () => {
        const dni1 = document.getElementById("dni1").value;
        const dni2 = document.getElementById("dni2").value;
        const dni3 = document.getElementById("dni3").value;
        const dni4 = document.getElementById("dni4").value;
        const repetido = document.getElementById("repetido");

        if(
        ((dni1 === dni2) && (dni1.length > 0 && dni2.length > 0)) 
        || ((dni1 === dni3) && (dni1.length > 0 && dni3.length > 0)) 
        || ((dni1 === dni4) && (dni1.length > 0 && dni4.length > 0)) 
        || ((dni2 === dni3) && (dni2.length > 0 && dni3.length > 0)) 
        || ((dni2 === dni4) && (dni2.length > 0 && dni4.length > 0))
        || ((dni3 === dni4) && (dni3.length > 0 && dni4.length > 0))
        ){
            repetido.innerHTML = "<div class='container alert alert-danger mt-4' role='alert'>Hay DNIs repetidos en el formulario.</div>";
            event.preventDefault();
        }

        if(response[0] === "<span style='font-weight:bold;color:red;'>DNI existente y con planilla</span>" 
        || response[1] === "<span style='font-weight:bold;color:red;'>DNI existente y con planilla</span>" 
        || response[2] === "<span style='font-weight:bold;color:red;'>DNI existente y con planilla</span>" 
        || response[3] === "<span style='font-weight:bold;color:red;'>DNI existente y con planilla</span>"){
            event.preventDefault();
        }
    }

</script>
</html>