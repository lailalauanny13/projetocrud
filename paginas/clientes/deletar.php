<?php
include('../../protect.php');
include('../../conexao.php');

$id = intval($_GET['id']);

$sql = "DELETE FROM clientes WHERE id = '$id'";

if($mysqli->query($sql)) {
    header("Location: index.php");
    exit;
} else {
    echo "Erro ao deletar o cliente: " . $mysqli->error;
}
?>