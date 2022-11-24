<?php session_start();

if (!isset($_SESSION['usuario'])) {
    header('Location: ../index.php');
}

require 'nav.php'; 

$id = $_POST['id'];

$modify = $connec->prepare("SELECT * FROM districts WHERE id = '$id'");
$modify->execute();
$result = $modify->fetch();


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,200;0,300;1,200;1,300&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Actualizar usuario</title>
</head>

<body>

    <div class="card text-center card w-75" style="position:relative; margin: 10px auto">

        <form action="upba2.php" method="post" name="updatebarrio" style="position:relative; margin:auto; width:100%" >

        <h5 style="position:relative; margin:10px auto; text-align:center; font-weight:bold;">Nombre de barrio:</h5>
            <input style=" display: inline-block; width: 40%; " type="text" name="name" value="<?php echo $result['name']; ?>" required></input>
            <br />
            <br />
            <button type="submit" name="id" class="btn btn-success" value="<?php echo $result['id']; ?>">Guardar cambios</button>
            <br /> <br />
        </form>
    </div>
</body>

</html>