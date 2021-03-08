<?php
session_start();
require_once 'Controller/config.php';
require_once 'Controller/Add_produtos.php';

// verifica se há sessaão do usuario
if (isset($_SESSION['estoque'])) {
    $id = addslashes($_SESSION['estoque']);

    $sql = $pdo->prepare("SELECT * FROM usuarios WHERE id = :id");
    $sql->bindValue(":id", $id);
    $sql->execute();

    if ($sql->rowCount() > 0) {
        $info = $sql->fetch();
    } else {
        header("Location: login.php");
        exit;
    }
} else {
    header("Location: login.php");
}

?>

<!DOCTYPE html>
<html lang="pt_br">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sistema Estoque</title>

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="bootstrap-3.4.1-dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="font-awesome/css/fontawesome.min.css">
  <link rel="stylesheet" href="font-awesome/css/solid.min.css">
  <link rel="stylesheet" href="font-awesome/css/regular.min.css">
  <link rel="stylesheet" href="font-awesome/css/svg-with-js.min.css">
  <link rel="stylesheet" href="font-awesome/css/v4-shims.min.css">
  <link rel="stylesheet" href="css/form.css">
  <link href="https://fonts.googleapis.com/css2?family=Roboto&family=Ubuntu:wght@300;700&display=swap" rel="stylesheet">
</head>
<body>

  <div class="container">

    <form class="form" method="POST">
      <h1>Cadastrar produto</h1>

      <ol class="breadcrumb">
        <li><a href="index.php">Voltar</a></li>
        <li class="active">Entrada</li>
      </ol>

      <fieldset>
        <legend>
          <h2>Dados</h2>
        </legend>

        <div class="row">
          <div class="col-md-6">

            <div class="form-group">
              <label>Código</label>
              <input class="form-control" type="text" name="CODIGO">
            </div>

            <div class="form-group">
              <label>Descricao</label>
              <input type="text" name="DESCRICAO" class="form-control">
            </div>

            <div class="form-group">
              <label>valor</label>
              <input type="number" class="form-control" min="0.01" step="0.01" value="0.0" name="VALOR">
            </div>

          </div>

          <div class="col-md-6">

            <div class="form-group">
              <label>Quantidade</label>
              <input type="number" min="1" step="1" value="0" name="QUANTIDADE" class="form-control">
            </div>

            <div class="form-group">
              <label>Motivo</label>
              <select name="MOTIVO" class="form-control">
                <option value="">Selecione</option>
                <option value="ESPECIFICAR">ESPECIFICAR</option>
                <option value="DEVOLUCAO">DEVOLUCAO</option>
                <option value="EMPRESTIMO">EMPRESTIMO</option>
              </select>
            </div>

            <div class="form-group">
              <label>Observacão</label>
              <textarea class="form-control" name="OBS" rows="2"></textarea>
            </div>

            <button type="submit" value="cadastrar" class="btn btn-block btn-success">Cadastrar</button>

      </fieldset>
    </form>
  </div>
  <!--container-->

  <!-- jQuery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <!-- Bootstrap JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>

</html>