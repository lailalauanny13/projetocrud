<?php
include('../../protect.php');
include('../../conexao.php');

$sql = "SELECT * FROM clientes";

try {
    // No PDO, executamos consultas simples usando o método query()
    $query = $pdo->query($sql);
    
    // fetchAll puxa todas as linhas encontradas e organiza em um array associativo
    $clientes = $query->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Falha na execução do código SQL: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Larpintmax - Módulo de Clientes</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-zinc-950 text-zinc-100 min-h-screen">

<div class="max-w-7xl mx-auto p-8">
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-4xl font-bold text-white">Módulo de Clientes</h1>
            <p class="text-zinc-400 mt-1">Gerencie a lista de compradores parceiros.</p>
        </div>
        <div class="flex gap-3">
            <a href="../../painel.php" class="bg-zinc-800 border border-zinc-700 hover:bg-zinc-700 px-4 py-2 rounded-lg transition text-sm font-medium">
                Painel
            </a>
            <a href="criar.php" class="bg-red-600 hover:bg-red-700 px-4 py-2 rounded-lg transition text-sm font-medium shadow-md shadow-red-900/20">
                Novo Cliente
            </a>
        </div>
    </div>

    <div class="bg-zinc-900 border border-zinc-800 rounded-xl overflow-hidden shadow-xl">
        <table class="w-full text-left border-collapse">
            <thead class="bg-zinc-950 border-b border-zinc-800 text-xs font-bold uppercase tracking-wider text-zinc-400">
                <tr>
                    <th class="p-4">ID</th>
                    <th class="p-4">Nome</th>
                    <th class="p-4">E-mail</th>
                    <th class="p-4">Telefone</th>
                    <th class="p-4">Ações</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-zinc-800/50 text-sm text-zinc-300">
                <?php 
                // Mudamos de "while" para "foreach", pois o PDO gera um array com todos os clientes
                foreach($clientes as $cliente) { 
                ?>
                <tr class="hover:bg-zinc-800/30 transition-colors">
                    <td class="p-4 font-mono text-zinc-500">#<?php echo $cliente['id']; ?></td>
                    <td class="p-4 font-semibold text-white"><?php echo htmlspecialchars($cliente['nome']); ?></td>
                    <td class="p-4 text-zinc-400"><?php echo htmlspecialchars($cliente['email']); ?></td>
                    <td class="p-4 text-zinc-400"><?php echo htmlspecialchars($cliente['telefone']); ?></td>
                    <td class="p-4">
                        <div class="flex gap-4">
                            <a href="editar.php?id=<?php echo $cliente['id']; ?>" class="text-zinc-400 hover:text-white transition-colors">Editar</a>
                            <a href="deletar.php?id=<?php echo $cliente['id']; ?>" onclick="return confirm('Deseja realmente deletar este cliente?')" class="text-red-500 hover:text-red-400 font-medium transition-colors">Deletar</a>
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