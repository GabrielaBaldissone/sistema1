<?php

include('../db.php');
$connec = connect();

$id = $_POST['id'];

$name = $_POST['name'];

$update = $connec->prepare("UPDATE districts SET name='$name'
    WHERE id ='$id'");
    try {
        $update->execute();
        header('Location:barrios.php');
    } catch(Exception $e) {
        echo $e;
    }

?> 