<?php
session_start();
require 'config.php';

if (isset($_SESSION['estoque']) && empty($_SESSION['estoque']) == false) {
    $id = $_SESSION['estoque'];

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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Controle de Estoque</title>
    <!-- Bootstrap CSS -->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="../Estoque/css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"
        integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
    <link rel="stylesheet" href="bootstrap-3.4.1-dist/css/bootstrap.min.css">

    <link rel="stylesheet" href="font-awesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="font-awesome/css/solid.min.css">
    <link rel="stylesheet" href="font-awesome/css/regular.min.css">
    <link rel="stylesheet" href="font-awesome/css/svg-with-js.min.css">
    <link rel="stylesheet" href="font-awesome/css/v4-shims.min.css">

</head>

<body>

    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed navabar-left" data-toggle="collapse"
                    data-target="#barra-nav">
                    <span class="sr-only">
                        <i class="icon-bar"></i>
                        <i class="icon-bar"></i>
                        <i class="icon-bar"></i>
                    </span>
                    <!--Span-->
                </button>
                <!--Button-->

                <a href="#" class="navbar-brand">Estoque HCS</a>

            </div>
            <!--Navbar-header-->

            <div class="collapse navbar-collapse" id="barra-nav">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="sair.php">Sair</a></li>
                </ul>

            </div>
            <!--Collaose navbar-collapse-->
        </div>
        <!--container-fluid-->
    </nav>
    <!--Nav-->

    <!--Fim Barra de navegação-->

    <main>
        <div class="container-fluid">
            <div class="row">

                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                    <div class="list-group">
                        <a href="#" class="list-group-item active">Estoque</a>
                        <a href="entrada.php" class="list-group-item">Novo Produto</a>
                        <a href="editar.php" class="list-group-item">Editar Produto</a>
                        <a href="saida.php" class="list-group-item active">Saida</a>
                        <a href="#" class="list-group-item"></a>
                    </div>
                    <!--Listgroup-->
                </div>
                <!--Col-sm divsao sidbar/-->

                <!--Fim barra lateral itens-->

                <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                    <legend>Controle de Estoque</legend>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Consulta
                        </div>
                        <!--Panel Heading-->
                        <div class="">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Código</th>
                                        <th>Descrição</th>
                                        <th>Data</th>
                                        <th>Quantidade</th>
                                        <th>Valor</th>
                                        <th>Obs</th>
                                        <th>Motivo</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                          $sql = $pdo->prepare("SELECT * FROM entrada ");
                          $sql->execute();

                          if ($sql->rowCount() > 0) {
                            foreach ($sql->fetchAll() as $entrada) {
                                ?>
                                    <tr>
                                        <td><?php echo $entrada['CODIGO']; ?></td>
                                        <td><?php echo $entrada['DESCRICAO']; ?></td>
                                        <td><?php echo date('d/m/Y H:i', strtotime($entrada['DATA']));?></td>
                                        <td><?php echo $entrada['QUANTIDADE']; ?></td>
                                        <td><?php echo $entrada['VALOR']; ?></td>
                                        <td><?php echo $entrada['OBS'] ?></td>
                                        <td><?php echo $entrada['MOTIVO']; ?></td>
                                        <td>
                                            <?php echo '<a class="btn btn-success "href="editar.php?id='.$entrada['CODIGO'] ;?>'"><i
                                                class="far fa-edit"></i></a>
                                            <?php echo '<a class="btn btn-danger "href="deletar.php?id='.$entrada['CODIGO'] ;?>'"><i
                                                class="far fa-trash-alt"></i></a>
                                        </td>
                                    </tr>
                                    <?php
                              }
                            }
                        ?>
                                </tbody>
                            </table>
                        </div>
                        <!--Table-responsive-->
                    </div>
                    <!--Panel-->
                </div>
                <!--Col-md-9-->


            </div>
            <!--row-->
        </div>
        <!--Container-fluid-->
    </main>

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Bootstrap JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>

</html>