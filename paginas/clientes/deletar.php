<?php
include('../../protect.php');
include('../../conexao.php');

// Garante que o ID seja um número inteiro para segurança adicional
$id = intval($_GET['id']);

if ($id <= 0) {
    header("Location: index.php");
    exit;
}

// Só executa a exclusão após o usuário clicar no botão "Sim, excluir" (via POST)
if(isset($_POST['confirmar'])){
    // Usamos o placeholder :id para preparar a query de forma segura
    $sql = "DELETE FROM clientes WHERE id = :id";

    try {
        $stmt = $pdo->prepare($sql);
        
        // Executa passando o ID mapeado
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
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Excluir Cliente</title>

<script src="https://cdn.tailwindcss.com"></script>

</head>
<body class="bg-zinc-950 text-white min-h-screen flex items-center justify-center">

<div class="bg-zinc-900 border border-zinc-800 rounded-xl p-8 w-full max-w-md">

    <h1 class="text-3xl font-bold text-red-500 mb-4">
        Excluir Cliente
    </h1>

    <p class="text-zinc-400 mb-6">
        Tem certeza que deseja excluir este cliente?
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
            class="bg-zinc-700 hover:bg-zinc-600 px-5 py-2 rounded-lg transition text-center flex items-center justify-center"
        >
            Cancelar
        </a>

    </form>

</div>

</body>
</html>