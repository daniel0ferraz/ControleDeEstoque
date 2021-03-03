<?php
session_start();
require 'controller/config.php';

if(isset($_SESSION['estoque'])) {
    $id = addslashes($_SESSION['estoque']);

    $sql = $pdo->prepare("SELECT * FROM usuarios WHERE id = '$id'");
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
    </head>
    <?php
    if (isset($_POST['CODIGO'])) {
    $CODIGO = addslashes($_POST['CODIGO']);
    $DESCRICAO = addslashes($_POST['DESCRICAO']);
    $VALOR = addslashes($_POST['VALOR']);
    $OBS = addslashes($_POST['OBS']);
    $DATA = addslashes($_POST['DATA']);
    $QUANTIDADE = addslashes($_POST['QUANTIDADE']);
    $MOTIVO = addslashes($_POST['MOTIVO']);
    $sql = $pdo->prepare("INSERT INTO saida (CODIGO, DESCRICAO, VALOR, OBS, DATA, QUANTIDADE, MOTIVO) VALUES (:CODIGO, :DESCRICAO, :VALOR, :OBS, NOW(), :QUANTIDADE, :MOTIVO");
    $sql->bindValue(":CODIGO", $CODIGO);
    $sql->bindValue(":DESCRICAO", $DESCRICAO);
    $sql->bindValue(":QUANTIDADE", $QUANTIDADE);
    $sql->bindValue(":VALOR", $VALOR);
    $sql->bindValue(":OBS", $OBS);
    $sql->bindValue(":MOTIVO", $MOTIVO);
    $sql->execute();
    if ($MOTIVO == 'DEVOLUCAO') {
    $sql = $pdo->prepare("UPDATE entrada SET QUANTIDADE = QUANTIDADE + :VALOR WHERE CODIGO = :CODIGO ");
    $sql->bindValue(":QUANTIDADE", $QUANTIDADE);
    $sql->bindValue(":CODIGO", $CODIGO);
    $sql->execute();
    } else {
    $sql = $pdo->prepare("UPDATE entrada SET QUANTIDADE = QUANTIDADE - :VALOR WHERE CODIGO = :CODIGO ");
    $sql->bindValue(":QUANTIDADE", $QUANTIDADE);
    $sql->bindValue(":CODIGO", $CODIGO);
    $sql->execute();
    }
    header('Location: index.php');
    exit;
    }
    ?>
    <body>
        <div class="container">
            
            <div class="page-header">
                <h1>Saida</h1>
            </div>

            <ol class="breadcrumb">
               <li><a href="#" class="active">Saida</a></li>
               <li><a href="index.php">Voltar</a></li>
            </ol>
            
        </div>
        <section class="formulario">
            <div class="container">
                <form class="form" method="POST">
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Código</label>
                                <input class="form-control" type="text" name="CODIGO">
                            </div>
                            <div class="form-group">
                                <label>Descricao</label>
                                <input type="text" name ="DESCRICAO" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>valor</label>
                                <input type="number" class="form-control" name="VALOR">
                            </div>
                            <div class="form-group">
                                <label>Observacão</label>
                                <textarea class="form-control" name="OBS" rows="2"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Data</label>
                                <input type="date" name="DATA" class="form-control" >
                            </div>
                            <div class="form-group">
                                <label>Quantidade</label>
                                <input type="number"  name="QUANTIDADE" class="form-control">
                            </div>
                            
                            <div class="form-group">
                                <label>Motivo</label>
                                <select name="MOTIVO" class="form-control">
                                    <option value="">Selecione</option>
                                    <option value="ESPECIFICAR">ESPECIFICAR</option>
                                    <option value="CHAMADO">CHAMADO</option>
                                    <option value="DEVOLUCAO">DEVOLUCAO</option>
                                    <option value="EMPRESTIMO">EMPRESTIMO</option>
                                    <option value="NOTA FISCAL">NOTA FISCAL</option>
                                    <option value="TRANSFERENCIA">TRANSFERENCIA</option>
                                </select>
                            </div>
                            <div class="box-button">
                                <div class="col-xs-6 ">
                                    <button type="submit" value="cadastrar" class="btn btn-block btn-success">Salvar</button>
                                </div>
                                <div class="col-xs-6">
                                    <button type="reset" class="btn btn-block btn-danger">Cancelar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!--container-->
                </section>
                <!--formulario-->
                <!-- jQuery -->
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
                <!-- Bootstrap JavaScript -->
                <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
            </body>
        </html>