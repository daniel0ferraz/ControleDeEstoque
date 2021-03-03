<?php
require 'controller/config.php';
// SALDO TOTAL DO ESTOQUE 
$sql = "SELECT SUM(VAL_TOTAL) AS saldo FROM entrada";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$saldo = $stmt->fetch(PDO::FETCH_ASSOC);

// QUANTIDADE DE ITENS DO ESTOQUE 
$sql = "SELECT sum(QUANTIDADE) AS itens FROM entrada";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$itens_estoque = $stmt->fetch();

?>