<?php
$host = "db"; 
$usuario = "root";
$senha = "root";
$banco = "login"; 

// Aqui mudamos o nome da variável para $mysqli para bater com o seu index.php
$mysqli = new mysqli($host, $usuario, $senha, $banco);

// Código opcional para checar se deu erro (ajuda a monitorar se a linha 10 reclamar)
if ($mysqli->connect_error) {
    die("Falha na conexão: " . $mysqli->connect_error);
}
?>