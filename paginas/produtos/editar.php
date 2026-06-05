<?php
// 1. Inclui a conexão voltando duas pastas para achar a raiz do projeto
include(__DIR__ . '/../../conexao.php');
include(__DIR__ . '/../../protect.php');

// 2. Verifica se o ID do produto foi passado na URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = intval($_GET['id']);

// 3. Busca os dados atuais do produto para preencher os inputs do HTML
$query = $mysqli->query("SELECT * FROM produtos WHERE id = '$id'");

if ($query && $query->num_rows > 0) {
    $produto = $query->fetch_assoc();
} else {
    // Se o produto não existir no banco, volta para a listagem
    header("Location: index.php");
    exit;
}

// 4. Processa o formulário quando o usuário clica em "Salvar Alterações"
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $mysqli->real_escape_string($_POST['nome']);
    $preco = $mysqli->real_escape_string($_POST['preco']);

    // Atualiza os dados no banco de dados
    $update = $mysqli->query("UPDATE produtos SET nome = '$nome', preco = '$preco' WHERE id = '$id'");
    
    if ($update) {
        // Redireciona de volta para a lista de produtos após salvar
        header("Location: index.php");
        exit;
    } else {
        echo "<script>alert('Erro ao atualizar produto: " . $mysqli->error . "');</script>";
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
                    class="w-full bg-zinc-800 border border-zinc-700 rounded-lg p-3 focus:outline-none focus:border-red-500"
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
                    class="w-full bg-zinc-800 border border-zinc-700 rounded-lg p-3 focus:outline-none focus:border-red-500"
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
                    class="bg-zinc-700 hover:bg-zinc-600 px-6 py-3 rounded-lg transition"
                >
                    Cancelar
                </a>

            </div>

        </form>

    </div>

</div>

</body>
</html>