<?php
session_start();
require 'config.php';
require 'contador.php';
// header("refresh: 0.1");

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
  <link href="https://fonts.googleapis.com/css2?family=Roboto&family=Ubuntu:wght@300;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="bootstrap-3.4.1-dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="font-awesome/css/fontawesome.min.css">
  <link rel="stylesheet" href="font-awesome/css/solid.min.css">
  <link rel="stylesheet" href="font-awesome/css/regular.min.css">
  <link rel="stylesheet" href="font-awesome/css/svg-with-js.min.css">
  <link rel="stylesheet" href="font-awesome/css/v4-shims.min.css">
  <link rel="stylesheet" href="css/home.css">

</head>

<body>

  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed navabar-left" data-toggle="collapse"
          data-target="#barra-nav">
          <span class="sr-only">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </span>
          <!--Span-->
        </button>
        <!--Button-->

        <a href="#" class="navbar-brand">
          <img src="img/svg/003-inventario.svg" class="img-responsive img-logo" alt="Image">
          Controle de Estoque
        </a>

      </div>
      <!--Navbar-header-->

      <div class="collapse navbar-collapse" id="barra-nav">
        <ul class="nav navbar-nav navbar-right">
          <li><a href="sair.php"><i class="fas fa-sign-out-alt"></i>Sair</a></li>
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

        <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
          <div class="list-group">

            <a href="#" class="list-group-item active">
              <i class="fas fa-boxes"></i> Estoque</a>
            <a href="entrada.php" class="list-group-item">
              <i class="fas fa-dolly"></i> Novo Produto</a>
            <a href="Saldo.php" class="list-group-item"><i class="fas fa-clipboard-list"></i>
              Atualizar Estoque</a>
            <a href="#" class="list-group-item">Saida</a>
            <a href="#" class="list-group-item"></a>

          </div>
        </div>
        <!--Listgroup-->

        <!--Col-sm divsao sidbar/-->

        <!--Fim barra lateral itens-->

        <div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">

          <div class="box-titulo">
            <h2></i>Controle de Estoque</h2>
          </div>

          <div class="row">
          <div class="col-sm-3 col-xs-3">
            <div class="well">
              <i class="fa fa-money" aria-hidden="true"></i>
              <h4>Saldo</h4>
              <?php echo $saldo['saldo'];?> </div>
          </div>
          <div class="col-sm-3 col-xs-3">
            <div class="well">
            <i class="fas fa-clipboard-list"></i>
              <h4>Itens estoque</h4>
              <?php echo $itens_estoque['itens'];?></div>
          </div>
        </div>

          <div class="panel panel-default">
            <div class="panel-heading">
              <i class="fas fa-clipboard-list"></i> Movimentações
            </div>
            <!--Panel Heading-->
            <div class="table-responsive">
              <table class="table table-striped table-condensed">
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
                          $sql = ("SELECT * FROM entrada ORDER BY CODIGO DESC");
                          $sql = $pdo->query($sql);

                          if ($sql->rowCount() > 0) {
                            foreach ($sql->fetchAll() as $entrada) {
                                ?>
                  <tr>
                    <td><?php echo $entrada['CODIGO']; ?></td>
                    <td><?php echo $entrada['DESCRICAO']; ?></td>
                    <td><?php echo date('d/m/Y', strtotime($entrada['DATA']));?></td>
                    <td><?php echo $entrada['QUANTIDADE']; ?></td>
                    <td><?php echo $entrada['VALOR']; ?></td>
                    <td><?php echo $entrada['OBS'] ?></td>
                    <td><?php echo $entrada['MOTIVO']; ?></td>
                    <td>
                      <?php echo '<a class="btn btn-default"href="editar.php?CODIGO='.$entrada['CODIGO'] ;?>'"><i
                        class="far fa-edit"></i></a>
                      <?php echo '<a class="btn btn-default "href="deletar.php?CODIGO='.$entrada['CODIGO'] ;?>'"><i
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