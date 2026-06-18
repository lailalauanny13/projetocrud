<?php
include('../../protect.php'); 
include('../../conexao.php'); 


$sql = "SELECT * FROM produtos";

try {
    
    $query = $pdo->query($sql);
    
    
    $produtos = $query->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Falha na execução do código SQL: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <link rel="shortcut icon" type="image/x-icon" href="icon.ico">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Larpintmax - Módulo de Produtos</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-zinc-950 text-zinc-100 min-h-screen">

<div class="max-w-7xl mx-auto p-8">

    <div class="flex justify-between items-center mb-8">

        <div>
            <h1 class="text-4xl font-bold text-white">
                Módulo de Produtos
            </h1>

            <p class="text-zinc-400 mt-1">
                Gerencie seus produtos cadastrados
            </p>
        </div>

        <div class="flex gap-3">

            <a
                href="../../painel.php"
                class="bg-zinc-800 border border-zinc-700 hover:bg-zinc-700 px-4 py-2 rounded-lg transition text-sm font-medium"
            >
                Painel
            </a>

            <a
                href="criar.php"
                class="bg-red-600 hover:bg-red-700 px-4 py-2 rounded-lg transition text-sm font-medium shadow-md shadow-red-900/20"
            >
                Novo Produto
            </a>

        </div>

    </div>

    <div class="bg-zinc-900 border border-zinc-800 rounded-xl overflow-hidden shadow-xl">

        <table class="w-full text-left border-collapse">

            <thead class="bg-zinc-950 border-b border-zinc-800 text-xs font-bold uppercase tracking-wider text-zinc-400">

                <tr>
                    <th class="p-4">ID</th>
                    <th class="p-4">Nome</th>
                    <th class="p-4">Preço</th>
                    <th class="p-4">Ações</th>
                </tr>

            </thead>

            <tbody class="divide-y divide-zinc-800/50 text-sm text-zinc-300">

                <?php 
                // Mudamos de "while" para "foreach", varrendo a lista estruturada de produtos obtida pelo PDO
                foreach($produtos as $produto) { 
                ?>

                <tr class="hover:bg-zinc-800/30 transition-colors">

                    <td class="p-4 font-mono text-zinc-500">
                        #<?php echo $produto['id']; ?>
                    </td>

                    <td class="p-4 font-semibold text-white">
                        <?php echo htmlspecialchars($produto['nome']); ?>
                    </td>

                    <td class="p-4 text-zinc-100 font-medium">
                        R$ <?php echo number_format($produto['preco'], 2, ',', '.'); ?>
                    </td>

                    <td class="p-4">
                        <div class="flex gap-4">
                            <a
                                href="editar.php?id=<?php echo $produto['id']; ?>"
                                class="text-zinc-400 hover:text-white transition-colors"
                            >
                                Editar
                            </a>

                            <a
                                href="deletar.php?id=<?php echo $produto['id']; ?>"
                                onclick="return confirm('Deseja realmente deletar este produto?')"
                                class="text-red-500 hover:text-red-400 font-medium transition-colors"
                            >
                                Deletar
                            </a>
                        </div>
                    </td>

                </tr>

                <?php } ?>

            </tbody>

        </table>

    </div>

</div>

</body>
</html>