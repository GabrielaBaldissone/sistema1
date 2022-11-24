<?php

include('../db.php');
$connec = connect();

$id = $_POST['id'];

$delete = $connec->prepare("DELETE FROM users WHERE id ='$id'");
$delete->execute();
$resultado = $delete ->fetch();


if ($delete) {
    header("Location:contenido.php");
}
