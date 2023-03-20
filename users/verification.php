<?php 

session_start();

if (!isset($_SESSION['usuario'])) {
    header('Location: ../index.php');
}

include('../db.php');
$connec = connect();
$dni = $_POST['dni'];
 
    $id_person = $connec->prepare('SELECT id FROM persons WHERE dni = :dni');
    $id_person->execute(array(':dni' => $dni));
    $resultid = $id_person->fetch();
       
    $file_person = $connec->prepare('SELECT * FROM file_person WHERE id_person = :id_person');
    $file_person->execute(array(':id_person' => $resultid[0]));
    $resultfile_person = $file_person->fetch();

      if($resultfile_person > 0){
            echo "<span style='font-weight:bold;color:red;'>DNI existente y con planilla</span>";
      }elseif($resultfile_person == 0 && $resultid > 0){
            echo "<span style='font-weight:bold;color:orange;'>DNI existente pero sin planilla</span>";
      }else{
            echo "<span style='font-weight:bold;color:green;'>Disponible</span>";
      }
