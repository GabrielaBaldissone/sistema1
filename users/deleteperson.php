<?php

include('../db.php');
$connec = connect();

$id = $_POST['id'];

$delete = $connec->prepare("DELETE FROM persons WHERE id ='$id'");
$delete->execute();
$resultado = $delete ->fetch();

$deleterelacion = $connec -> prepare ("DELETE FROM person_user WHERE id_person = '$id'");
$deleterelacion -> execute();
$resuldeleterelacion = $deleterelacion -> fetch();


if ($delete) {
    header("Location:vot.php");
}
