<?php  session_start();

if (!isset($_SESSION['usuario'])) {
    header('Location: ../index.php');
} 


include('../db.php');
$connec = connect();

$id_file = $_POST['id'];

//ID de persona
$idperson = $connec->prepare("SELECT id_person FROM file_person WHERE id_file = '$id_file'");
$idperson->execute();
$res = $idperson->fetchAll();

//DELETE district relacionado con la persona 
$i = 0;
foreach ($res as $row) {

    $deletedistrict[$i] = $connec->prepare("DELETE FROM district_person WHERE id_person = :id_person");
    $deletedistrict[$i]->execute(array(
        ':id_person' => $row['id_person']
    ));
    $result = $deletedistrict[$i]->fetch();

    //DELETE personas 
    $deletepersons[$i] = $connec->prepare("DELETE FROM persons WHERE id = :id_person");
    $deletepersons[$i]->execute(array(
        ':id_person' => $row['id_person']
    ));

    $rowIDPerson = $row['id_person'];
    //DELETE relacion person user 
    $deletePersonUser[$i] = $connec->prepare("DELETE FROM person_user WHERE id_person = '$rowIDPerson'");
    $deletePersonUser[$i]->execute();
    $i++;
}

//DELETE personas relacionadas con la planilla
$deleteperson = $connec->prepare("DELETE FROM file_person WHERE id_file ='$id_file'");
$deleteperson->execute();
$resu = $deleteperson->fetch();


//DELETE user relacionado con la planilla 
$deleteuser = $connec->prepare("DELETE FROM file_user WHERE id_file ='$id_file'");
$deleteuser->execute();
$r = $deleteuser->fetch();

//DELETE planilla
$deletefile = $connec->prepare("DELETE FROM files WHERE id ='$id_file'");
$deletefile->execute();
$del = $deletefile->fetch();

if (isset($del)) {
    header('Location: planillas.php');
}
