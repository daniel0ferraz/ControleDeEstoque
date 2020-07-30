<?php

$id = 0;
if(isset($_GET['id']) && empty($_GET['id']) == false) {
    $id = addslashes($_GET['id']);
}

if(isset($_POST['titulo']) && empty ($_POST['titulo']) == false){
	$titulo = addslashes($_POST['titulo']);
    $autor = addslashes($_POST['autor']);
	$corpo = addslashes($_POST['corpo']);
	
    $sql = "UPDATE posts SET titulo = '$titulo', data_criado = NOW(), autor = '$autor', corpo = '$corpo' WHERE id = '$id'";
    
	$pdo->query($sql);
	header("Location: index.php");
}

$sql = "SELECT * FROM posts WHERE id = '$id'";
$sql = $pdo->query($sql);

if($sql->rowCount() > 0) {
	$posts = $sql->fetch();
} else {
header("Location: index.php");
}
?>