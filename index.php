<?php session_start();


$errores = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $mail = strtolower($_POST['email']);
    $password = hash('sha512', $_POST['password']);
 
    $errores = "";
    
    include('db.php');
    $connec = connect();

    $statement = $connec->prepare("SELECT * FROM users WHERE email = '$mail' AND password = '$password'");
    $statement->execute();
    $resultado = $statement->fetch();

    //Ingreso por rol 
    if ($resultado['role'] == 1 || $resultado['role'] == 2 || $resultado['role'] == 3) {
        $_SESSION['usuario'] = $mail;
        header('Location: users/inicio.php');
    }  
}

require 'index_view.php';
