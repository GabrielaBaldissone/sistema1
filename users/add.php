<?php session_start();

if (!isset($_SESSION['usuario'])) {
    header('Location: ../index.php');
}

include('../db.php');
$connec = connect();

$mailA = ($_SESSION['usuario']);

//BUSCAMOS EL ID DEL USUARIO QUE INICIO SESIÓN
$nombre = $connec->prepare("SELECT id FROM users WHERE email = '$mailA'");
$nombre->execute();
$id_user = $nombre->fetch();

//CREAMOS LAS VARIABLES DE ERRORES
$error = '';
$errores = '';
$errores2 = '';
$errores3 = '';
$errores4 = '';


// AGREGAMOS LA PLANILLA A LA BASE DE DATOS 


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    //RECIBIMOS LOS DATOS DE CADA VOTANTE 

    $name = ucfirst($_POST['name1']);
    $lastname = ucfirst($_POST['lastname1']);
    $dni = $_POST['dni1'];
    $address = $_POST['address1'];
    $districts = ($_POST['id_districts1']);
    $phone = $_POST['phone1'];

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

    //PREGUNTAMOS SI ESTÁ EN LA BASE DE DATOS

    if (empty($dni)) {
        $dni = rand(1, 900000);
    }
    $statement = $connec->prepare('SELECT * FROM persons WHERE dni = :dni');
    $statement->execute(array(':dni' => $dni));
    $resultado = $statement->fetch();

    if ($resultado != false) {

        // PEDIMOS TODOS LOS DNI DEL USUARIO SIN PLANILLA

        $select = $connec->prepare("SELECT dni 
            FROM persons P
            INNER JOIN person_user U
            ON P.id = U.id_person
            WHERE U.id_user = '$id_user[id]'");
        $select->execute();
        $selectresult = $select->fetchAll();

        if ($selectresult == true) {

            //SI EL DNI ES IGUAL AL DNI DE LOS VOTANTES SIN PLANILLA, ME TIRA EL ID 
            $i = 0;
            foreach ($selectresult as $row) {
                if ($resultado['dni'] == $row[$i]) {
                    $dniresul = $connec->prepare("SELECT id FROM persons WHERE dni = '$row[$i]'");
                    $dniresul->execute();
                    $id_dni = $dniresul->fetch();
                }
            }
            $i++;
            $num = $id_dni[0];

            // SI NO TENEMOS ID, EL DNI ESTA EN OTRA PLANILLA 
            if (empty($num)) {
                $errores .= ' DNI incluido en otra planilla ';
            } else {
                $bandera = 1;
            }
        }
    } else {
        //DNI ES DE UN NUEVO VOTANTE
        $bandera = 2;
    }

    if (empty($dni2)) {
        $dni2 = rand(1, 900000);
    }

    $statement2 = $connec->prepare('SELECT * FROM persons WHERE dni = :dni');
    $statement2->execute(array(':dni' => $dni2));
    $resultado2 = $statement2->fetch();

    if ($resultado2 != false) {

        $select2 = $connec->prepare("SELECT dni 
            FROM persons P
            INNER JOIN person_user U
            ON P.id = U.id_person
            WHERE U.id_user = '$id_user[id]'");
        $select2->execute();
        $selectresul2 = $select2->fetchAll();

        if ($selectresul2 == true) {
            $i = 0;
            foreach ($selectresul2 as $row) {
                if ($resultado2['dni'] == $row[$i]) {
                    $dniresul2 = $connec->prepare("SELECT id FROM persons WHERE dni = '$row[$i]'");
                    $dniresul2->execute();
                    $id_dni2 = $dniresul2->fetch();
                }
            }
            $i++;
            $num2 = $id_dni2[0];

            if (empty($num2)) {
                $errores2 .= ' DNI incluido en otra planilla ';
            } else {
                $bandera2 = 1;
            }
        }
    } else {
        $bandera2 = 2;
    }

    if (empty($dni3)) {
        $dni3 = rand(1, 900000);
    }
    $statement3 = $connec->prepare('SELECT * FROM persons WHERE dni = :dni');
    $statement3->execute(array(':dni' => $dni3));
    $resultado3 = $statement3->fetchAll();

    if ($resultado3 != false) {

        $select3 = $connec->prepare("SELECT dni 
        FROM persons P
        INNER JOIN person_user U
        ON P.id = U.id_person
        WHERE U.id_user = '$id_user[id]'");
        $select3->execute();
        $selectresul3 = $select3->fetchAll();

        if ($selectresul3 == true) {

            //SI EL DNI ES IGUAL AL DNI DE LOS VOTANTES SIN PLANILLA, ME TIRA EL ID 
            $i = 0;
            foreach ($selectresul3 as $row) {
                if ($resultado3['dni'] == $row[$i]) {
                    $dniresul3 = $connec->prepare("SELECT id FROM persons WHERE dni = '$row[$i]'");
                    $dniresul3->execute();
                    $id_dni3 = $dniresul3->fetch();
                }
            }
            $i++;
            $num3 = $id_dni3[0];

            // SI NO TENEMOS ID, EL DNI ESTA EN OTRA PLANILLA 
            if (empty($num3)) {
                $errores3 .= ' DNI incluido en otra planilla ';
            } else {
                $bandera3 = 1;
            }
        }
    } else {
        //DNI ES DE UN NUEVO VOTANTE
        $bandera3 = 2;
    }

    if (empty($dni4)) {
        $dni4 = rand(1, 900000);
    }

    $statement4 = $connec->prepare('SELECT * FROM persons WHERE dni = :dni');
    $statement4->execute(array(':dni' => $dni4));
    $resultado4 = $statement4->fetch();

    if ($resultado4 != false) {
        $select4 = $connec->prepare("SELECT dni 
            FROM persons P
            INNER JOIN person_user U
            ON P.id = U.id_person
            WHERE U.id_user = '$id_user[id]'");
        $select4->execute();
        $selectresul4 = $select4->fetchAll();

        if ($selectresul4 == true) {

            //SI EL DNI ES IGUAL AL DNI DE LOS VOTANTES SIN PLANILLA, ME TIRA EL ID 
            $i = 0;
            foreach ($selectresul4 as $row) {
                if ($resultado4['dni'] == $row[$i]) {
                    $dniresul4 = $connec->prepare("SELECT id FROM persons WHERE dni = '$row[$i]'");
                    $dniresul4->execute();
                    $id_dni4 = $dniresul4->fetch();
                }
            }
            $i++;
            $num4 = $id_dni4[0];

            // SI NO TENEMOS ID, EL DNI ESTA EN OTRA PLANILLA 
            if (empty($num4)) {
                $errores4 .= ' DNI incluido en otra planilla ';
            } else {
                $bandera4 = 1;
            }
        }
    } else {
        //DNI ES DE UN NUEVO VOTANTE
        $bandera4 = 2;
    }

    //VERIFICAR SI HAY DOS DNI IGUALES EN LA PLANILLA DE ENTRADA 
    if (
        $dni == $dni2 || $dni == $dni3 ||
        $dni == $dni4 || $dni2 == $dni3 ||
        $dni2 == $dni4 || $dni3 == $dni4
    ) {
        $error .= 'Se repiten DNI';
    }

    //SI NO HAY ERRORES INSERT O UPDATE

    if ($errores == false && $errores2 == false && $errores3 == false && $errores4 == false && $error == false) {
        // PRIMERA
        if ($bandera == 2) {
            $statement = $connec->prepare('INSERT INTO persons (name, lastname, dni, address, phone)
            VALUES (:name, :lastname, :dni, :address, :phone)');
            $statement->execute(array(
                ':name' => $name,
                ':lastname' => $lastname,
                ':dni' => $dni,
                ':address' => $address,
                ':phone' => $phone
            ));
            $result1 = $statement;

            $id_person = $connec->prepare('SELECT id FROM persons WHERE dni = :dni');
            $id_person->execute(array(':dni' => $dni));
            $resultid = $id_person->fetch();

            $barrio = $connec->prepare('INSERT INTO district_person (id_district, id_person) VALUES(:id_district, :id_person)');
            $barrio->execute(array(
                ':id_district' => $districts,
                ':id_person' => $resultid[0]
            ));
            $resultbarrio = $barrio->fetch();
        }

        if ($bandera2 == 2) {
            // SEGUNDA
            $statement2 = $connec->prepare('INSERT INTO persons (name, lastname, dni, address, phone)
            VALUES (:name, :lastname, :dni, :address, :phone)');
            $statement2->execute(array(
                ':name' => $name2,
                ':lastname' => $lastname2,
                ':dni' => $dni2,
                ':address' => $address2,
                ':phone' => $phone2
            ));
            $result2 = $statement2;

            $id_person2 = $connec->prepare('SELECT id FROM persons WHERE dni = :dni');
            $id_person2->execute(array(':dni' => $dni2));
            $resultid2 = $id_person2->fetch();

            $barrio2 = $connec->prepare('INSERT INTO district_person (id_district, id_person) VALUES(:id_district, :id_person)');
            $barrio2->execute(array(
                ':id_district' => $districts2,
                ':id_person' => $resultid2[0]
            ));
            $resultbarrio2 = $barrio2->fetchAll();
        }

        if ($bandera3 == 2) {
            //TERCERA
            $statement3 = $connec->prepare('INSERT INTO persons (name, lastname, dni, address, phone)
            VALUES (:name, :lastname, :dni, :address, :phone)');
            $statement3->execute(array(
                ':name' => $name3,
                ':lastname' => $lastname3,
                ':dni' => $dni3,
                ':address' => $address3,
                ':phone' => $phone3
            ));
            $result3 = $statement3;

            $id_person3 = $connec->prepare('SELECT id FROM persons WHERE dni = :dni');
            $id_person3->execute(array(':dni' => $dni3));
            $resultid3 = $id_person3->fetch();

            $barrio3 = $connec->prepare('INSERT INTO district_person (id_district, id_person) VALUES(:id_district, :id_person)');
            $barrio3->execute(array(
                ':id_district' => $districts3,
                ':id_person' => $resultid3[0]
            ));
            $resultbarrio3 = $barrio3->fetchAll();
        }

        if ($bandera4 == 2) {
            //CUARTA 
            $statement4 = $connec->prepare('INSERT INTO persons (name, lastname, dni, address, phone)
            VALUES (:name, :lastname, :dni, :address, :phone)');
            $statement4->execute(array(
                ':name' => $name4,
                ':lastname' => $lastname4,
                ':dni' => $dni4,
                ':address' => $address4,
                ':phone' => $phone4
            ));
            $result4 = $statement4;

            $id_person4 = $connec->prepare('SELECT id FROM persons WHERE dni = :dni');
            $id_person4->execute(array(':dni' => $dni4));
            $resultid4 = $id_person4->fetch();

            $barrio4 = $connec->prepare('INSERT INTO district_person (id_district, id_person) VALUES(:id_district, :id_person)');
            $barrio4->execute(array(
                ':id_district' => $districts4,
                ':id_person' => $resultid4[0]
            ));
            $resultbarrio4 = $barrio4->fetchAll();
        }

        if ($bandera == 1) {
            // PRIMERA 

            $statement = $connec->prepare("UPDATE persons SET name= :name, lastname= :lastname, dni= :dni, address= :address, phone= :phone
            WHERE id = '$num'");
            $statement->execute(array(
                ':name' => $name,
                ':lastname' => $lastname,
                ':dni' => $dni,
                ':address' => $address,
                ':phone' => $phone
            ));
            $result1 = $statement;

            $barrio = $connec->prepare("UPDATE district_person SET id_district ='$districts' WHERE id_person = '$num'");
            $barrio->execute();
            $resultbarrio = $barrio->fetch();

            $delete = $connec->prepare("DELETE FROM person_user WHERE id_person ='$num'");
            $delete->execute();
            $resultado = $delete->fetch();
        }

        if ($bandera2 == 1) {
            // SEGUNDA 

            $statement2 = $connec->prepare("UPDATE persons SET name= :name, lastname= :lastname, dni= :dni, address= :address, phone= :phone
        WHERE id = '$num2'");
            $statement2->execute(array(
                ':name' => $name2,
                ':lastname' => $lastname2,
                ':dni' => $dni2,
                ':address' => $address2,
                ':phone' => $phone2
            ));
            $result2 = $statement2;

            $barrio2 = $connec->prepare("UPDATE district_person SET id_district ='$districts2' WHERE id_person = '$num2'");
            $barrio2->execute();
            $resultbarrio2 = $barrio2->fetch();

            $delete2 = $connec->prepare("DELETE FROM person_user WHERE id_person ='$num2'");
            $delete2->execute();
            $resultado2 = $delete2->fetch();
        }

        if ($bandera3 == 1) {
            // TERCERA
            $statement3 = $connec->prepare("UPDATE persons SET name= :name, lastname= :lastname, dni= :dni, address= :address, phone= :phone
             WHERE id = '$num3'");
            $statement3->execute(array(
                ':name' => $name3,
                ':lastname' => $lastname3,
                ':dni' => $dni3,
                ':address' => $address3,
                ':phone' => $phone3
            ));
            $result3 = $statement3;

            $barrio3 = $connec->prepare("UPDATE district_person SET id_district ='$districts3' WHERE id_person = '$num3'");
            $barrio3->execute();
            $resultbarrio3 = $barrio3->fetch();

            $delete3 = $connec->prepare("DELETE FROM person_user WHERE id_person ='$num3'");
            $delete3->execute();
            $resultado3 = $delete3->fetch();
        }

        if ($bandera4 == 1) {
            // CUARTA 
            $statement4 = $connec->prepare("UPDATE persons SET name= :name, lastname= :lastname, dni= :dni, address= :address, phone= :phone
            WHERE id = '$num4'");
            $statement4->execute(array(
                ':name' => $name4,
                ':lastname' => $lastname4,
                ':dni' => $dni4,
                ':address' => $address4,
                ':phone' => $phone4
            ));
            $result4 = $statement4;

            $barrio4 = $connec->prepare("UPDATE district_person SET id_district ='$districts4' WHERE id_person = '$num4'");
            $barrio4->execute();
            $resultbarrio4 = $barrio4->fetch();

            $delete4 = $connec->prepare("DELETE FROM person_user WHERE id_person ='$num4'");
            $delete4->execute();
            $resultado4 = $delete4->fetch();
        }

        if($result1 != false){
            header('Location: planillas.php');
        }

        //CREAR LA PLANILLA, LA RELACIÓN DE VOTANTES CON PLANILLA Y DE PLANILLA CON USUARIO.

        if ($errores == false && $errores2 == false && $errores3 == false && $errores4 == false && $error == false) {

            // CREAR LA PLANILLA

            $idfile = $connec->prepare('INSERT INTO files (id) 
             VALUES (null)');
            $idfile->execute();
            $confirmación = $idfile ->fetch();

            // ÚLTIMO ID DE PLANILLA

            $r = $connec->prepare("SELECT id FROM files WHERE id = (SELECT max(id) FROM files)");
            $r->execute();
            $res = $r->fetch();

            // GUARDAR VOTANTES EN LA PLANILLA
            if ($bandera == 1) {
                $file_person = $connec->prepare('INSERT INTO file_person (id_file, id_person) VALUES(:id_file, :id_person)');
                $file_person->execute(array(
                    ':id_file' => $res[0],
                    ':id_person' => $num
                ));
            } else {
                $file_person = $connec->prepare('INSERT INTO file_person (id_file, id_person) VALUES(:id_file, :id_person)');
                $file_person->execute(array(
                    ':id_file' => $res[0],
                    ':id_person' => $resultid[0]
                ));
            }

            if ($bandera2 == 1) {
                $file_person = $connec->prepare('INSERT INTO file_person (id_file, id_person) VALUES(:id_file, :id_person)');
                $file_person->execute(array(
                    ':id_file' => $res[0],
                    ':id_person' => $num2
                ));
            } else {
                $file_person = $connec->prepare('INSERT INTO file_person (id_file, id_person) VALUES(:id_file, :id_person)');
                $file_person->execute(array(
                    ':id_file' => $res[0],
                    ':id_person' => $resultid2[0]
                ));
            }

            if ($bandera3 == 1) {

                $file_person = $connec->prepare('INSERT INTO file_person (id_file, id_person) VALUES(:id_file, :id_person)');
                $file_person->execute(array(
                    ':id_file' => $res[0],
                    ':id_person' => $num3
                ));
            } else {
                $file_person = $connec->prepare('INSERT INTO file_person (id_file, id_person) VALUES(:id_file, :id_person)');
                $file_person->execute(array(
                    ':id_file' => $res[0],
                    ':id_person' => $resultid3[0]
                ));
            }

            if ($bandera4 == 1) {
                $file_person = $connec->prepare('INSERT INTO file_person (id_file, id_person) VALUES(:id_file, :id_person)');
                $file_person->execute(array(
                    ':id_file' => $res[0],
                    ':id_person' => $num4
                ));
            } else {
                $file_person = $connec->prepare('INSERT INTO file_person (id_file, id_person) VALUES(:id_file, :id_person)');
                $file_person->execute(array(
                    ':id_file' => $res[0],
                    ':id_person' => $resultid4[0]
                ));
            }

            // CREAR RELACIÓN DE USUARIO Y PLANILLA

            $file_user = $connec->prepare('INSERT INTO file_user (id_user, id_file) VALUES(:id_user, :id_file)');
            $file_user->execute(array(
                ':id_user' => $id_user['id'],
                ':id_file' => $res[0]
            ));
            $resultfile_user = $file_user->fetchAll();

        }
    }
}


require 'votantesadd.php';
