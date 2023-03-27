<?php session_start();

if (!isset($_SESSION['usuario'])) {
    header('Location: ../index.php');
}

require('functions.php');
require('../db.php');
$connec = connect();

//BUSCAMOS EL ID DEL USUARIO QUE INICIO SESIÓN
$email = ($_SESSION['usuario']);
$nombre = $connec->prepare("SELECT id FROM users WHERE email = '$email'");
$nombre->execute();
$id_user = $nombre->fetch();

if (isset($_POST)) {

    // RECIBIMOS LOS DATOS POR POST
    $id = $_POST['id'];
    $name = ucfirst($_POST['name']);
    $lastname = ucfirst($_POST['lastname']);
    $dni = $_POST['dni'];
    $address = $_POST['address'];
    $districts = ($_POST['districts']);
    $phone = $_POST['phone'];
    $file = $_POST['file'];

    // BUSCAMOS LA PERSONA POR EL DNI EN LA TABLA PERSONS
    $compararDNI = $connec->prepare("SELECT dni FROM persons WHERE id = '$id'");
    $compararDNI->execute();
    $resultCompararDNI = $compararDNI->fetch();
    $error = "";
    $exito = "";

    // SI EL DIN ES IGUAL
    if ($dni === $resultCompararDNI[0]) {

        // HACE CAMBIOS EN PERSON Y DISTRICT_PERSON
        upVotante($connec, $districts, $id, $name, $lastname, $address, $phone, $dni);
        $exito .= "<li> Cambios guardados correctamente</li>";
        // SI PLANILLA ES = 0
        if($file == 0){

            // SI TIENE PLANILLA
            if(searchPlanilla($connec, $id) != 0){
                // CREAR VOTANTE
                crearVotante($connec, $id_user['id'], $id);
                $exito .= "<li> Votante eliminado de la planilla </li>";
            }

        } else {
            // SI TIENE PLANILLA
            if(searchPlanilla($connec, $id)['id_file'] == $file){
                $error .= "<li> ES LA MISMA PLANILLA </li>";
            }else{
            // SI NO TIENE PLANILLA
                if(count(cantidadVotante($connec, $file)) == 2){
                    $error .= "<li> No puede agregar a este votante, planilla llena.</li>";
                }else{
                    $searchPlanilla = $connec->prepare("SELECT id_person 
                        FROM file_person FP
                        INNER JOIN persons P
                        ON P.id = FP.id_person
                        WHERE FP.id_file = '$file' AND P.dni = 0");
                    $searchPlanilla->execute();
                    $resultSearchPlanilla = $searchPlanilla->fetch();
                    $resultSearchPlanilla1 = $resultSearchPlanilla['id_person'];
                    $upPlanilla = $connec->prepare("UPDATE file_person SET id_person = '$id' WHERE id_person = '$resultSearchPlanilla1' LIMIT 1");
                    $upPlanilla->execute();

                    $delete = $connec->prepare("DELETE FROM persons WHERE id ='$resultSearchPlanilla1'");
                    $delete->execute();
                    $resultado = $delete ->fetch();
                    
                    $deleterelacion = $connec -> prepare ("DELETE FROM person_user WHERE id_person = '$resultSearchPlanilla1'");
                    $deleterelacion -> execute();
                    $resuldeleterelacion = $deleterelacion -> fetch();
                    
                    $deleterelacion2 = $connec -> prepare ("DELETE FROM district_person WHERE id_person = '$resultSearchPlanilla1'");
                    $deleterelacion2 -> execute();
                    $resuldeleterelacion2 = $deleterelacion2 -> fetch();

                    $exito .= "<li> Votante agregado a la planilla </li>";
                }
            }

        }        
    // SI EL DNI ES DISTINTO
    } else {
        $buscar = $connec->prepare("SELECT dni FROM persons WHERE dni = '$dni'");
        $buscar->execute();
        $resultado = $buscar->fetch();
        if (count($resultado[0]) > 0) {
            $error .= '<li> El DNI ya existe.</li>';

        } else {
                    // HACE CAMBIOS EN PERSON Y DISTRICT_PERSON
        upVotante($connec, $districts, $id, $name, $lastname, $address, $phone, $dni);
        $exito .= "<li> Cambios guardados correctamente</li>";
        // SI PLANILLA ES = 0
        if($file == 0){

            // SI TIENE PLANILLA
            if(searchPlanilla($connec, $id) != 0){
                // CREAR VOTANTE
                crearVotante($connec, $id_user['id'], $id);
                $exito .= "<li> Votante eliminado de la planilla </li>";
            }

        } else {
                // SI TIENE PLANILLA
                if(searchPlanilla($connec, $id)['id_file'] == $file){
                    $error .= "<li> ES LA MISMA PLANILLA </li>";
                }else{
                // SI NO TIENE PLANILLA
                    if(count(cantidadVotante($connec, $file)) == 2){
                        $error .= "<li> No puede agregar a este votante, planilla llena.</li>";
                    }else{
                        $searchPlanilla = $connec->prepare("SELECT id_person 
                            FROM file_person FP
                            INNER JOIN persons P
                            ON P.id = FP.id_person
                            WHERE FP.id_file = '$file' AND P.dni = 0");
                        $searchPlanilla->execute();
                        $resultSearchPlanilla = $searchPlanilla->fetch();
                        $resultSearchPlanilla1 = $resultSearchPlanilla['id_person'];
                        $upPlanilla = $connec->prepare("UPDATE file_person SET id_person = '$id' WHERE id_person = '$resultSearchPlanilla1' LIMIT 1");
                        $upPlanilla->execute();

                        $delete = $connec->prepare("DELETE FROM persons WHERE id ='$resultSearchPlanilla1'");
                        $delete->execute();
                        $resultado = $delete ->fetch();
                        
                        $deleterelacion = $connec -> prepare ("DELETE FROM person_user WHERE id_person = '$resultSearchPlanilla1'");
                        $deleterelacion -> execute();
                        $resuldeleterelacion = $deleterelacion -> fetch();
                        
                        $deleterelacion2 = $connec -> prepare ("DELETE FROM district_person WHERE id_person = '$resultSearchPlanilla1'");
                        $deleterelacion2 -> execute();
                        $resuldeleterelacion2 = $deleterelacion2 -> fetch();

                        $exito .= "<li> Votante agregado a la planilla </li>";
                    }
                }

            }      
        }
    }
}

require 'upperson.php';
