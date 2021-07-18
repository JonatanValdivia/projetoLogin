<?php
//Todos os métodos necessários para execução do código

Class Usuarios{
  private $pdo;
  public $msgErro;

  public function conectar($nome, $host, $usuario, $senha){
    global $pdo;
    try{
      $pdo = new PDO("mysql:dbname=".$nome.";host=".$host,$usuario,$senha);
    }catch(PDOException $e){
      global $msgErro;
      $msgErro = $e->getMessage();
    }
  }

  public function cadastrar($nome, $telefone, $email, $senha){
    global $pdo;
    //Verificar se já existe o email cadastrado. 
      /*Se esse comando retornar um id, significa que há um usuário logado com esse email, logo, o mesmo não pode usar esse email para se cadastrar*/
    $sql = $pdo->prepare("SELECT id from tbl_usuario where email = :e");
    //Substituição do ":e", para o parâmetro $email
    $sql->bindValue(":e", $email);
    $sql->execute();
    if($sql->rowCount() > 0){
      return false; //Já está cadastrada;
    }else{
      //Caso não haja, cadastrar
      $sql = $pdo->prepare("INSERT into tbl_usuario (nome, telefone, email, senha) values (:n, :t, :e, :s)");
      $sql->bindValue(":n", $nome);
      $sql->bindValue(":t", $telefone);
      $sql->bindValue(":e", $email);
      $sql->bindValue(":s", md5($senha));

      return $sql->execute();
    }
  }

  public function logar($email, $senha){
    global $pdo;
    //Verificar se o email e senha estão cadastrados
    $sql = $pdo->prepare("SELECT id from tbl_usuario where email = :e and senha = :s");
    $sql->bindValue(":e", $email);
    $sql->bindValue(":s", md5($senha));
    $sql->execute();
    if($sql->rowCount() > 0){
      //Entrar no sistema (sessao)
      $dado = $sql->fetch();
      session_start();
      $_SESSION['id'] = $dado['id'];
      return true; //logado com sucesso
    }else{
      //Tem que se cadastrar
      return false;
    }
  }
}