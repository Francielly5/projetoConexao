<?php

require "../conexao.php";
$id=$_GET["id"];
try{
$sql = "DELETE FROM usuarios WHERE id=:id";
$stmt = $pdo->prepare($sql);
$stmt->execute([":id" => $id]);
header("Location:listar.php");
}catch(PDOException $e){
    echo "Erro ao excluir:".$e->getMessage();
}