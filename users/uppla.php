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

if (isset($_POST)) {
    $i = 0;

    foreach ($_POST['id2'] as $row) {

        $id_edit = $row;
        $editname = $_POST['name'];
        $editlastname =  $_POST['lastname'];
        $editdni = $_POST['dni'];
        $editaddress = $_POST['address'];
        $editdistrict = $_POST['district'];
        $editphone = $_POST['phone'];

        $statement = $connec->prepare("SELECT dni FROM persons WHERE id='$id_edit'");
        $statement->execute();
        $res = $statement->fetchAll();

        // ID DE LA PLANILLA DONDE ESTÁN LOS VOTANTES
        $file_person = $connec->prepare("SELECT id_file FROM file_person WHERE id_person ='$id_edit'");
        $file_person->execute();
        $id_file = $file_person->fetchAll();

        // Si los DNI son IGUALES RELACIONADOS CON EL ID O ESTAN VACIOS, GUARDAR LOS OTROS DATOS
        if ($res[0][0] == $editdni[$i] or $editdni[$i] == "") {

            if ($editdni[$i] == "") {
                $editdni[$i] = rand(1, 900000);
            }

            $updatedistrict[$i] = $connec->prepare("UPDATE district_person SET id_district = '$editdistrict[$i]' 
        WHERE id_person = '$id_edit'");
            $updatedistrict[$i]->execute();

            $update[$i] = $connec->prepare("UPDATE persons 
       SET name= :name, lastname= :lastname, dni = :dni,
       address= :address, phone= :phone 
       WHERE id='$id_edit'");
            $update[$i]->execute(array(
                ':name' => $editname[$i],
                ':lastname' => $editlastname[$i],
                ':dni' => $editdni[$i],
                ':address' => $editaddress[$i],
                ':phone' => $editphone[$i]
            ));
            $up  = $update[$i]->fetch();


            // SI LOS DNI SON DIFERENTES A LA BASE DE DATOS CON RELACION AL ID PERO IGUALES DE OTROS DNI, ERROR.            
        } elseif ($res[0][0] != $editdni[$i] or strlen($editdni[$i]) >= 7) {

            $error = '';
            $statement1 = $connec->prepare("SELECT * FROM persons WHERE dni='$editdni[$i]'");
            $statement1->execute();
            $r = $statement1->fetchAll();

            if ($r == false) {

                $updatedistrict2[$i] = $connec->prepare("UPDATE district_person SET id_district = '$editdistrict[$i]' 
            WHERE id_person = '$id_edit'");
                $updatedistrict2[$i]->execute();

                // SINO SON IGUALES, SE GUARDA TODO    
                $updni[$i] = $connec->prepare("UPDATE persons 
                        SET name= :name, lastname= :lastname, dni= :dni, 
                        address= :address, phone= :phone 
                        WHERE id='$id_edit'");
                $updni[$i]->execute(array(
                    ':name' => $editname[$i],
                    ':lastname' => $editlastname[$i],
                    ':dni' => $editdni[$i],
                    ':address' => $editaddress[$i],
                    ':phone' => $editphone[$i]
                ));
                $resultupdni = $updni[$i]->fetch();
            } else {

                $select = $connec->prepare("SELECT dni 
                    FROM persons P
                    INNER JOIN person_user U
                    ON P.id = U.id_person
                    WHERE U.id_user = '$id_user[id]'");
                $select->execute();
                $selectresult = $select->fetchAll();


                foreach ($selectresult as $row2) {

                    if ($row2[0] == $editdni[$i]) {

                        $dniresul[$i] = $connec->prepare("SELECT id FROM persons WHERE dni = '$row2[0]'");
                        $dniresul[$i]->execute();
                        $id_dni[$i] = $dniresul[$i]->fetch();

                        $num = $id_dni[$i];
                    }
                }

                if (!empty($num[0])) {
                    $delete = $connec->prepare("DELETE FROM person_user WHERE id_person ='$num[0]'");
                    $delete->execute();
                    $resultado = $delete->fetch();

                    $deleteperson = $connec->prepare("DELETE FROM persons WHERE id ='$num[0]'");
                    $deleteperson->execute();
                    $resultado = $deleteperson->fetch();

                    $delete_barrio = $connec->prepare("DELETE FROM district_person WHERE id_person = '$num[0]'");
                    $delete_barrio->execute();

                    $updatedistrict3[$i] = $connec->prepare("UPDATE district_person SET id_district = '$editdistrict[$i]' 
                    WHERE id_person = '$id_edit'");
                    $updatedistrict3[$i]->execute();

                    // SINO SON IGUALES, SE GUARDA TODO    
                    $updni3[$i] = $connec->prepare("UPDATE persons 
                                SET name= :name, lastname= :lastname, dni= :dni, 
                                address= :address, phone= :phone 
                                WHERE id='$id_edit'");
                    $updni3[$i]->execute(array(
                        ':name' => $editname[$i],
                        ':lastname' => $editlastname[$i],
                        ':dni' => $editdni[$i],
                        ':address' => $editaddress[$i],
                        ':phone' => $editphone[$i]
                    ));
                    $resultupdni3 = $updni3[$i]->fetch();
                } else {
                    $error .= 'Hay al menos un DNI que ya está incluido en otra planilla.';
                }
            }
        }

        $i++;
        $error1 = "";
        if ($r == false or !empty($num[0])) {
            $error1 .= '<li> Cambios guardados correctamente.</li>';
        }
    }
}

require 'upplanilla.php';
