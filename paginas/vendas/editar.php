<?php
include(__DIR__ . '/../../protect.php');
include(__DIR__ . '/../../conexao.php');

// 1. Verifica se o ID foi passado na URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = intval($_GET['id']);

// 2. Busca o registro atual da venda
$sql_buscar = "SELECT * FROM vendas WHERE id = '$id'";
$query_buscar = $mysqli->query($sql_buscar) or die($mysqli->error);
$venda = $query_buscar->fetch_assoc();

if(!$venda) {
    header("Location: index.php");
    exit;
}

// 3. Carrega as listas para as caixas de seleção (Selects)
$query_clientes = $mysqli->query("SELECT id, nome FROM clientes ORDER BY nome ASC");
$query_produtos = $mysqli->query("SELECT id, nome, preco FROM produtos ORDER BY nome ASC");

// 4. Processa o salvamento das alterações
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cliente_id = intval($_POST['cliente_id']);
    $produto_id = intval($_POST['produto_id']);
    $quantidade = intval($_POST['quantidade']);

    if($cliente_id == 0 || $produto_id == 0 || $quantidade <= 0) {
        echo "<script>alert('Preencha todos os campos corretamente!');</script>";
    } else {
        // Busca o preço do produto atualizado para recalcular o total da venda
        $query_preco = $mysqli->query("SELECT preco FROM produtos WHERE id = '$produto_id'");
        if($query_preco && $query_preco->num_rows > 0) {
            $prod = $query_preco->fetch_assoc();
            $preco = $prod['preco'];
            
            // Calcula o novo valor total
            $total = $quantidade * $preco;

            // Faz o UPDATE atualizando cliente, produto, quantidade e o valor total
            $sql_update = "UPDATE vendas SET cliente_id = '$cliente_id', produto_id = '$produto_id', quantidade = '$quantidade', total = '$total' WHERE id = '$id'";
            
            if($mysqli->query($sql_update)) {
                header("Location: index.php");
                exit;
            } else {
                echo "<script>alert('Erro ao atualizar registro: " . $mysqli->error . "');</script>";
            }
        } else {
            echo "<script>alert('Produto selecionado não encontrado!');</script>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Venda - LarpintMax</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-zinc-950 text-zinc-100 min-h-screen">

<div class="max-w-2xl mx-auto p-8">

    <div class="bg-zinc-900 border border-zinc-800 rounded-xl p-8">

        <h1 class="text-3xl font-bold mb-6 text-red-500">
            Editar Venda
        </h1>

        <form action="" method="POST" class="space-y-5">

            <div>
                <label class="block mb-2 text-zinc-300">
                    Selecione o Cliente
                </label>
                <select name="cliente_id" required class="w-full bg-zinc-800 border border-zinc-700 rounded-lg p-3 focus:outline-none focus:border-red-500 text-zinc-100">
                    <?php while($c = $query_clientes->fetch_assoc()) { 
                        $selected = ($c['id'] == $venda['cliente_id']) ? 'selected' : '';
                    ?>
                        <option value="<?php echo $c['id']; ?>" <?php echo $selected; ?>>
                            <?php echo htmlspecialchars($c['nome']); ?>
                        </option>
                    <?php } ?>
                </select>
            </div>

            <div>
                <label class="block mb-2 text-zinc-300">
                    Selecione o Produto
                </label>
                <select name="produto_id" required class="w-full bg-zinc-800 border border-zinc-700 rounded-lg p-3 focus:outline-none focus:border-red-500 text-zinc-100">
                    <?php while($p = $query_produtos->fetch_assoc()) { 
                        $selected = ($p['id'] == $venda['produto_id']) ? 'selected' : '';
                    ?>
                        <option value="<?php echo $p['id']; ?>" <?php echo $selected; ?>>
                            <?php echo htmlspecialchars($p['nome']); ?> (R$ <?php echo number_format($p['preco'], 2, ',', '.'); ?>)
                        </option>
                    <?php } ?>
                </select>
            </div>

            <div>
                <label class="block mb-2 text-zinc-300">
                    Quantidade
                </label>
                <input
                    type="number"
                    name="quantidade"
                    min="1"
                    value="<?php echo $venda['quantidade']; ?>"
                    required
                    class="w-full bg-zinc-800 border border-zinc-700 rounded-lg p-3 focus:outline-none focus:border-red-500 text-zinc-100"
                >
            </div>

            <div class="flex gap-3 pt-2">

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