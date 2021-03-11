<?php
session_start();
require 'controller/config.php';
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

    if (isset($_GET['CODIGO']) && empty ($_GET['CODIGO'] == FALSE)) {

        $CODIGO = addslashes($_POST['CODIGO']);
        $DESCRICAO = addslashes($_POST['DESCRICAO']);
        $VALOR = addslashes($_POST['VALOR']);
        $OBS = addslashes($_POST['OBS']);
        $DATA = addslashes($_POST['DATA']);
        $QUANTIDADE = addslashes($_POST['QUANTIDADE']);
        $MOTIVO = addslashes($_POST['MOTIVO']);

        $sql = $pdo->prepare("SELECT * FROM entrada where id = : id");
        // $sql->bindValue(":CODIGO", $CODIGO);
        // $sql->bindValue(":DESCRICAO", $DESCRICAO);
        // $sql->bindValue(":QUANTIDADE", $QUANTIDADE);
        // $sql->bindValue(":VALOR", $VALOR);
        // $sql->bindValue(":OBS", $OBS);
        // $sql->bindValue(":MOTIVO", $MOTIVO);
        // $sql->execute();
        $sql = $pdo->query($sql);
        if ($sql->rowCount() > 0) {
            $dados = $sql->fetchAll();
        }
    }
    ?>

    <body>
        <div class="container">

            <div class="page-header">
                <h1>Saida</h1>
            </div>

            <ol class="breadcrumb">
                <li>
                    <a href="#" class="active">Saida</a>
                </li>
                <li>
                    <a href="index.php">Voltar</a>
                </li>
            </ol>

        </div>
        <section class="formulario">
            <div class="container">
                <div class="container">

                    <form class="form" method="POST">
                        <h1>Atualizar produto do estoque</h1>

                        <ol class="breadcrumb">
                            <li>
                                <a href="index.php">Voltar</a>
                            </li>
                            <li class="active">Editar</li>
                        </ol>

                        <fieldset>
                            <legend>
                                <h2>Dados</h2>
                            </legend>

                            <div class="row">
                                <div class="col-md-6">

                                    <div class="form-group">
                                        <label>Código</label>
                                        <input
                                            class="form-control"
                                            type="text"
                                            name="CODIGO"
                                            value="<?php echo $dados['CODIGO']; ?>">
                                    </div>

                                    <div class="form-group">
                                        <label>Descricão</label>
                                        <input
                                            type="text"
                                            name="DESCRICAO"
                                            class="form-control"
                                            value="<?php echo $dados['DESCRICAO']; ?>">
                                    </div>

                                    <div class="form-group">
                                        <label>valor</label>
                                        <input
                                            type="number"
                                            class="form-control"
                                            name="VALOR"
                                            value="<?php echo $dados['VALOR']; ?>">
                                    </div>

                                </div>

                                <div class="col-md-6">

                                    <!-- <div class="form-group"> <label>Data</label> <input type="date" name="DATA"
                                    class="form-control" value="<?php echo $dado['DATA']; ?>"> </div> -->
                                    <div class="form-group">
                                        <label>Quantidade</label>
                                        <input
                                            type="number"
                                            name="QUANTIDADE"
                                            class="form-control"
                                            value="<?php echo $dado['QUANTIDADE']; ?>">
                                    </div>

                                    <div class="form-group">
                                        <label>Motivo</label>
                                        <select name="MOTIVO" class="form-control">
                                            <option value="<?php echo $dados['MOTIVO']; ?>"><?php echo $dados['MOTIVO']; ?>
                                            </option>
                                            <option value="ESPECIFICAR">ESPECIFICAR</option>
                                            <option value="CHAMADO">CHAMADO</option>
                                            <option value="DEVOLUCAO">DEVOLUCAO</option>
                                            <option value="EMPRESTIMO">EMPRESTIMO</option>
                                            <option value="NOTA FISCAL">NOTA FISCAL</option>
                                            <option value="TRANSFERENCIA">TRANSFERENCIA</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Observacão</label>
                                        <textarea name="OBS" rows="2" class="form-control">
                                            <?php echo $dados['OBS']; ?></textarea>
                                    </div>

                                    <button type="submit" class="btn btn-block btn-success">Atualizar</button>
                                </fieldset>
                            </form>
                            <!--formulario-->
                        </div>
                        <!--container-->
                    </section>
                    <!--formulario-->
                    <!-- jQuery -->
                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
                    <!-- Bootstrap JavaScript -->
                    <script
                        src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
                </body>

            </html>