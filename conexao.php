<?php
$host = "db"; 
$usuario = "root";
$senha = "root";
$banco = "login"; 

// Aqui mudamos o nome da variável para $mysqli para bater com o seu index.php
$pdo = new PDO("mysql:host=$host;dbname=$banco", $usuario, $senha);

// Código opcional para checar se deu erro (ajuda a monitorar se a linha 10 reclamar)
if ($pdo->connect_error) {
    die("Falha na conexão: " . $pdo->connect_error);
}
?>