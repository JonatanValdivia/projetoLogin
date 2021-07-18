<?php
  require_once('./classes/Usuarios.php');
  $instancia = new Usuarios;
  if(isset($_POST['nome'])){
    $nome = addslashes($_POST['nome']); //PARA RETIRAR QUALQUER COMANDO MALICIOSO
    $telefone = addslashes($_POST['telefone']);
    $email = addslashes($_POST['email']);
    $senha = addslashes($_POST['senha']);
    $confSenha = addslashes($_POST['confSenha']);

    if(!empty($nome) && !empty($telefone) && !empty($email) && !empty($senha) && !empty($confSenha) ){
      $instancia->conectar("projeto_login", "localhost", "root", "bcd127");
      if($instancia->msgErro == ""){
        if($senha == $confSenha){
          if($instancia->cadastrar($nome, $telefone, $email, $senha)){
           ?>
          <div id="msg-sucesso">
            Cadastrado com sucesso! <a href="./index.php">Acesse</a> para entrar!
          </div>          
          <?php
          }else{
            ?>
            <div class="msg-erro">
              Erro: E-mail já cadastrado!
            </div>
            <?php
          }
        }else{
          ?>
          <div class="msg-erro">
            Erro: senha e confirmar senha não correspondem!
          </div>
          <?php
        }
      }else{
        ?>
          <div class="msg-erro">
            <?php echo "Erro: " . $instancia->msgErro == "";?>
          </div>
        <?php
      }
      
    }else{
      echo "Preencha todos os campos!";
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
      <input type="text" placeholder="Nome cmpleto" id="" maxlength="100" name="nome">
      <input type="text" placeholder="Telefone" id="" maxlength="30" name="telefone">
      <input type="email" placeholder="E-mail" id="" maxlength="40" name="email">
      <input type="password" placeholder="Senha" id="" maxlength="15" name="senha">
      <input type="password" placeholder="Confirmar senha" id="" maxlength="15" name="confSenha">
      <input type="submit" value="Cadastrar">
    </form>
    <a href="index.php">Voltar</a>
  </div>
</body>
</html>