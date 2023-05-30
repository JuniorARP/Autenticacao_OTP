<?php
session_start();

require "Authenticator.php";
if ($_SERVER['REQUEST_METHOD'] != "POST") {
    header("location: Confirmacao.php");
    die();
}
$Authenticator = new Authenticator();

$checkResult = $Authenticator->verifyCode($_SESSION['auth_secret'], $_POST['code'], 2);    // 2 = 2*30sec clock tolerance

if (!$checkResult) {
    $_SESSION['failed'] = true;
    header("location: Confirmacao.php");
    die();
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <title>Autenticação via OTP</title>
    <link rel="stylesheet" href="css/main.css" />
    <link rel="shortcut icon" href="img/Favicon.png" />
</head>

<body>
    <div class="Mensagem_concluido">
        <img class="concluido" src="img/Confirmado.png">
    </div>
</body>

</html>