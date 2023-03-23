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

    <form id="formulario">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div id="form-msg"></div>
                </div>
            </div>
        </div>
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
                        <input type="number" class="form-control m-1" min="100000" max="99999999" placeholder="DNI sin puntos" id="dni1" name="dni1" required> </input>
                        <div id="resultado1" class="m-1"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <input type="text" class="form-control m-1" placeholder="Direccion" id="address1" name="address1" > </input>
                    </div>
                    <div class="col order-1">
                        <select  class="form-select m-1" id="id_districts1" name="id_districts1">
                            <option></option>
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
                        <input type="text" class="form-control m-1" placeholder="Nombres" id="name2" name="name2"> </input>
                    </div>
                    <div class="col order-1">
                        <input type="text" class="form-control m-1" placeholder="Apellidos" id="lastname2" name="lastname2"> </input>
                    </div>
                    <div class="col order-2">
                        <input type="number" class="form-control m-1" min="100000" max="99999999" placeholder="DNI sin puntos" id="dni2" name="dni2"> </input>
                        <div id="resultado2" class="m-1"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <input type="text" class="form-control m-1" placeholder="Direccion" id="address2" name="address2" > </input>
                    </div>
                    <div class="col order-1">
                        <select  class="form-select m-1" id="id_districts2" name="id_districts2">
                            <option></option>
                            <?php
                            foreach ($resultado as $row) {
                                echo
                                '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col order-2">
                        <input type="number" class="form-control m-1" placeholder="Telefono" id="phone2" name="phone2"> </input>
                    </div>
                </div>
                
            </div>
        </div>
        <br />
        <div id="persona3">
            <div class="container border border-5">
                <div class="row">
                    <div class="col">
                        <input type="text" class="form-control m-1" placeholder="Nombres" id="name3" name="name3"> </input>
                    </div>
                    <div class="col order-1">
                        <input type="text" class="form-control m-1" placeholder="Apellidos" id="lastname3" name="lastname3"> </input>
                    </div>
                    <div class="col order-2">
                        <input type="number" class="form-control m-1" min="100000" max="99999999" placeholder="DNI sin puntos" id="dni3" name="dni3"> </input>
                        <div id="resultado3" class="m-1"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <input type="text" class="form-control m-1" placeholder="Direccion" id="address3" name="address3" > </input>
                    </div>
                    <div class="col order-1">
                        <select  class="form-select m-1" id="id_districts3" name="id_districts3">
                            <option></option>
                            <?php
                            foreach ($resultado as $row) {
                                echo
                                '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col order-2">
                        <input type="number" class="form-control m-1" placeholder="Telefono" id="phone3" name="phone3"> </input>
                    </div>
                </div>
                
            </div>
        </div>
        <br />
        <div id="persona4">
            <div class="container border border-5">
                <div class="row">
                    <div class="col">
                        <input type="text" class="form-control m-1" placeholder="Nombres" id="name4" name="name4"> </input>
                    </div>
                    <div class="col order-1">
                        <input type="text" class="form-control m-1" placeholder="Apellidos" id="lastname4" name="lastname4"> </input>
                    </div>
                    <div class="col order-2">
                        <input type="number" class="form-control m-1" min="100000" max="99999999" placeholder="DNI sin puntos" id="dni4" name="dni4"> </input>
                        <div id="resultado4" class="m-1"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <input type="text" class="form-control m-1" placeholder="Direccion" id="address4" name="address4" > </input>
                    </div>
                    <div class="col order-1">
                        <select  class="form-select m-1" id="id_districts4" name="id_districts4">
                            <option></option>
                            <?php
                            foreach ($resultado as $row) {
                                echo
                                '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col order-2">
                        <input type="number" class="form-control m-1" placeholder="Telefono" id="phone4" name="phone4"> </input>
                    </div>
                </div>
                
            </div>
        </div>

        <button style="position:relative; margin:10px auto; text-align: center; display: flex;" onclick="add()" type="submit" class="btn btn-success">Agregar Planilla</button>
    </form>
    <div style="position:center; margin: 0 auto; text-align: center;">
        <a href="planillas.php" type="submit" class="btn btn-success">
            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="20" fill="currentColor" class="bi bi-arrow-left-square" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M15 2a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2zM0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm11.5 5.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z" />
            </svg>
            Volver
        </a>
    </div>
</body>

<script>
    let response = [];
    let name1 = document.getElementById("name1");
    let lastname1 = document.getElementById("lastname1");
    let address1 = document.getElementById("address1");
    let id_districts1 = document.getElementById("id_districts1");
    let phone1 = document.getElementById("phone1");
    let name2 = document.getElementById("name2");
    let lastname2 = document.getElementById("lastname2");
    let address2 = document.getElementById("address2");
    let id_districts2 = document.getElementById("id_districts2");
    let phone2 = document.getElementById("phone2");
    let name3 = document.getElementById("name3");
    let lastname3 = document.getElementById("lastname3");
    let address3 = document.getElementById("address3");
    let id_districts3 = document.getElementById("id_districts3");
    let phone3 = document.getElementById("phone3");
    let name4 = document.getElementById("name4");
    let lastname4 = document.getElementById("lastname4");
    let address4 = document.getElementById("address4");
    let id_districts4 = document.getElementById("id_districts4");
    let phone4 = document.getElementById("phone4");

    $(document).ready(function(){
                         
        $("#dni1").keyup(function(e){
            let dni = $("#dni1").val().length > 0 ? $("#dni1").val() : -1;
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
                            if(data === "<span style='font-weight:bold;color:orange;'>DNI cargado pero sin planilla</span>"){
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
                                            name1.value = respuesta.name ? respuesta.name : "";
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
            let dni = $("#dni2").val().length > 0 ? $("#dni2").val() : -1;
            $("#resultado2").queue(function(n) {                            
                $("#resultado2").html('<img src="Ajax-loader.gif" />');                  
                    $.ajax({
                        type: "POST",
                        url: "verification.php",
                        data: "dni="+dni,
                        dataType: "html",
                        error: function(response){
                            $("#resultado2").html("<span style='font-weight:bold;color:red;'>Error</span>");
                        },
                        success: function(data){ 
                            response[1] = data;
                            if(data === "<span style='font-weight:bold;color:orange;'>DNI cargado pero sin planilla</span>"){
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
                                            name2.value = respuesta.name ? respuesta.name : "";
                                            lastname2.value = respuesta.lastname;
                                            address2.value = respuesta.address;
                                            id_districts2.value = respuesta.district.id;
                                            phone2.value = respuesta.phone;
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
                            $("#resultado2").html(data);
                            n();
                        }
                    });                     
                });                   
            });    

        $("#dni3").keyup(function(e){
            let dni = $("#dni3").val().length > 0 ? $("#dni3").val() : -1;
            $("#resultado3").queue(function(n) {                            
                $("#resultado3").html('<img src="Ajax-loader.gif" />');                  
                    $.ajax({
                        type: "POST",
                        url: "verification.php",
                        data: "dni="+dni,
                        dataType: "html",
                        error: function(response){
                            $("#resultado3").html("<span style='font-weight:bold;color:red;'>Error</span>");
                        },
                        success: function(data){ 
                            response[2] = data;
                            if(data === "<span style='font-weight:bold;color:orange;'>DNI cargado pero sin planilla</span>"){
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
                                            name3.value = respuesta.name ? respuesta.name : "";
                                            lastname3.value = respuesta.lastname;
                                            address3.value = respuesta.address;
                                            id_districts3.value = respuesta.district.id;
                                            phone3.value = respuesta.phone;
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
                            $("#resultado3").html(data);
                            n();
                        }
                    });                     
                });                   
            });  
            
        $("#dni4").keyup(function(e){
            let dni = $("#dni4").val().length > 0 ? $("#dni4").val() : -1;
            $("#resultado4").queue(function(n) {                            
                $("#resultado4").html('<img src="Ajax-loader.gif" />');                  
                    $.ajax({
                        type: "POST",
                        url: "verification.php",
                        data: "dni="+dni,
                        dataType: "html",
                        error: function(response){
                            $("#resultado4").html("<span style='font-weight:bold;color:red;'>Error</span>");
                        },
                        success: function(data){ 
                            response[3] = data;
                            if(data === "<span style='font-weight:bold;color:orange;'>DNI cargado pero sin planilla</span>"){
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
                                            name4.value = respuesta.name ? respuesta.name : "";
                                            lastname4.value = respuesta.lastname;
                                            address4.value = respuesta.address;
                                            id_districts4.value = respuesta.district.id;
                                            phone4.value = respuesta.phone;
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
                            $("#resultado4").html(data);
                            n();
                        }
                    });                     
                });                   
        });  
    });

    const formMsg = document.getElementById("form-msg");

    const add = () => {
        const dni1 = document.getElementById("dni1").value;
        const dni2 = document.getElementById("dni2").value;
        const dni3 = document.getElementById("dni3").value;
        const dni4 = document.getElementById("dni4").value;
        
        if(
        ((dni1 === dni2) && (dni1.length > 0 && dni2.length > 0)) 
        || ((dni1 === dni3) && (dni1.length > 0 && dni3.length > 0)) 
        || ((dni1 === dni4) && (dni1.length > 0 && dni4.length > 0)) 
        || ((dni2 === dni3) && (dni2.length > 0 && dni3.length > 0)) 
        || ((dni2 === dni4) && (dni2.length > 0 && dni4.length > 0))
        || ((dni3 === dni4) && (dni3.length > 0 && dni4.length > 0))
        ){
            formMsg.innerHTML = "<div class='container alert alert-danger mt-4' role='alert'>Hay DNIs repetidos en el formulario.</div>";
            event.preventDefault();
        }

        if(response[0] === "<span style='font-weight:bold;color:red;'>DNI cargado en otra planilla</span>" 
        || response[1] === "<span style='font-weight:bold;color:red;'>DNI cargado en otra planilla</span>" 
        || response[2] === "<span style='font-weight:bold;color:red;'>DNI cargado en otra planilla</span>" 
        || response[3] === "<span style='font-weight:bold;color:red;'>DNI cargado en otra planilla</span>"){
            event.preventDefault();
        }

        if(response[0] === "<span style='font-weight:bold;color:red;'>DNI cargado por otro usuario</span>" 
        || response[1] === "<span style='font-weight:bold;color:red;'>DNI cargado por otro usuario</span>" 
        || response[2] === "<span style='font-weight:bold;color:red;'>DNI cargado por otro usuario</span>" 
        || response[3] === "<span style='font-weight:bold;color:red;'>DNI cargado por otro usuario</span>"){
            event.preventDefault();
        }

    }

    formulario.onsubmit = async (event) => {
        event.preventDefault();
        const form = {
            dni1: dni1.value,
            name1: name1.value,
            lastname1: lastname1.value,
            address1: address1.value,
            id_districts1: id_districts1.value,
            phone1: phone1.value,
            dni2: dni2.value,
            name2: name2.value,
            lastname2: lastname2.value,
            address2: address2.value,
            id_districts2: id_districts2.value,
            phone2: phone2.value,
            dni3: dni3.value,
            name3: name3.value,
            lastname3: lastname3.value,
            address3: address3.value,
            id_districts3: id_districts3.value,
            phone3: phone3.value,
            dni4: dni4.value,
            name4: name4.value,
            lastname4: lastname4.value,
            address4: address4.value,
            id_districts4: id_districts4.value,
            phone4: phone4.value,
        }
        formMsg.innerHTML = "<div class='container alert alert-warning mt-4' role='alert'>Cargando, por favor espera...</div>";
        var init = {
            method: "POST",
            body: JSON.stringify(form),
            headers: {
                'Content-Type': 'application/json'
            },
        };
        try {
            let response = await fetch("add.php", init);
            if (response.ok) {
            let respuesta = await response.json();
            formMsg.innerHTML = "<div class='container alert alert-success mt-4' role='alert'>Planilla cargada con exito.</div>";     
            console.log(respuesta);           
            formulario.reset();
            } else {
            throw new Error(response.statusText);
            }
        } catch (err) {
            formMsg.innerHTML = "<div class='container alert alert-danger mt-4' role='alert'>Error al enviar la planilla:"  + err.message + "</div>";
        }

        window.location.replace("planillas.php");
    }

</script>
</html>