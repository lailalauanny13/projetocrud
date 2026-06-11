<?php
include('../../protect.php');
include('../../conexao.php');

// Garante que o ID seja um número inteiro para maior segurança
$id = intval($_GET['id']);

if ($id > 0) {
    // Usamos o placeholder :id para preparar a query de forma segura
    $sql = "DELETE FROM clientes WHERE id = :id";

    try {
        $stmt = $pdo->prepare($sql);
        
        // Executa passando o ID mapeado de forma isolada
        $executou = $stmt->execute([':id' => $id]);

        if($executou) {
            header("Location: index.php");
            exit;
        } else {
            echo "Erro ao deletar o cliente.";
        }
    } catch (PDOException $e) {
        // Caso o cliente esteja vinculado a uma venda (Chave Estrangeira), o PDO captura o erro aqui
        die("Erro ao deletar o cliente: " . $e->getMessage());
    }
} else {
    header("Location: index.php");
    exit;
}
?>