<?php 

session_start();

if (!isset($_SESSION['usuario'])) {
    header('Location: ../index.php');
}

$email = ($_SESSION['usuario']);

include('../db.php');
$connec = connect();
$dni = $_POST['dni'];
 
    // BUSCAMOS SI LA PERSONA EXISTE EN LA DB
    $person = $connec->prepare("SELECT * FROM persons WHERE dni = :dni");
    $person->execute(array(
      ':dni' => $dni
    ));
    $id_person = $person->fetch();
       
    // BUSCAMOS EL ID DEL USUARIO QUE INICIO SESIÓN
    $usuario = $connec->prepare("SELECT * FROM users WHERE email = :email");
    $usuario->execute(array(
      ':email' => $email
    ));
    $id_user = $usuario->fetch();

    // BUSCAMOS SI LA PERSONA ES DEL USUARIO QUE LO INTENTA AGREGAR
    $coincidencia = $connec->prepare("SELECT * FROM person_user WHERE (id_person = :id_person AND id_user = :id_user)");
    $coincidencia->execute(array(
      ':id_person' => $id_person['id'],
      ':id_user' => $id_user['id'],
      ));
    $resultadoCoincidencia = $coincidencia->fetch();

    $file_person = $connec->prepare('SELECT * FROM file_person WHERE id_person = :id_person');
    $file_person->execute(array(':id_person' => $id_person['id']));
    $resultfile_person = $file_person->fetch();

      if($id_person == 0){
            echo "<span style='font-weight:bold;color:green;'>Disponible</span>";
      }elseif($resultadoCoincidencia == 0 && $id_person > 0){
            echo "<span style='font-weight:bold;color:red;'>DNI cargado por otro usuario</span>";
      }elseif($resultfile_person == 0 && $id_person > 0 && $resultadoCoincidencia > 0){
            echo "<span style='font-weight:bold;color:orange;'>DNI cargado pero sin planilla</span>";
      }elseif($resultfile_person > 0){
            echo "<span style='font-weight:bold;color:red;'>DNI cargado en otra planilla</span>";
      }