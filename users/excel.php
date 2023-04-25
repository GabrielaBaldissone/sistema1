<?php	session_start();

	if (!isset($_SESSION['usuario'])) {
		header('Location: ../index.php');
	}

	header("Content-Type: application/xls");    
	header("Content-Disposition: attachment; filename=documento_exportado_" . date('Y:m:d:h:i:s').".xls");
	header("Pragma: no-cache"); 
	header("Expires: 0");
    include('../db.php');
    $connec = connect();
	require_once '../db.php';
	$output = "";
	
	if(ISSET($_POST['export_data'])){
		$output .="
			<table>
				<thead>
					<tr>
						<th>Nombre</th>
						<th>Apellido</th>
                        <th>dni</th>
						<th>Direccion</th>
                        <th>Telefono</th>
						<th>Barrio</th>
						<th>Planilla</th>
						<th>Dirigente</th>
					</tr>
				<tbody>
		";

		$mail = ($_SESSION['usuario']);

		$role = $connec->prepare("SELECT * FROM users WHERE email ='$mail'");
		$role->execute();
		$roles = $role->fetch();
		
		if ($roles['role'] == 1) {
        	$query = mysqli_query($conn, "SELECT * FROM `persons` WHERE dni != 0");
		}elseif($roles['role'] == 2) {
			$id = $roles['id'];
			$query = mysqli_query($conn, "SELECT *
				FROM persons P
				JOIN person_user U
				ON P.id = U.id_person
				WHERE '$id' = U.id_user AND dni != 0
			");
		}

		while($fetch = mysqli_fetch_array($query)){

			$id_ = $roles['role'] == 1 ? $fetch['id'] : $fetch['id_person'];
			$result1 = $connec->prepare("SELECT name
				FROM districts D
				JOIN district_person P
				ON D.id = P.id_district
				WHERE P.id_person = " . $id_);
			$result1->execute();
			$name_dis = $result1->fetch();

			$result2 = $connec->prepare("SELECT id_file
				FROM file_person
				WHERE id_person = " . $id_);
			$result2->execute();
			$planilla = $result2->fetch();
			
			$result3 = $connec->prepare("SELECT name, lastname
				FROM users U
				JOIN person_user P
				ON U.id = P.id_user
				WHERE P.id_person = " . $id_);
			$result3->execute();
			$owner = $result3->fetch();
			

		$output .= "
			<tr>
				<td>".$fetch['name']."</td>
				<td>".$fetch['lastname']."</td>
				<td>".$fetch['dni']."</td>
				<td>".$fetch['address']."</td>
				<td>".$fetch['phone']."</td>
				<td>".$name_dis[0]."</td>
				<td>".$planilla['id_file']."</td>
				<td>".$owner['name']." ".$owner['lastname']."</td>
			</tr>
		";
		}
		
		$output .="
				</tbody>
				
			</table>
		";
		
		echo $output;
	}
	
?>