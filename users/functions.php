<?php

function upVotante($connec, $districts, $id, $name, $lastname, $address, $phone, $dni){
    $upBarrio = $connec->prepare("UPDATE district_person SET id_district = '$districts' WHERE id_person = '$id'");
    $upBarrio->execute();
    $upVotante = $connec->prepare("UPDATE persons SET name='$name', lastname='$lastname', address='$address', phone='$phone', dni='$dni' WHERE id ='$id'");
    $upVotante->execute();
}

function searchPlanilla($connec, $id){
    $searchPlanilla = $connec->prepare("SELECT * FROM file_person WHERE id_person = '$id'");
    $searchPlanilla->execute();
    return $searchPlanilla->fetch();
}

function crearVotante($connec, $id_user, $id){
    // CREAMOS EL VOTANTE
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
        ':id_user' => $id_user,
        ':id_person' => $resultid['id']
    ));

    // RELACION VOTANTE - PLANILLA
    $idPlanilla = searchPlanilla($connec, $id)['id_file'];
    $idVotante = $resultid['id'];
    $upPlanilla = $connec->prepare("UPDATE file_person SET id_person = '$idVotante' WHERE id_file = '$idPlanilla' AND id_person = '$id'");
    $upPlanilla->execute();
}

function cantidadVotante($connec, $file){
    $searchPlanilla = $connec->prepare("SELECT * 
        FROM persons P
        INNER JOIN file_person FP
        ON P.id = FP.id_person
        WHERE FP.id_file = '$file' AND P.dni != 0");
    $searchPlanilla->execute();
    return $searchPlanilla->fetchAll();
}