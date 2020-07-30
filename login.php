<?php
session_start();
require "config.php";

if(isset($_POST['usuario']) && empty($_POST['usuario']) == false){
    $usuario = addslashes($_POST['usuario']);
    $senha = addslashes($_POST['senha']);

    $sql = $pdo->prepare("SELECT * FROM usuarios WHERE usuario = :usuario AND senha = :senha");

    $sql->bindValue(":usuario", $usuario);
    $sql->bindValue(":senha", md5($senha));
    $sql->execute();

    if($sql->rowCount() > 0){
        $sql = $sql->fetch();
        
        $_SESSION['estoque'] = $sql['id'];
        header("Location: index.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>

    <!-- Bootstrap CSS -->
    <link
      href="https://fonts.googleapis.com/css2?family=Roboto&family=Ubuntu:wght@300;700&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="../Estoque/bootstrap-3.4.1-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../Estoque/font-awesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="../Estoque/css/login.css">

    <!-- Fontes -->

    <link rel="stylesheet" href="Estoque/font-awesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="Estoque/font-awesome/css/solid.min.css">
    <link rel="stylesheet" href="Estoque/font-awesome/css/regular.min.css">
    <link rel="stylesheet" href="Estoque/font-awesome/css/svg-with-js.min.css">
    <link rel="stylesheet" href="Estoque/font-awesome/css/v4-shims.min.css">



</head>

<body>

        <form action="" method="post">
            <h1>Login</h1>

            <fieldset>
        
                <div class="form-group">
                    <label for="">Usuário</label>
                    <input type="text" name="usuario" class="form-control" required="required">
                </div>

                <div class="form-group">
                    <label for="">Senha</label>
                    <input type="password" name="senha" class="form-control" required="required">
                </div>
            </fieldset>

            <button type="submit">Entrar</button>
        </form>
    </div>


    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Bootstrap JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>

</html>