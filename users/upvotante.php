<?php session_start();

if (!isset($_SESSION['usuario'])) {
    header('Location: ../index.php');
}

require('../db.php');
$connec = connect();

$email = ($_SESSION['usuario']);

//BUSCAMOS EL ID DEL USUARIO QUE INICIO SESIÓN
$nombre = $connec->prepare("SELECT id FROM users WHERE email = '$email'");
$nombre->execute();
$id_user = $nombre->fetch();

if (isset($_POST)) {

    $id = $_POST['id'];

    $name = ucfirst($_POST['name']);
    $lastname = ucfirst($_POST['lastname']);
    $dni = $_POST['dni'];
    $address = $_POST['address'];
    $districts = ($_POST['districts']);
    $phone = $_POST['phone'];
    $file = $_POST['file'];

    $comparar = $connec->prepare("SELECT dni FROM persons WHERE id = '$id'");
    $comparar->execute();
    $dnicomparar = $comparar->fetch();
    $error = "";
    $exito = "";

    if ($dni === $dnicomparar[0]) {
        $upbarrio = $connec->prepare("UPDATE district_person SET id_district = '$districts' 
    WHERE id_person = '$id'");
        $upbarrio->execute();
        $updatevotante = $connec->prepare("UPDATE persons SET name='$name', lastname='$lastname', address='$address', phone='$phone'
    WHERE id ='$id'");
        $updatevotante->execute();
        if($file == 0){
            $searchPlanilla = $connec->prepare("SELECT id FROM file_person WHERE id_person = '$id'");
            $searchPlanilla->execute();
            $resultSearchPlanilla = $searchPlanilla->fetch();
            if($resultSearchPlanilla != 0){
                // CREAR VOTANTE
                $votante = $connec->prepare('INSERT INTO persons (name, lastname, dni, address, phone)
                VALUES (:name, :lastname, :dni, :address, :phone)');
                $votante->execute(array(
                    ':name' => '',
                    ':lastname' => '',
                    ':dni' => 0,
                    ':address' => '',
                    ':phone' => 0,
                ));

                // BUSCAMOS EL ID DEL VOTANTE
                $id_person = $connec->prepare('SELECT MAX(id) AS id FROM persons');
                $id_person->execute();
                $resultid = $id_person->fetch();

                // RELACION VOTANTE - BARRIO
                $barrio = $connec->prepare('INSERT INTO district_person (id_district, id_person) VALUES(:id_district, :id_person)');
                $barrio->execute(array(
                    ':id_district' => 0,
                    ':id_person' => $resultid['id']
                ));

                // RELACION VOTANTE - USUARIO
                $person_user = $connec->prepare('INSERT INTO person_user (id_user, id_person) VALUES(:id_user, :id_person)');
                $person_user->execute(array(
                    ':id_user' => $id_user['id'],
                    ':id_person' => $resultid['id']
                ));

                // RELACION VOTANTE - PLANILLA
                $idPlanilla = $resultSearchPlanilla['id'];
                $idVotante = $resultid['id'];
                $upPlanilla = $connec->prepare("UPDATE file_person SET id_person = $idVotante WHERE id = '$idPlanilla'");
                $upPlanilla->execute();
            }
        } else {
            // falta
        }        
    } else {
        $buscar = $connec->prepare("SELECT dni FROM persons WHERE dni = '$dni'");
        $buscar->execute();
        $resultado = $buscar->fetch();
        if (count($resultado[0]) > 0) {
            $error .= '<li> El DNI ya existe.</li>';

        } else {
            $upbarrio = $connec->prepare("UPDATE district_person SET id_district = '$districts' 
        WHERE id_person = '$id'");
            $upbarrio->execute();
            $updatevotante = $connec->prepare("UPDATE persons SET name='$name', dni='$dni', lastname='$lastname', address='$address', phone='$phone'
        WHERE id ='$id'");
            $updatevotante->execute();
            if($file == 0){
                $searchPlanilla = $connec->prepare("SELECT id FROM file_person WHERE id_person = '$id'");
                $searchPlanilla->execute();
                $resultSearchPlanilla = $searchPlanilla->fetch();
                if($resultSearchPlanilla != 0){
                    // CREAR VOTANTE
                    $votante = $connec->prepare('INSERT INTO persons (name, lastname, dni, address, phone)
                    VALUES (:name, :lastname, :dni, :address, :phone)');
                    $votante->execute(array(
                        ':name' => '',
                        ':lastname' => '',
                        ':dni' => 0,
                        ':address' => '',
                        ':phone' => 0,
                    ));

                    // BUSCAMOS EL ID DEL VOTANTE
                    $id_person = $connec->prepare('SELECT MAX(id) AS id FROM persons');
                    $id_person->execute();
                    $resultid = $id_person->fetch();

                    // RELACION VOTANTE - BARRIO
                    $barrio = $connec->prepare('INSERT INTO district_person (id_district, id_person) VALUES(:id_district, :id_person)');
                    $barrio->execute(array(
                        ':id_district' => '0',
                        ':id_person' => $resultid['id']
                    ));

                    // RELACION VOTANTE - USUARIO
                    $person_user = $connec->prepare('INSERT INTO person_user (id_user, id_person) VALUES(:id_user, :id_person)');
                    $person_user->execute(array(
                        ':id_user' => $id_user['id'],
                        ':id_person' => $resultid['id']
                    ));

                    // RELACION VOTANTE - PLANILLA
                    $idPlanilla = $resultSearchPlanilla['id'];
                    $idVotante = $resultid['id'];
                    $upPlanilla = $connec->prepare("UPDATE file_person SET id_person = $idVotante WHERE id = '$idPlanilla'");
                    $upPlanilla->execute();
                }
            } else {
                // falta
            }
        }
    }
    if ($updatevotante == true) {
        $exito .= "<li> Cambios guardados correctamente</li>";
    }
}

require 'upperson.php';
