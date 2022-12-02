<?php session_start();

if (!isset($_SESSION['usuario'])) {
    header('Location: ../index.php');
}

$mailv = ($_SESSION['usuario']);

require_once('../db.php');
$connec = connect();

$role = $connec->prepare("SELECT role FROM users WHERE email ='$mailv'");
$role->execute();
$roles = $role->fetch();

?>


<nav class="navbar">
    <div class="container-fluid">
        <div>
            <a class="btn btn-outline-light" href="inicio.php"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M2 13.5V7h1v6.5a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5V7h1v6.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5zm11-11V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z" />
                    <path fill-rule="evenodd" d="M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z" />
                </svg></a>
            <?php
            if ($roles['role'] == 1) {
            ?>
                <a style="background-color: #f1f1f1d2" class="btn btn-light btn-sm" href="contenido.php">USUARIOS</a>
                <a style="background-color: #f1f1f1d2" class="btn btn-light btn-sm" href="barrios.php">BARRIOS</a>
            <?php
            }
            ?>
            <a style="background-color: #f1f1f1d2" class="btn btn-light btn-sm disabled" href="planillas.php">PLANILLAS</a>
            <a style="background-color: #f1f1f1d2" class="btn btn-light btn-sm disabled" href="vot.php">VOTANTES</a>
        </div>
        <a class="btn btn-outline-light" href="../cerrar_sesion.php" title="Cerrar sesión"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z" />
                <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z" />
            </svg></a>
    </div>
</nav>