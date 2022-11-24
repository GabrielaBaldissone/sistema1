<?php session_start();

if (!isset($_SESSION['usuario'])) {
    header('../index.php');
}

require 'nav.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = ucfirst($_POST['name']);
    $lastname = ucfirst($_POST['lastname']);
    $dni = $_POST['dni'];
    $role = $_POST['role'];
    $mail = strtolower($_POST['email']);
    $password = $_POST['password'];
    $help = $_POST['password'];
    $password2 = $_POST['password2'];

    $errores = '';

    if (empty($name) or empty($lastname) or empty($dni) or empty($mail) or empty($password) or empty($password2)) {
        $errores .= '<li> Por favor, rellena todos los datos correctamente</li>';
    } else {

        $statement = $connec->prepare('SELECT * FROM users WHERE dni = :dni');
        $statement->execute(array(
            ':dni' => $dni
        ));
        $resultado = $statement->fetch();

        if ($resultado != false) {
            $errores .= '<li>El DNI ya existe.</li>';
        }

        $statement = $connec->prepare('SELECT * FROM users WHERE email = :email');
        $statement->execute(array(
            ':email' => $mail
        ));
        $resultado = $statement->fetch();

        if ($resultado != false) {
            $errores .= '<li>El mail ya existe.</li>';
        }
    }

    $password = hash('sha512', $password);
    $password2 = hash('sha512', $password2);

    if ($password != $password2) {
        $errores .= '<li>Las contraseñas no coinciden. </li>';
    }

    if ($errores == '') {
        $statement = $connec->prepare('INSERT INTO users (name, lastname, dni, email, password, help, role) 
    VALUES (:name, :lastname, :dni, :email, :password, :help, :role)');
        $statement->execute(array(
            ':name' => $name,
            ':lastname' => $lastname,
            ':dni' => $dni,
            ':email' => $mail,
            ':password' => $password,
            ':help' => $help,
            ':role' => $role

        ));
        $error = '';
        $resultados = $statement;

        if ($resultados == false) {
            $error .= " <li>Error al agregar dirigente</li>";
        } else {
            $error .= " <li>Se agregó correctamente. </li>";
        }
    }
}

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
    <title>Dirigentes </title>
</head>

<body>

    <div class="card" style="width: 25em; height:auto; top: 1rem; margin: 0 auto; border: 2px solid #EA1B36;">
        <svg style="margin: 0 auto;" xmlns="http://www.w3.org/2000/svg" width="70" height="70" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
            <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z" />
        </svg>
        <br />
        <form class="form" action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" name="add_person">

            <h6 style="font-weight:bold;">Nombre:</h6>
            <input type="text" name="name" value="<?php if (isset($name)) echo $name ?>" required></input>
            <h6 style="font-weight:bold;">Apellido:</h6>     
            <input type="text" name="lastname" value="<?php if (isset($lastname)) echo $lastname ?>" required></input>          
            <h6 style="font-weight:bold;">D.N.I.: (sin puntos)</h6>          
            <input type="number" name="dni" value="<?php if (isset($dni)) echo $dni ?>" required></input> 
            <h6 style="font-weight:bold;">Categoria:</h6>
            <select class="form-select" style="width: 15em;" name="role" required>
                <option value="1"> 1 - Administrador </option>
                <option value="2"> 2 - Dirigente </option>
                <option value="3" selected> 3 - Invitado </option>
            </select>
            <br />
            <h6 style="font-weight:bold;">Email:</h6>
            <input type="email" name="email" value="<?php if (isset($mail)) echo $mail ?>" required></input>
            <h6 style="font-weight:bold;">Contraseña:</h6>
            <input type="text" name="password" required></input>
            <h6 style="font-weight:bold;">Confirmar contraseña:</h6>
            <input type="text" name="password2"></input>
            <br />
            <button type="submit" class="btn btn-success"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-plus" viewBox="0 0 16 16">
                    <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z" />
                    <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z" />
                </svg> Agregar usuario</button>
                <br />
            <?php if (!empty($errores)) : ?>
                <div>
                    <ul>
                        <?php echo $errores; ?>
                    </ul>
                </div>
            <?php endif ?>

            <?php if (!empty($error)) : ?>
                <div>
                    <ul>
                        <?php echo $error; ?>
                    </ul>
                </div>
            <?php endif ?>
        </form>
    </div>

</body>

</html>