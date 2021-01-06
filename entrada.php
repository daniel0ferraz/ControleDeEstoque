<?php
session_start();
require 'config.php';
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
<html lang="pt-br">

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
<?php
           
            if (isset($_POST['CODIGO']) && empty($_POST['CODIGO']) == false) {

                $CODIGO = addslashes($_POST['CODIGO']);
                $DESCRICAO = addslashes($_POST['DESCRICAO']);
                $VALOR = addslashes($_POST['VALOR']);
                $OBS = addslashes($_POST['OBS']);
                $DATA = addslashes($_POST['DATA']);
                $QUANTIDADE = addslashes($_POST['QUANTIDADE']);
                $MOTIVO = addslashes($_POST['MOTIVO']);

                $sql = "INSERT INTO entrada SET CODIGO = '$CODIGO', DESCRICAO = '$DESCRICAO', VALOR = '$VALOR', OBS = '$OBS', DATA = NOW(), QUANTIDADE = '$QUANTIDADE', MOTIVO ='$MOTIVO'";
                $pdo->query($sql);

                header('Location: index.php');

                if ($MOTIVO == 'EMPRESTIMO') {
                  $sql = $pdo->prepare("UPDATE entrada SET QUANTIDADE = QUANTIDADE - :VAL_TOTAL WHERE id = :id "); 
                  $sql->bindValue(":MOTIVO", $MOTIVO);
                  $sql->bindValue(":CODIGO", $CODIGO);
                  $sql->execute();
              } 

            } 
            ?>

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
              <input type="text" class="form-control" name="VALOR">
            </div>

          </div>

          <div class="col-md-6">

            <div class="form-group">
              <label>Quantidade</label>
              <input type="number" name="QUANTIDADE" class="form-control">
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