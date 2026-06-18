<?php

include(__DIR__ . '/../../conexao.php');
include(__DIR__ . '/../../protect.php');


if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = intval($_GET['id']);

try {
    
    $sql_buscar = "SELECT * FROM produtos WHERE id = :id";
    $stmt_buscar = $pdo->prepare($sql_buscar);
    $stmt_buscar->execute([':id' => $id]);
    $produto = $stmt_buscar->fetch(PDO::FETCH_ASSOC);

    if (!$produto) {
    
        header("Location: index.php");
        exit;
    }
} catch (PDOException $e) {
    die("Falha na execução do código SQL: " . $e->getMessage());
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $nome = $_POST['nome'];
    $preco = $_POST['preco'];

    try {
        
        $sql_update = "UPDATE produtos SET nome = :nome, preco = :preco WHERE id = :id";
        $stmt_update = $pdo->prepare($sql_update);
        
        $update = $stmt_update->execute([
            ':nome'  => $nome,
            ':preco' => $preco,
            ':id'    => $id
        ]);
        
        if ($update) {
    
            header("Location: index.php");
            exit;
        } else {
            echo "<script>alert('Erro ao atualizar produto.');</script>";
        }
    } catch (PDOException $e) {
        echo "<script>alert('Erro ao atualizar produto: " . addslashes($e->getMessage()) . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Produto - LarpintMax</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-zinc-950 text-zinc-100 min-h-screen">

<div class="max-w-2xl mx-auto p-8">

    <div class="bg-zinc-900 border border-zinc-800 rounded-xl p-8">

        <h1 class="text-3xl font-bold mb-6 text-red-500">
            Editar Produto
        </h1>

        <form action="" method="POST" class="space-y-5">

            <div>
                <label class="block mb-2 text-zinc-300">
                    Nome do Produto
                </label>

                <input
                    type="text"
                    name="nome"
                    value="<?php echo htmlspecialchars($produto['nome']); ?>"
                    required
                    class="w-full bg-zinc-800 border border-zinc-700 rounded-lg p-3 focus:outline-none focus:border-red-500 text-zinc-100"
                >
            </div>

            <div>
                <label class="block mb-2 text-zinc-300">
                    Preço (R$)
                </label>

                <input
                    type="text"
                    name="preco"
                    value="<?php echo htmlspecialchars($produto['preco']); ?>"
                    required
                    class="w-full bg-zinc-800 border border-zinc-700 rounded-lg p-3 focus:outline-none focus:border-red-500 text-zinc-100"
                >
            </div>

            <div class="flex gap-3">

                <button
                    type="submit"
                    class="bg-red-600 hover:bg-red-700 px-6 py-3 rounded-lg font-semibold transition"
                >
                    Salvar Alterações
                </button>

                <a
                    href="index.php"
                    class="bg-zinc-700 hover:bg-zinc-600 px-6 py-3 rounded-lg transition text-center"
                >
                    Cancelar
                </a>

            </div>

        </form>

    </div>

</div>

</body>
</html>