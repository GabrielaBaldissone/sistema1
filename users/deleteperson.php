<?php

include('../db.php');
$connec = connect();

$id = $_POST['id'];

// BUSCAMOS SI LA PERSONA TIENE PLANILLA
$planilla = $connec->prepare("SELECT * FROM file_person WHERE id_person = '$id'");
$planilla->execute();
$resultadoPlanilla = $planilla->fetch();

if($resultadoPlanilla > 0){
    $refresh = $connec->prepare("UPDATE persons SET name = '', lastname = '', address = '', phone = 0, dni = 0 WHERE id = '$id'");
    $refresh->execute();
    $resultadoRefresh = $refresh ->fetch();
    
    $refresh2 = $connec -> prepare ("UPDATE district_person SET id_district = 0 WHERE id_person = '$id'");
    $refresh2 -> execute();
    $resultadoRefresh2 = $refresh2 -> fetch();
}else{
    $delete = $connec->prepare("DELETE FROM persons WHERE id ='$id'");
    $delete->execute();
    $resultado = $delete ->fetch();
    
    $deleterelacion = $connec -> prepare ("DELETE FROM person_user WHERE id_person = '$id'");
    $deleterelacion -> execute();
    $resuldeleterelacion = $deleterelacion -> fetch();
    
    $deleterelacion2 = $connec -> prepare ("DELETE FROM district_person WHERE id_person = '$id'");
    $deleterelacion2 -> execute();
    $resuldeleterelacion2 = $deleterelacion2 -> fetch();
}


header("Location:vot.php");

