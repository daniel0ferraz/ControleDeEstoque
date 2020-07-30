<?php
require 'config.php';

if (isset($_GET['CODIGO']) && empty($_GET['CODIGO']) == false) {
    $CODIGO = addslashes($_GET['CODIGO']);

    $sql = "DELETE FROM entrada WHERE CODIGO = '$CODIGO'";
    $pdo->query($sql);

    header("Location: index.php");
    exit;

} else {
    header("Location: index.php");
    exit;
}
