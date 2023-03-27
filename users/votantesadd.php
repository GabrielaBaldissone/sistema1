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
                            <option disabled selected>sin barrio</option>
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
                            <option disabled selected>sin barrio</option>
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
                            <option disabled selected>sin barrio</option>
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
                            <option disabled selected>sin barrio</option>
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
        <br />
        <div id="persona5">
            <div class="container border border-5">
                <div class="row">
                    <div class="col">
                        <input type="text" class="form-control m-1" placeholder="Nombres" id="name5" name="name5"> </input>
                    </div>
                    <div class="col order-1">
                        <input type="text" class="form-control m-1" placeholder="Apellidos" id="lastname5" name="lastname5"> </input>
                    </div>
                    <div class="col order-2">
                        <input type="number" class="form-control m-1" min="100000" max="99999999" placeholder="DNI sin puntos" id="dni5" name="dni5"> </input>
                        <div id="resultado5" class="m-1"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <input type="text" class="form-control m-1" placeholder="Direccion" id="address5" name="address5" > </input>
                    </div>
                    <div class="col order-1">
                        <select  class="form-select m-1" id="id_districts5" name="id_districts5">
                            <option disabled selected>sin barrio</option>
                            <?php
                            foreach ($resultado as $row) {
                                echo
                                '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col order-2">
                        <input type="number" class="form-control m-1" placeholder="Telefono" id="phone5" name="phone5"> </input>
                    </div>
                </div>
                
            </div>
        </div>
        <br />
        <div id="persona6">
            <div class="container border border-5">
                <div class="row">
                    <div class="col">
                        <input type="text" class="form-control m-1" placeholder="Nombres" id="name6" name="name6"> </input>
                    </div>
                    <div class="col order-1">
                        <input type="text" class="form-control m-1" placeholder="Apellidos" id="lastname6" name="lastname6"> </input>
                    </div>
                    <div class="col order-2">
                        <input type="number" class="form-control m-1" min="100000" max="99999999" placeholder="DNI sin puntos" id="dni6" name="dni6"> </input>
                        <div id="resultado6" class="m-1"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <input type="text" class="form-control m-1" placeholder="Direccion" id="address6" name="address6" > </input>
                    </div>
                    <div class="col order-1">
                        <select  class="form-select m-1" id="id_districts6" name="id_districts6">
                            <option disabled selected>sin barrio</option>
                            <?php
                            foreach ($resultado as $row) {
                                echo
                                '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col order-2">
                        <input type="number" class="form-control m-1" placeholder="Telefono" id="phone6" name="phone6"> </input>
                    </div>
                </div>
                
            </div>
        </div>
        <br />
        <div id="persona7">
            <div class="container border border-5">
                <div class="row">
                    <div class="col">
                        <input type="text" class="form-control m-1" placeholder="Nombres" id="name7" name="name7"> </input>
                    </div>
                    <div class="col order-1">
                        <input type="text" class="form-control m-1" placeholder="Apellidos" id="lastname7" name="lastname7"> </input>
                    </div>
                    <div class="col order-2">
                        <input type="number" class="form-control m-1" min="100000" max="99999999" placeholder="DNI sin puntos" id="dni7" name="dni7"> </input>
                        <div id="resultado7" class="m-1"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <input type="text" class="form-control m-1" placeholder="Direccion" id="address7" name="address7" > </input>
                    </div>
                    <div class="col order-1">
                        <select  class="form-select m-1" id="id_districts7" name="id_districts7">
                            <option disabled selected>sin barrio</option>
                            <?php
                            foreach ($resultado as $row) {
                                echo
                                '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col order-2">
                        <input type="number" class="form-control m-1" placeholder="Telefono" id="phone7" name="phone7"> </input>
                    </div>
                </div>
                
            </div>
        </div>
        <br />
        <div id="persona8">
            <div class="container border border-5">
                <div class="row">
                    <div class="col">
                        <input type="text" class="form-control m-1" placeholder="Nombres" id="name8" name="name8"> </input>
                    </div>
                    <div class="col order-1">
                        <input type="text" class="form-control m-1" placeholder="Apellidos" id="lastname8" name="lastname8"> </input>
                    </div>
                    <div class="col order-2">
                        <input type="number" class="form-control m-1" min="100000" max="99999999" placeholder="DNI sin puntos" id="dni8" name="dni8"> </input>
                        <div id="resultado8" class="m-1"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <input type="text" class="form-control m-1" placeholder="Direccion" id="address8" name="address8" > </input>
                    </div>
                    <div class="col order-1">
                        <select  class="form-select m-1" id="id_districts8" name="id_districts8">
                            <option disabled selected>sin barrio</option>
                            <?php
                            foreach ($resultado as $row) {
                                echo
                                '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col order-2">
                        <input type="number" class="form-control m-1" placeholder="Telefono" id="phone8" name="phone8"> </input>
                    </div>
                </div>
                
            </div>
        </div>
        <br />
        <div id="persona9">
            <div class="container border border-5">
                <div class="row">
                    <div class="col">
                        <input type="text" class="form-control m-1" placeholder="Nombres" id="name9" name="name9"> </input>
                    </div>
                    <div class="col order-1">
                        <input type="text" class="form-control m-1" placeholder="Apellidos" id="lastname9" name="lastname9"> </input>
                    </div>
                    <div class="col order-2">
                        <input type="number" class="form-control m-1" min="100000" max="99999999" placeholder="DNI sin puntos" id="dni9" name="dni9"> </input>
                        <div id="resultado9" class="m-1"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <input type="text" class="form-control m-1" placeholder="Direccion" id="address9" name="address9" > </input>
                    </div>
                    <div class="col order-1">
                        <select  class="form-select m-1" id="id_districts9" name="id_districts9">
                            <option disabled selected>sin barrio</option>
                            <?php
                            foreach ($resultado as $row) {
                                echo
                                '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col order-2">
                        <input type="number" class="form-control m-1" placeholder="Telefono" id="phone9" name="phone9"> </input>
                    </div>
                </div>
                
            </div>
        </div>
        <br />
        <div id="persona10">
            <div class="container border border-5">
                <div class="row">
                    <div class="col">
                        <input type="text" class="form-control m-1" placeholder="Nombres" id="name10" name="name10"> </input>
                    </div>
                    <div class="col order-1">
                        <input type="text" class="form-control m-1" placeholder="Apellidos" id="lastname10" name="lastname10"> </input>
                    </div>
                    <div class="col order-2">
                        <input type="number" class="form-control m-1" min="100000" max="99999999" placeholder="DNI sin puntos" id="dni10" name="dni10"> </input>
                        <div id="resultado10" class="m-1"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <input type="text" class="form-control m-1" placeholder="Direccion" id="address10" name="address10" > </input>
                    </div>
                    <div class="col order-1">
                        <select  class="form-select m-1" id="id_districts10" name="id_districts10">
                            <option disabled selected>sin barrio</option>
                            <?php
                            foreach ($resultado as $row) {
                                echo
                                '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col order-2">
                        <input type="number" class="form-control m-1" placeholder="Telefono" id="phone10" name="phone10"> </input>
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
    <br />
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

    let name5 = document.getElementById("name5");
    let lastname5 = document.getElementById("lastname5");
    let address5 = document.getElementById("address5");
    let id_districts5 = document.getElementById("id_districts5");
    let phone5 = document.getElementById("phone5");

    let name6 = document.getElementById("name6");
    let lastname6 = document.getElementById("lastname6");
    let address6 = document.getElementById("address6");
    let id_districts6 = document.getElementById("id_districts6");
    let phone6 = document.getElementById("phone6");

    let name7 = document.getElementById("name7");
    let lastname7 = document.getElementById("lastname7");
    let address7 = document.getElementById("address7");
    let id_districts7 = document.getElementById("id_districts7");
    let phone7 = document.getElementById("phone7");

    let name8 = document.getElementById("name8");
    let lastname8 = document.getElementById("lastname8");
    let address8 = document.getElementById("address8");
    let id_districts8 = document.getElementById("id_districts8");
    let phone8 = document.getElementById("phone8");

    let name9 = document.getElementById("name9");
    let lastname9 = document.getElementById("lastname9");
    let address9 = document.getElementById("address9");
    let id_districts9 = document.getElementById("id_districts9");
    let phone9 = document.getElementById("phone9");

    let name10 = document.getElementById("name10");
    let lastname10 = document.getElementById("lastname10");
    let address10 = document.getElementById("address10");
    let id_districts10 = document.getElementById("id_districts10");
    let phone10 = document.getElementById("phone10");

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
        $("#dni5").keyup(function(e){
            let dni = $("#dni5").val().length > 0 ? $("#dni5").val() : -1;
            $("#resultado5").queue(function(n) {                            
                $("#resultado5").html('<img src="Ajax-loader.gif" />');                  
                    $.ajax({
                        type: "POST",
                        url: "verification.php",
                        data: "dni="+dni,
                        dataType: "html",
                        error: function(response){
                            $("#resultado5").html("<span style='font-weight:bold;color:red;'>Error</span>");
                        },
                        success: function(data){ 
                            response[4] = data;
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
                                            name5.value = respuesta.name ? respuesta.name : "";
                                            lastname5.value = respuesta.lastname;
                                            address5.value = respuesta.address;
                                            id_districts5.value = respuesta.district.id;
                                            phone5.value = respuesta.phone;
                                            document.close();
                                        } else {
                                            throw new Error(response.statusText);
                                        }
                                    } catch (err) {
                                        console.log("Error al realizar la petición AJAX: " + err.message);
                                    }
                                })();
                            }
                            $("#resultado5").html(data);
                            n();
                        }
                    });                     
                });                   
        }); 
        $("#dni6").keyup(function(e){
            let dni = $("#dni6").val().length > 0 ? $("#dni6").val() : -1;
            $("#resultado6").queue(function(n) {                            
                $("#resultado6").html('<img src="Ajax-loader.gif" />');                  
                    $.ajax({
                        type: "POST",
                        url: "verification.php",
                        data: "dni="+dni,
                        dataType: "html",
                        error: function(response){
                            $("#resultado6").html("<span style='font-weight:bold;color:red;'>Error</span>");
                        },
                        success: function(data){ 
                            response[5] = data;
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
                                            name6.value = respuesta.name ? respuesta.name : "";
                                            lastname6.value = respuesta.lastname;
                                            address6.value = respuesta.address;
                                            id_districts6.value = respuesta.district.id;
                                            phone6.value = respuesta.phone;
                                            document.close();
                                        } else {
                                            throw new Error(response.statusText);
                                        }
                                    } catch (err) {
                                        console.log("Error al realizar la petición AJAX: " + err.message);
                                    }
                                })();
                            }
                            $("#resultado6").html(data);
                            n();
                        }
                    });                     
                });                   
        }); 
        $("#dni7").keyup(function(e){
            let dni = $("#dni7").val().length > 0 ? $("#dni7").val() : -1;
            $("#resultado7").queue(function(n) {                            
                $("#resultado7").html('<img src="Ajax-loader.gif" />');                  
                    $.ajax({
                        type: "POST",
                        url: "verification.php",
                        data: "dni="+dni,
                        dataType: "html",
                        error: function(response){
                            $("#resultado7").html("<span style='font-weight:bold;color:red;'>Error</span>");
                        },
                        success: function(data){ 
                            response[6] = data;
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
                                            name7.value = respuesta.name ? respuesta.name : "";
                                            lastname7.value = respuesta.lastname;
                                            address7.value = respuesta.address;
                                            id_districts7.value = respuesta.district.id;
                                            phone7.value = respuesta.phone;
                                            document.close();
                                        } else {
                                            throw new Error(response.statusText);
                                        }
                                    } catch (err) {
                                        console.log("Error al realizar la petición AJAX: " + err.message);
                                    }
                                })();
                            }
                            $("#resultado7").html(data);
                            n();
                        }
                    });                     
                });                   
        }); 
        $("#dni8").keyup(function(e){
            let dni = $("#dni8").val().length > 0 ? $("#dni8").val() : -1;
            $("#resultado8").queue(function(n) {                            
                $("#resultado8").html('<img src="Ajax-loader.gif" />');                  
                    $.ajax({
                        type: "POST",
                        url: "verification.php",
                        data: "dni="+dni,
                        dataType: "html",
                        error: function(response){
                            $("#resultado8").html("<span style='font-weight:bold;color:red;'>Error</span>");
                        },
                        success: function(data){ 
                            response[7] = data;
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
                                            name8.value = respuesta.name ? respuesta.name : "";
                                            lastname8.value = respuesta.lastname;
                                            address8.value = respuesta.address;
                                            id_districts8.value = respuesta.district.id;
                                            phone8.value = respuesta.phone;
                                            document.close();
                                        } else {
                                            throw new Error(response.statusText);
                                        }
                                    } catch (err) {
                                        console.log("Error al realizar la petición AJAX: " + err.message);
                                    }
                                })();
                            }
                            $("#resultado8").html(data);
                            n();
                        }
                    });                     
                });                   
        }); 
        $("#dni9").keyup(function(e){
            let dni = $("#dni9").val().length > 0 ? $("#dni9").val() : -1;
            $("#resultado9").queue(function(n) {                            
                $("#resultado9").html('<img src="Ajax-loader.gif" />');                  
                    $.ajax({
                        type: "POST",
                        url: "verification.php",
                        data: "dni="+dni,
                        dataType: "html",
                        error: function(response){
                            $("#resultado9").html("<span style='font-weight:bold;color:red;'>Error</span>");
                        },
                        success: function(data){ 
                            response[8] = data;
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
                                            name9.value = respuesta.name ? respuesta.name : "";
                                            lastname9.value = respuesta.lastname;
                                            address9.value = respuesta.address;
                                            id_districts9.value = respuesta.district.id;
                                            phone9.value = respuesta.phone;
                                            document.close();
                                        } else {
                                            throw new Error(response.statusText);
                                        }
                                    } catch (err) {
                                        console.log("Error al realizar la petición AJAX: " + err.message);
                                    }
                                })();
                            }
                            $("#resultado9").html(data);
                            n();
                        }
                    });                     
                });                   
        }); 
        $("#dni10").keyup(function(e){
            let dni = $("#dni10").val().length > 0 ? $("#dni10").val() : -1;
            $("#resultado10").queue(function(n) {                            
                $("#resultado10").html('<img src="Ajax-loader.gif" />');                  
                    $.ajax({
                        type: "POST",
                        url: "verification.php",
                        data: "dni="+dni,
                        dataType: "html",
                        error: function(response){
                            $("#resultado10").html("<span style='font-weight:bold;color:red;'>Error</span>");
                        },
                        success: function(data){ 
                            response[9] = data;
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
                                            name10.value = respuesta.name ? respuesta.name : "";
                                            lastname10.value = respuesta.lastname;
                                            address10.value = respuesta.address;
                                            id_districts10.value = respuesta.district.id;
                                            phone10.value = respuesta.phone;
                                            document.close();
                                        } else {
                                            throw new Error(response.statusText);
                                        }
                                    } catch (err) {
                                        console.log("Error al realizar la petición AJAX: " + err.message);
                                    }
                                })();
                            }
                            $("#resultado10").html(data);
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
        const dni5 = document.getElementById("dni5").value;
        const dni6 = document.getElementById("dni6").value;
        const dni7 = document.getElementById("dni7").value;
        const dni8 = document.getElementById("dni8").value;
        const dni9 = document.getElementById("dni9").value;
        const dni10 = document.getElementById("dni10").value;
        
        if(
        ((dni1 === dni2) && (dni1.length > 0 && dni2.length > 0)) 
        || ((dni1 === dni3) && (dni1.length > 0 && dni3.length > 0)) 
        || ((dni1 === dni4) && (dni1.length > 0 && dni4.length > 0)) 
        || ((dni1 === dni5) && (dni1.length > 0 && dni5.length > 0)) 
        || ((dni1 === dni6) && (dni1.length > 0 && dni6.length > 0)) 
        || ((dni1 === dni7) && (dni1.length > 0 && dni7.length > 0)) 
        || ((dni1 === dni8) && (dni1.length > 0 && dni8.length > 0)) 
        || ((dni1 === dni9) && (dni1.length > 0 && dni9.length > 0)) 
        || ((dni1 === dni10) && (dni1.length > 0 && dni10.length > 0)) 

        || ((dni2 === dni3) && (dni2.length > 0 && dni3.length > 0)) 
        || ((dni2 === dni4) && (dni2.length > 0 && dni4.length > 0))
        || ((dni2 === dni5) && (dni2.length > 0 && dni5.length > 0)) 
        || ((dni2 === dni6) && (dni2.length > 0 && dni6.length > 0)) 
        || ((dni2 === dni7) && (dni2.length > 0 && dni7.length > 0)) 
        || ((dni2 === dni8) && (dni2.length > 0 && dni8.length > 0)) 
        || ((dni2 === dni9) && (dni2.length > 0 && dni9.length > 0)) 
        || ((dni2 === dni10) && (dni2.length > 0 && dni10.length > 0)) 

        || ((dni3 === dni4) && (dni3.length > 0 && dni4.length > 0))
        || ((dni3 === dni5) && (dni3.length > 0 && dni5.length > 0)) 
        || ((dni3 === dni6) && (dni3.length > 0 && dni6.length > 0)) 
        || ((dni3 === dni7) && (dni3.length > 0 && dni7.length > 0)) 
        || ((dni3 === dni8) && (dni3.length > 0 && dni8.length > 0)) 
        || ((dni3 === dni9) && (dni3.length > 0 && dni9.length > 0)) 
        || ((dni3 === dni10) && (dni3.length > 0 && dni10.length > 0)) 

        || ((dni4 === dni5) && (dni4.length > 0 && dni5.length > 0)) 
        || ((dni4 === dni6) && (dni4.length > 0 && dni6.length > 0)) 
        || ((dni4 === dni7) && (dni4.length > 0 && dni7.length > 0)) 
        || ((dni4 === dni8) && (dni4.length > 0 && dni8.length > 0)) 
        || ((dni4 === dni9) && (dni4.length > 0 && dni9.length > 0)) 
        || ((dni4 === dni10) && (dni4.length > 0 && dni10.length > 0)) 

        || ((dni5 === dni6) && (dni5.length > 0 && dni6.length > 0)) 
        || ((dni5 === dni7) && (dni5.length > 0 && dni7.length > 0)) 
        || ((dni5 === dni8) && (dni5.length > 0 && dni8.length > 0)) 
        || ((dni5 === dni9) && (dni5.length > 0 && dni9.length > 0)) 
        || ((dni5 === dni10) && (dni5.length > 0 && dni10.length > 0)) 

        || ((dni6 === dni7) && (dni6.length > 0 && dni7.length > 0)) 
        || ((dni6 === dni8) && (dni6.length > 0 && dni8.length > 0)) 
        || ((dni6 === dni9) && (dni6.length > 0 && dni9.length > 0)) 
        || ((dni6 === dni10) && (dni6.length > 0 && dni10.length > 0)) 

        || ((dni7 === dni8) && (dni7.length > 0 && dni8.length > 0)) 
        || ((dni7 === dni9) && (dni7.length > 0 && dni9.length > 0)) 
        || ((dni7 === dni10) && (dni7.length > 0 && dni10.length > 0)) 

        || ((dni8 === dni9) && (dni8.length > 0 && dni9.length > 0)) 
        || ((dni8 === dni10) && (dni8.length > 0 && dni10.length > 0)) 

        || ((dni9 === dni10) && (dni9.length > 0 && dni10.length > 0)) 
        ){
            formMsg.innerHTML = "<div class='container alert alert-danger mt-4' role='alert'>Hay DNIs repetidos en el formulario.</div>";
            event.preventDefault();
        }

        if(response[0] === "<span style='font-weight:bold;color:red;'>DNI cargado en otra planilla</span>" 
        || response[1] === "<span style='font-weight:bold;color:red;'>DNI cargado en otra planilla</span>" 
        || response[2] === "<span style='font-weight:bold;color:red;'>DNI cargado en otra planilla</span>" 
        || response[3] === "<span style='font-weight:bold;color:red;'>DNI cargado en otra planilla</span>"
        || response[4] === "<span style='font-weight:bold;color:red;'>DNI cargado en otra planilla</span>"
        || response[5] === "<span style='font-weight:bold;color:red;'>DNI cargado en otra planilla</span>"
        || response[6] === "<span style='font-weight:bold;color:red;'>DNI cargado en otra planilla</span>"
        || response[7] === "<span style='font-weight:bold;color:red;'>DNI cargado en otra planilla</span>"
        || response[8] === "<span style='font-weight:bold;color:red;'>DNI cargado en otra planilla</span>"
        || response[9] === "<span style='font-weight:bold;color:red;'>DNI cargado en otra planilla</span>"){
            event.preventDefault();
        }

        if(response[0] === "<span style='font-weight:bold;color:red;'>DNI cargado por otro usuario</span>" 
        || response[1] === "<span style='font-weight:bold;color:red;'>DNI cargado por otro usuario</span>" 
        || response[2] === "<span style='font-weight:bold;color:red;'>DNI cargado por otro usuario</span>" 
        || response[3] === "<span style='font-weight:bold;color:red;'>DNI cargado por otro usuario</span>"
        || response[4] === "<span style='font-weight:bold;color:red;'>DNI cargado por otro usuario</span>"
        || response[5] === "<span style='font-weight:bold;color:red;'>DNI cargado por otro usuario</span>"
        || response[6] === "<span style='font-weight:bold;color:red;'>DNI cargado por otro usuario</span>"
        || response[7] === "<span style='font-weight:bold;color:red;'>DNI cargado por otro usuario</span>"
        || response[8] === "<span style='font-weight:bold;color:red;'>DNI cargado por otro usuario</span>"
        || response[9] === "<span style='font-weight:bold;color:red;'>DNI cargado por otro usuario</span>"){
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
            dni5: dni5.value,
            name5: name5.value,
            lastname5: lastname5.value,
            address5: address5.value,
            id_districts5: id_districts5.value,
            phone5: phone5.value,
            dni6: dni6.value,
            name6: name6.value,
            lastname6: lastname6.value,
            address6: address6.value,
            id_districts6: id_districts6.value,
            phone6: phone6.value,
            dni7: dni7.value,
            name7: name7.value,
            lastname7: lastname7.value,
            address7: address7.value,
            id_districts7: id_districts7.value,
            phone7: phone7.value,
            dni8: dni8.value,
            name8: name8.value,
            lastname8: lastname8.value,
            address8: address8.value,
            id_districts8: id_districts8.value,
            phone8: phone8.value,
            dni9: dni9.value,
            name9: name9.value,
            lastname9: lastname9.value,
            address9: address9.value,
            id_districts9: id_districts9.value,
            phone9: phone9.value,
            dni10: dni10.value,
            name10: name10.value,
            lastname10: lastname10.value,
            address10: address10.value,
            id_districts10: id_districts10.value,
            phone10: phone10.value,
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