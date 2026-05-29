<?php
include('protect.php');
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Larpintmax - Painel Administrativo</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-zinc-950 text-zinc-100 min-h-screen flex flex-col font-sans">

    <header class="bg-zinc-900 border-b border-zinc-800 shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
            
            <div class="flex items-center space-x-2">
                <span class="text-2xl font-black tracking-wider text-white">
                    LARPINT<span class="text-red-600">MAX</span>
                </span>
            </div>

            <div class="flex items-center space-x-6">
                <div class="text-sm text-right hidden sm:block">
                    <p class="text-zinc-400">Olá, bem-vindo!</p>
                    <p class="font-semibold text-zinc-200"><?php echo $_SESSION['nome']; ?></p>
                </div>
                
                <a href="logout.php" class="bg-red-600 hover:bg-red-700 text-white font-medium px-4 py-2 rounded-md text-sm transition-colors duration-200 shadow-sm shadow-red-900/30">
                    Sair do Sistema
                </a>
            </div>

        </div>
    </header>

    <main class="flex-1 max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-10">
        
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-white tracking-tight">Painel de Controle</h1>
            <p class="text-zinc-400 mt-1">Gerencie os recursos da Larpintmax abaixo.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            
            <div class="bg-zinc-900 border border-zinc-800 p-6 rounded-xl hover:border-red-600/50 transition-colors duration-300">
                <div class="w-12 h-12 bg-red-600/10 rounded-lg flex items-center justify-center text-red-500 font-bold text-xl mb-4">
                    01
                </div>
                <h3 class="text-xl font-bold text-white mb-2">Módulo de Produtos</h3>
                <p class="text-zinc-400 text-sm mb-4">Gerencie o estoque, preços e especificações técnicas de tintas e produtos.</p>
                <a href="produtos/index.php" class="inline-flex items-center text-sm font-semibold text-red-500 hover:text-red-400 transition-colors">
                    Acessar Módulo &rarr;
                </a>
            </div>

            <div class="bg-zinc-900 border border-zinc-800 p-6 rounded-xl hover:border-red-600/50 transition-colors duration-300">
                <div class="w-12 h-12 bg-red-600/10 rounded-lg flex items-center justify-center text-red-500 font-bold text-xl mb-4">
                    02
                </div>
                <h3 class="text-xl font-bold text-white mb-2">Módulo de Clientes</h3>
                <p class="text-zinc-400 text-sm mb-4">Visualize, edite e controle o cadastro de clientes e compradores parceiros.</p>
                <a href="clientes/index.php" class="inline-flex items-center text-sm font-semibold text-red-500 hover:text-red-400 transition-colors">
                    Acessar Módulo &rarr;
                </a>
            </div>

            <div class="bg-zinc-900 border border-zinc-800 p-6 rounded-xl hover:border-red-600/50 transition-colors duration-300">
                <div class="w-12 h-12 bg-red-600/10 rounded-lg flex items-center justify-center text-red-500 font-bold text-xl mb-4">
                    03
                </div>
                <h3 class="text-xl font-bold text-white mb-2">Módulo de Vendas</h3>
                <p class="text-zinc-400 text-sm mb-4">Acompanhe relatórios de pedidos, faturamento e ordens de serviço geradas.</p>
                <a href="vendas/index.php" class="inline-flex items-center text-sm font-semibold text-red-500 hover:text-red-400 transition-colors">
                    Acessar Módulo &rarr;
                </a>
            </div>

        </div>

    </main>

    <footer class="bg-zinc-900 border-t border-zinc-800 text-zinc-500 py-4 text-center text-xs">
        &copy; <?php echo date('Y'); ?> Larpintmax. Todos os direitos reservados.
    </footer>

</body>
</html>