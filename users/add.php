<?php session_start();

if (!isset($_SESSION['usuario'])) {
    header('Location: ../index.php');
}

include('../db.php');
$connec = connect();

$email = ($_SESSION['usuario']);

//BUSCAMOS EL ID DEL USUARIO QUE INICIO SESIÓN
$nombre = $connec->prepare("SELECT id FROM users WHERE email = '$email'");
$nombre->execute();
$id_user = $nombre->fetch();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    //RECIBIMOS LOS DATOS DE CADA VOTANTE 
    $name1 = ucfirst($_POST['name1']);
    $lastname1 = ucfirst($_POST['lastname1']);
    $dni1 = $_POST['dni1'];
    $address1 = $_POST['address1'];
    $districts1 = ($_POST['id_districts1']);
    $phone1 = $_POST['phone1'];

    $name2 = ucfirst($_POST['name2']);
    $lastname2 = ucfirst($_POST['lastname2']);
    $dni2 = $_POST['dni2'];
    $address2 = $_POST['address2'];
    $districts2 = ($_POST['id_districts2']);
    $phone2 = $_POST['phone2'];

    $name3 = ucfirst($_POST['name3']);
    $lastname3 = ucfirst($_POST['lastname3']);
    $dni3 = $_POST['dni3'];
    $address3 = $_POST['address3'];
    $districts3 = ($_POST['id_districts3']);
    $phone3 = $_POST['phone3'];

    $name4 = ucfirst($_POST['name4']);
    $lastname4 = ucfirst($_POST['lastname4']);
    $dni4 = $_POST['dni4'];
    $address4 = $_POST['address4'];
    $districts4 = ($_POST['id_districts4']);
    $phone4 = $_POST['phone4'];

    // NO REPETITIVO
    // CREAR PLANILLA
    $idfile = $connec->prepare('INSERT INTO files (id) 
    VALUES (null)');
    $idfile->execute();
    $resultidfile = $idfile ->fetch();

    // NO REPETITIVO
    // BUSCAMOS EL ID DE LA ULTIMA PLANILLA CREADA
    $r = $connec->prepare("SELECT id FROM files WHERE id = (SELECT max(id) FROM files)");
    $r->execute();
    $res = $r->fetch();

    // NO REPETITIVO
    // RELACION DE USUARIO - PLANILLA
    $file_user = $connec->prepare('INSERT INTO file_user (id_user, id_file) VALUES(:id_user, :id_file)');
    $file_user->execute(array(
        ':id_user' => $id_user['id'],
        ':id_file' => $res[0]
    ));
    $resultfile_user = $file_user->fetchAll();

    // REPETITIVO
    for($i = 1; $i < 5; $i++){

        // CREAR VOTANTE
        $votante = $connec->prepare('INSERT INTO persons (name, lastname, dni, address, phone)
        VALUES (:name, :lastname, :dni, :address, :phone)');
        $votante->execute(array(
            ':name' => ${'name' . $i},
            ':lastname' => ${'lastname' . $i},
            ':dni' => ${'dni' . $i},
            ':address' => ${'address' . $i},
            ':phone' => ${'phone' . $i},
        ));
        $resultvotante = $votante->fetch();

        // BUSCAMOS EL ID DEL VOTANTE
        $id_person = $connec->prepare('SELECT id FROM persons WHERE dni = :dni');
        $id_person->execute(array(':dni' => ${'dni' . $i}));
        $resultid = $id_person->fetch();

        // RELACION VOTANTE - BARRIO
        $barrio = $connec->prepare('INSERT INTO district_person (id_district, id_person) VALUES(:id_district, :id_person)');
        $barrio->execute(array(
            ':id_district' => ${'districts' . $i},
            ':id_person' => $resultid[0]
        ));
        $resultbarrio = $barrio->fetch();

        // RELACION VOTANTE - PLANILLA
        $file_person = $connec->prepare('INSERT INTO file_person (id_file, id_person) VALUES(:id_file, :id_person)');
        $file_person->execute(array(
            ':id_file' => $res[0],
            ':id_person' => $resultid[0]
        ));
        $resultfile_person = $file_person ->fetch();

        // RELACION VOTANTE - USUARIO
        $person_user = $connec->prepare('INSERT INTO person_user (id_user, id_person) VALUES(:id_user, :id_person)');
        $person_user->execute(array(
            ':id_user' => $id_user['id'],
            ':id_person' => $resultid[0]
        ));
        $resultperson_user = $person_user ->fetch();

    }

}
