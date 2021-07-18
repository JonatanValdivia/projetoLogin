<?php
  session_start();
  if(!isset($_SESSION['id'])){
    header('location: index.php');
    exit;
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sessão privada</title>
</head>
<body>
  <div>
    <h1>Sessão privada</h1>
    <h3>Seja bem-vindo!</h3>
  </div>

</body>
</html>