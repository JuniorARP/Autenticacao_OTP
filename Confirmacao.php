<?php
session_start();
require "Authenticator.php";

$Authenticator = new Authenticator();
if (!isset($_SESSION['auth_secret'])) {
  $secret = $Authenticator->generateRandomSecret();
  $_SESSION['auth_secret'] = $secret;
}

$qrCodeUrl = $Authenticator->getQR('Arthur, Gabriel e Luan', $_SESSION['auth_secret']);

if (!isset($_SESSION['failed'])) {
  $_SESSION['failed'] = false;
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
  <div id="formalario">
    <form action="Verificacao.php" method="post">
      <div style="text-align: center;">
        <?php
        if ($_SESSION['failed']) :
        ?>
          <div class="CodigoInvalido">Código Inválido !</div>
          <?php
          $_SESSION['failed'] = false;
          ?>
        <?php endif ?>
        <h2>Autenticar QR Code</h2>
        <p>Faça a leitura do código QR abaixo</p>
        <img style="text-align: center;" class="img-fluid" src="<?php echo $qrCodeUrl ?>" alt="Verificador Google Authenticator">
        <br>
        <br>
        <input type="text" class="txtCodigo" name="code" placeholder="Informe o código QR">
        <br>
        <br>
        <button type="submit" class="botao">Confirmar Código</button>
      </div>
    </form>
  </div>
</body>

</html>