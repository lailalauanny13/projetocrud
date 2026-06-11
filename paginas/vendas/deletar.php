<?php
include('../../protect.php');
include('../../conexao.php');

// Garante que o ID seja um número inteiro para segurança adicional
$id = intval($_GET['id']);

if ($id > 0) {
    // Usamos o placeholder :id para preparar a query de forma segura
    $sql = "DELETE FROM vendas WHERE id = :id";

    try {
        $stmt = $pdo->prepare($sql);
        
        // Executa passando o ID mapeado
        $executou = $stmt->execute([':id' => $id]);

        if($executou) {
            header("Location: index.php");
            exit;
        } else {
            echo "Erro ao estornar venda.";
        }
    } catch (PDOException $e) {
        die("Erro ao estornar venda: " . $e->getMessage());
    }
} else {
    header("Location: index.php");
    exit;
}
?>