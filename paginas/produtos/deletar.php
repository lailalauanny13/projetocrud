<?php
include('../../protect.php'); // Protege a página contra acessos diretos
include('../../conexao.php'); // Carrega a conexão com o banco de dados

// Garante que o ID recebido seja um número inteiro
$id = intval($_GET['id']);

if(isset($_POST['confirmar'])){

    // Usamos o placeholder :id para preparar a query com total segurança
    $sql = "DELETE FROM produtos WHERE id = :id";

    try {
        $stmt = $pdo->prepare($sql);
        
        // Executa a query passando o ID mapeado
        $executou = $stmt->execute([':id' => $id]);

        if($executou){
            header("Location: index.php");
            exit;
        }
    } catch (PDOException $e) {
        // Caso aconteça algum erro (como o produto estar amarrado a uma venda existente)
        die("Erro ao excluir produto: " . $e->getMessage());
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Excluir Produto</title>

<script src="https://cdn.tailwindcss.com"></script>

</head>
<body class="bg-zinc-950 text-white min-h-screen flex items-center justify-center">

<div class="bg-zinc-900 border border-zinc-800 rounded-xl p-8 w-full max-w-md">

    <h1 class="text-3xl font-bold text-red-500 mb-4">
        Excluir Produto
    </h1>

    <p class="text-zinc-400 mb-6">
        Tem certeza que deseja excluir este produto?
    </p>

    <form method="POST" class="flex gap-3">

        <button
            type="submit"
            name="confirmar"
            class="bg-red-600 hover:bg-red-700 px-5 py-2 rounded-lg transition"
        >
            Sim, excluir
        </button>

        <a
            href="index.php"
            class="bg-zinc-700 hover:bg-zinc-600 px-5 py-2 rounded-lg transition text-center"
        >
            Cancelar
        </a>

    </form>

</div>

</body>
</html>