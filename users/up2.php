<?php

include('../db.php');
$connec = connect();

$id = $_POST['id'];

$name = $_POST['name'];
$lastname = $_POST['lastname'];
$dni = $_POST['dni'];
$mail = $_POST['mail'];
$role = $_POST['role'];



$update = $connec->prepare("UPDATE users SET name='$name', lastname='$lastname', dni='$dni', email='$mail', role = '$role'
    WHERE id ='$id'");
    try {
        $update->execute();
        header('Location:contenido.php');
    } catch(Exception $e) {
        echo $e;
    }

?> 