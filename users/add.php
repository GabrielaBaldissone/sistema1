<?php 
header("Content-type: application/json; charset=utf-8");
$input = json_decode(file_get_contents("php://input"), true);

session_start();

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
    $name1 = $input['name1'] ? ucfirst($input['name1']) : "";
    $lastname1 = $input['lastname1'] ? ucfirst($input['lastname1']) : "";
    $dni1 = $input['dni1'] ? $input['dni1'] : "";
    $address1 = $input['address1'] ? $input['address1'] : "";
    $id_districts1 = $input['id_districts1'] ? $input['id_districts1'] : "";
    $phone1 = $input['phone1'] ? $input['phone1'] : "";

    $name2 = $input['name2'] ? ucfirst($input['name2']) : "";
    $lastname2 = $input['lastname2'] ? ucfirst($input['lastname2']) : "";
    $dni2 = $input['dni2'] ? $input['dni2'] : "";
    $address2 = $input['address2'] ? $input['address2'] : "";
    $id_districts2 = $input['id_districts2'] ? $input['id_districts2'] : "";
    $phone2 = $input['phone2'] ? $input['phone2'] : "";

    $name3 = $input['name3'] ? ucfirst($input['name3']) : "";
    $lastname3 = $input['lastname3'] ? ucfirst($input['lastname3']) : "";
    $dni3 = $input['dni3'] ? $input['dni3'] : "";
    $address3 = $input['address3'] ? $input['address3'] : "";
    $id_districts3 = $input['id_districts3'] ? $input['id_districts3'] : "";
    $phone3 = $input['phone3'] ? $input['phone3'] : "";

    $name4 = $input['name4'] ? ucfirst($input['name4']) : "";
    $lastname4 = $input['lastname4'] ? ucfirst($input['lastname4']) : "";
    $dni4 = $input['dni4'] ? $input['dni4'] : "";
    $address4 = $input['address4'] ? $input['address4'] : "";
    $id_districts4 = $input['id_districts4'] ? $input['id_districts4'] : "";
    $phone4 = $input['phone4'] ? $input['phone4'] : "";

    $name5 = $input['name5'] ? ucfirst($input['name5']) : "";
    $lastname5 = $input['lastname5'] ? ucfirst($input['lastname5']) : "";
    $dni5 = $input['dni5'] ? $input['dni5'] : "";
    $address5 = $input['address5'] ? $input['address5'] : "";
    $id_districts5 = $input['id_districts5'] ? $input['id_districts5'] : "";
    $phone5 = $input['phone5'] ? $input['phone5'] : "";

    $name6 = $input['name6'] ? ucfirst($input['name6']) : "";
    $lastname6 = $input['lastname6'] ? ucfirst($input['lastname6']) : "";
    $dni6 = $input['dni6'] ? $input['dni6'] : "";
    $address6 = $input['address6'] ? $input['address6'] : "";
    $id_districts6 = $input['id_districts6'] ? $input['id_districts6'] : "";
    $phone6 = $input['phone6'] ? $input['phone6'] : "";

    $name7 = $input['name7'] ? ucfirst($input['name7']) : "";
    $lastname7 = $input['lastname7'] ? ucfirst($input['lastname7']) : "";
    $dni7 = $input['dni7'] ? $input['dni7'] : "";
    $address7 = $input['address7'] ? $input['address7'] : "";
    $id_districts7 = $input['id_districts7'] ? $input['id_districts7'] : "";
    $phone7 = $input['phone7'] ? $input['phone7'] : "";

    $name8 = $input['name8'] ? ucfirst($input['name8']) : "";
    $lastname8 = $input['lastname8'] ? ucfirst($input['lastname8']) : "";
    $dni8 = $input['dni8'] ? $input['dni8'] : "";
    $address8 = $input['address8'] ? $input['address8'] : "";
    $id_districts8 = $input['id_districts8'] ? $input['id_districts8'] : "";
    $phone8 = $input['phone8'] ? $input['phone8'] : "";

    $name9 = $input['name9'] ? ucfirst($input['name9']) : "";
    $lastname9 = $input['lastname9'] ? ucfirst($input['lastname9']) : "";
    $dni9 = $input['dni9'] ? $input['dni9'] : "";
    $address9 = $input['address9'] ? $input['address9'] : "";
    $id_districts9 = $input['id_districts9'] ? $input['id_districts9'] : "";
    $phone9 = $input['phone9'] ? $input['phone9'] : "";

    $name10 = $input['name10'] ? ucfirst($input['name10']) : "";
    $lastname10 = $input['lastname10'] ? ucfirst($input['lastname10']) : "";
    $dni10 = $input['dni10'] ? $input['dni10'] : "";
    $address10 = $input['address10'] ? $input['address10'] : "";
    $id_districts10 = $input['id_districts10'] ? $input['id_districts10'] : "";
    $phone10 = $input['phone10'] ? $input['phone10'] : "";

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
    for($i = 1; $i < 11; $i++){

        // BUSCAMOS SI LA PERSONA EXISTE EN LA DB
        $dni = ${'dni' . $i};
        $name = ${'name' . $i};
        $lastname = ${'lastname' . $i};
        $address = ${'address' . $i};
        $id_districts = ${'id_districts' . $i};
        $phone = ${'phone' . $i};
        $person = $connec->prepare("SELECT * FROM persons WHERE dni = '$dni' AND dni != 0");
        $person->execute();
        $resultPerson = $person->fetch();

        if($resultPerson != false){
            // (FORMULARIO -> BASE DE DATOS)
            // REEMPLAZAMOS LOS DATOS DEL VOTANTE 
            $votante = $connec->prepare("UPDATE persons SET name = '$name', lastname = '$lastname', address = '$address', phone = '$phone' WHERE dni = '$dni'");
            $votante->execute();

            // REEMPLAZAMOS LOS DATOS DE LA RELACION VOTANTE - BARRIO
            $resultPersonFormated = $resultPerson[0];
            $barrio = $connec->prepare("UPDATE district_person SET id_district = '$id_districts' WHERE id_person = '$resultPersonFormated'");
            $barrio->execute();

            $idGeneral = $resultPersonFormated;
        }else{
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
            $id_person = $connec->prepare('SELECT MAX(id) AS lastID FROM persons');
            $id_person->execute();
            $resultid = $id_person->fetch();

            // RELACION VOTANTE - BARRIO
            $barrio = $connec->prepare('INSERT INTO district_person (id_district, id_person) VALUES(:id_district, :id_person)');
            $barrio->execute(array(
                ':id_district' => ${'id_districts' . $i},
                ':id_person' => $resultid[0]
            ));
            $resultbarrio = $barrio->fetch();

            // RELACION VOTANTE - USUARIO
            $person_user = $connec->prepare('INSERT INTO person_user (id_user, id_person) VALUES(:id_user, :id_person)');
            $person_user->execute(array(
                ':id_user' => $id_user['id'],
                ':id_person' => $resultid[0]
            ));
            $resultperson_user = $person_user ->fetch();
            $idGeneral = $resultid[0];
        }

        // RELACION VOTANTE - PLANILLA
        $file_person = $connec->prepare('INSERT INTO file_person (id_file, id_person) VALUES(:id_file, :id_person)');
        $file_person->execute(array(
            ':id_file' => $res[0],
            ':id_person' => $idGeneral
        ));
        $resultfile_person = $file_person ->fetch();
        
    }
    echo json_encode("exito");
}