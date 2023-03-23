<?php 
header("Content-type: application/json; charset=utf-8");
$input = json_decode(file_get_contents("php://input"), true);

session_start();

if (!isset($_SESSION['usuario'])) {
    header('Location: ../index.php');
}

include('../db.php');
$connec = connect();
 
$person = $connec->prepare('SELECT * FROM persons WHERE dni = :dni');
$person->execute(array(':dni' => $input['dni']));
$result_person = $person->fetch();

$id_district = $connec->prepare('SELECT * FROM district_person WHERE id_person = :id');
$id_district->execute(array(':id' => $result_person['id']));
$result_id_district = $id_district->fetch();

$district = $connec->prepare('SELECT * FROM districts WHERE id = :id');
$district->execute(array(':id' => $result_id_district['id_district']));
$result_district = $district->fetch();

$result_person['district'] = $result_district;
echo json_encode($result_person);