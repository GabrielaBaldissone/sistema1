<?php session_start();

if (!isset($_SESSION['usuario'])) {
    header('Location: ../index.php');
}

require('../db.php');
$connec = connect();

if (isset($_POST)) {

    $id = $_POST['id'];

    $name = ucfirst($_POST['name']);
    $lastname = ucfirst($_POST['lastname']);
    $dni = $_POST['dni'];
    $address = $_POST['address'];
    $districts = ($_POST['districts']);
    $phone = $_POST['phone'];

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
        }
    }
    if ($updatevotante == true) {
        $exito .= "<li> Cambios guardados correctamente</li>";
    }
}

require 'upperson.php';
