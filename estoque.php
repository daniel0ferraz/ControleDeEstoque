<?php
session_start();
// header("refresh: 0.2");
require 'controller/config.php';
?>

<!DOCTYPE html>
<html lang="pt_br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualizar estoque</title>
    <!-- Bootstrap CSS -->
    <!-- Latest compiled and minified CSS -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto&family=Ubuntu:wght@300;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="bootstrap-3.4.1-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="font-awesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="font-awesome/css/solid.min.css">
    <link rel="stylesheet" href="font-awesome/css/regular.min.css">
    <link rel="stylesheet" href="font-awesome/css/svg-with-js.min.css">
    <link rel="stylesheet" href="font-awesome/css/v4-shims.min.css">
    <link rel="stylesheet" href="css/home.css">
    <style>
        .container header {
            margin-top: 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
    </style>
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
          <li><a href="index.php"><i class="fa fa-arrow-left"></i> Voltar</a></li>
          <li><a href="sair.php"><i class="fas fa-sign-out-alt"></i> Sair</a></li>
        </ul>

      </div>
      <!--Collaose navbar-collapse-->
    </div>
    <!--container-fluid-->
  </nav>
  <!--Nav-->
<section class="">
 <div class="container">
<br>
<br>
   <fieldset>
   <h2>Meu estoque</h2>
   </fieldset>

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
                    <th>Valor Total</th>
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
                    <td><?php echo $entrada['VAL_TOTAL'];?></td>
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


</section>
</body>

</html>