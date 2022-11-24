<?php session_start();

if (!isset($_SESSION['usuario'])) {
    header('Location: ../index.php');
}

$id = $_POST['id'];
require 'nav.php';
$modify = $connec->prepare("SELECT * FROM users WHERE id = '$id'");
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

    <div class="card" style="width: 25rem; top: 20px; margin: 0 auto;">
        <svg style="margin: 0 auto;" xmlns="http://www.w3.org/2000/svg" width="70" height="70" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
            <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z" />
        </svg>
        <br />
        <form class="form" action="up2.php" method="post" name="add_person">

            <h6 style="font-weight:bold;">Nombre:</h6>
            <input type="text" name="name" value="<?php echo $result['name']; ?>" required></input>

            <h6 style="font-weight:bold;">Apellido:</h6>

            <input type="text" name="lastname" value="<?php echo $result['lastname']; ?>" required></input>

            <h6 style="font-weight:bold;">D.N.I.:</h6>

            <input type="text" name="dni" value="<?php echo $result['dni']; ?>" required></input>

            <h6 style="font-weight:bold;">Email:</h6>

            <input type="email" name="mail" value="<?php echo $result['email']; ?>" required></input>

            <h6 style="font-weight:bold;">Categoria:</h6>

            <select class="form-select" style="width: 15em;" name="role" required>
                <option value="1" <?= $result['role'] === '1' ? 'selected' : ''; ?>> 1 - Administrador</option>
                <option value="2" <?= $result['role'] === '2' ? 'selected' : ''; ?>> 2 - Dirigente </option>
                <option value="3" <?= $result['role'] === '3' ? 'selected' : ''; ?>> 3 - Invitado </option>
            </select>
            <br />

            <button type="submit" name="id" class="btn btn-success" value="<?php echo $result['id']; ?>">Guardar cambios</button>
            <br />
    </div>
    </form>
    </div>
</body>

</html>