<?php
  require_once('./classes/Usuarios.php');
  $instancia = new Usuarios;
  if(isset($_POST['email'])){
    $email = addslashes($_POST['email']);
    $senha = addslashes($_POST['senha']);

    if(!empty($email) && !empty($senha)){
      $instancia->conectar("projeto_login", "localhost", "root", "bcd127");;
      if($instancia->msgErro == ''){
        if($instancia->logar($email, $senha)){
          header("location: sessaoPrivada.php");
        }else{
          ?>
            <div class="msg-erro">
              Erro: E-mail e/ou senha incorretos
            </div>
          <?php
        }
      }else{
        ?>
          <div class="msg-erro">
            <?php echo "Erro: " . $instancia->msgErro;?>
          </div>
        <?php
      }
    }else{
      ?>
        <div class="msg-erro">
          Erro: Preencha todos os campos!
        </div>
      <?php
    }
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Projeto Login</title>
  <link rel="stylesheet" href="CSS/style.css">
</head>
<body>
  <div id="corpo">
    <h1>Entrar</h1>
    <form method="POST">
      <input type="email" placeholder="E-mail" name="email">
      <input type="password" placeholder="Senha" name="senha">
      <input type="submit" value="ACESSAR">
    </form>
    <a href="cadastrar.php">Ainda não é inscrito?<strong> CADASTRE-SE</strong></a>
  </div>
</body>
</html>