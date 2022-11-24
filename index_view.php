<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,200;0,300;1,200;1,300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="users/style.css">
    <title>Iniciar Sesión</title>
</head>

<script type="text/javascript">
    function mostrarPassword() {
        var cambio = document.getElementById("txtPassword");
        if (cambio.type == "password") {
            cambio.type = "text";
            $('.icon').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
        } else {
            cambio.type = "password";
            $('.icon').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
        }
    }

    $(document).ready(function() {
        //CheckBox mostrar contraseña
        $('#ShowPassword').click(function() {
            $('#Password').attr('type', $(this).is(':checked') ? 'text' : 'password');
        });
    });
</script>


<body>
    <header>
        <nav class="navbar">
            <div class="container-fluid ">
                <h2 style="color:white; font-weight:bold; font-size: 22px; margin: auto;"> Sistema </h2>
            </div>
        </nav>
    </header>
    <br />

    <section class="card text-center" style="width:60%; height: 80%; margin: 0 auto;">


        <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" name="login">

            <div class="card-header" style="width: 100%; color:black">
                Iniciar Sesión
            </div>

            <div style="width:70%; height: 80%; margin: 0 auto; color:black">
                <br />
                <label>Email:</label>
                <br />
                <input type="email" class="form-control" name="email" value="<?php if (isset($mail)) echo $mail ?>" placeholder="Ingresar email">
                <br />
                <label>Contraseña:</label>
                <br />
                <div class="container">
                    <div class="row">
                        <div class="input-group">
                            <input name="password" ID="txtPassword" type="Password" Class="form-control">
                            <div class="input-group-append">
                                <button id="show_password" class="btn btn-primary" type="button" onclick="mostrarPassword()"> <span class="fa fa-eye-slash icon"></span> </button>
                            </div>
                        </div>
                        <br />
                    </div>
                    <br />
                    <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
                    <br />
                    <?php if (!empty($errores)) : ?>
                        <ul>
                            <?php echo $errores; ?>
                        </ul>
                    <?php endif ?>


                    <br />
        </form>

    </section>
</body>

</html>