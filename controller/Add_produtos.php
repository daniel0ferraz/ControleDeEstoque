<?php
        
        if (isset($_POST['CODIGO']) && empty($_POST['CODIGO']) == null) {

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

