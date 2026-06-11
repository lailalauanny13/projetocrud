<?php
include('../../protect.php');
include('../../conexao.php');

try {
    // Busca todos os clientes e produtos para colocar nas caixas de seleção do formulário
    $query_clientes = $pdo->query("SELECT id, nome FROM clientes ORDER BY nome ASC");
    $clientes = $query_clientes->fetchAll(PDO::FETCH_ASSOC);

    $query_produtos = $pdo->query("SELECT id, nome, preco FROM produtos ORDER BY nome ASC");
    $produtos = $query_produtos->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Falha ao carregar dados do formulário: " . $e->getMessage());
}

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cliente_id = intval($_POST['cliente_id']);
    $produto_id = intval($_POST['produto_id']);
    $quantidade = intval($_POST['quantidade']);

    if($cliente_id == 0 || $produto_id == 0 || $quantidade <= 0) {
        echo "<script>alert('Preencha todos os campos corretamente!');</script>";
    } else {
        try {
            // 1. Buscamos o preço do produto selecionado de forma segura usando Prepared Statement
            $sql_preco = "SELECT preco FROM produtos WHERE id = :produto_id";
            $stmt_preco = $pdo->prepare($sql_preco);
            $stmt_preco->execute([':produto_id' => $produto_id]);
            $produto = $stmt_preco->fetch(PDO::FETCH_ASSOC);
            
            if($produto) {
                $preco = $produto['preco'];

                // 2. Calculamos o total multiplicando a quantidade pelo preço
                $total = $quantidade * $preco;

                // 3. Query de INSERT utilizando placeholders do PDO
                $sql_insert = "INSERT INTO vendas (cliente_id, produto_id, quantidade, total) 
                               VALUES (:cliente_id, :produto_id, :quantidade, :total)";
                
                $stmt_insert = $pdo->prepare($sql_insert);
                $executou = $stmt_insert->execute([
                    ':cliente_id' => $cliente_id,
                    ':produto_id' => $produto_id,
                    ':quantidade' => $quantidade,
                    ':total'      => $total
                ]);
                
                if($executou) {
                    header("Location: index.php");
                    exit;
                } else {
                    echo "Erro ao registrar venda.";
                }
            } else {
                echo "<script>alert('Produto não encontrado!');</script>";
            }
        } catch (PDOException $e) {
            echo "Erro no banco de dados: " . $e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Larpintmax - Nova Venda</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-zinc-950 text-zinc-100 min-h-screen font-sans">

    <header class="bg-zinc-900 border-b border-zinc-800 shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
            <span class="text-2xl font-black tracking-wider text-white">LARPINT<span class="text-red-600">MAX</span></span>
            <a href="index.php" class="text-sm font-semibold text-zinc-400 hover:text-white transition-colors">&larr; Voltar para a Lista</a>
        </div>
    </header>

    <main class="max-w-xl mx-auto mt-12 p-4">
        <div class="bg-zinc-900 border border-zinc-800 p-8 rounded-2xl shadow-xl">
            <div class="mb-6">
                <h1 class="text-2xl font-bold text-white tracking-tight">Nova Venda</h1>
                <p class="text-zinc-400 text-sm mt-1">Registre um novo pedido de venda efetuado.</p>
            </div>

            <form action="" method="POST" class="space-y-6">
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-zinc-400 mb-2">Selecione o Cliente</label>
                    <select name="cliente_id" required class="w-full bg-zinc-950 border border-zinc-800 rounded-lg px-4 py-3 text-zinc-100 focus:outline-none focus:border-red-600 focus:ring-1 focus:ring-red-600 transition-colors">
                        <option value="">-- Escolha um Cliente --</option>
                        <?php 
                        // Alterado de while para foreach usando a lista guardada na memória
                        foreach($clientes as $c) { 
                        ?>
                            <option value="<?php echo $c['id']; ?>"><?php echo htmlspecialchars($c['nome']); ?></option>
                        <?php } ?>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-zinc-400 mb-2">Selecione o Produto</label>
                    <select name="produto_id" required class="w-full bg-zinc-950 border border-zinc-800 rounded-lg px-4 py-3 text-zinc-100 focus:outline-none focus:border-red-600 focus:ring-1 focus:ring-red-600 transition-colors">
                        <option value="">-- Escolha um Produto --</option>
                        <?php 
                        // Alterado de while para foreach usando a lista guardada na memória
                        foreach($produtos as $p) { 
                        ?>
                            <option value="<?php echo $p['id']; ?>"><?php echo htmlspecialchars($p['nome']); ?> (R$ <?php echo number_format($p['preco'], 2, ',', '.'); ?>)</option>
                        <?php } ?>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-zinc-400 mb-2">Quantidade Solicitada</label>
                    <input type="number" name="quantidade" min="1" value="1" required class="w-full bg-zinc-950 border border-zinc-800 rounded-lg px-4 py-3 text-zinc-100 focus:outline-none focus:border-red-600 focus:ring-1 focus:ring-red-600 transition-colors">
                </div>

                <div class="flex items-center justify-end gap-4 pt-2">
                    <a href="index.php" class="text-sm font-semibold text-zinc-400 hover:text-white transition-colors px-4 py-2.5">Cancelar</a>
                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-semibold px-6 py-2.5 rounded-lg text-sm transition-colors shadow-md shadow-red-900/20">Lançar Venda</button>
                </div>
            </form>
        </div>
    </main>

</body>
</html>