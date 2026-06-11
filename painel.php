<?php
// ISSO DEVE SER A PRIMEIRA COISA DO ARQUIVO!
include('protect.php'); 
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <link rel="shortcut icon" type="image/x-icon" href="icon.ico">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Larpintmax - Painel Administrativo</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-zinc-950 text-zinc-100 min-h-screen flex flex-col md:flex-row font-sans antialiased">

    <aside class="bg-zinc-900 border-b md:border-b-0 md:border-r border-zinc-800 w-full md:w-64 md:h-screen sticky top-0 flex flex-col justify-between p-5 shrink-0 z-10 shadow-xl">
        
        <div class="flex flex-col space-y-6">
            <div class="flex items-center justify-center md:justify-start px-2 py-3">
                <img src="laila.png.png" alt="Logo Larpintmax" class="h-10 w-auto rounded object-contain">
            </div>

            <div class="bg-zinc-950/40 border border-zinc-800/60 rounded-xl p-3 flex items-center space-x-3">
           
                <div class="text-sm truncate">
                    <p class="text-xs text-zinc-500 font-medium">Logado como:</p>
                    <p class="font-semibold text-zinc-200 truncate"><?php echo $_SESSION['nome']; ?></p>
                </div>
            </div>

            <nav class="space-y-1">
                <p class="text-[10px] font-bold tracking-wider text-zinc-500 uppercase px-3 mb-2">Navegação</p>
                
                <a href="#" class="flex items-center space-x-3 bg-zinc-800/50 text-red-500 px-3 py-2.5 rounded-lg text-sm font-medium transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2v-4zM14 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2v-4z"/></svg>
                    <span>Dashboard</span>
                </a>
                <a href="paginas/produtos/index.php" class="flex items-center space-x-3 text-zinc-400 hover:text-zinc-200 hover:bg-zinc-800/30 px-3 py-2.5 rounded-lg text-sm font-medium transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 11m8 4V4"/></svg>
                    <span>Produtos</span>
                </a>
                <a href="paginas/clientes/index.php" class="flex items-center space-x-3 text-zinc-400 hover:text-zinc-200 hover:bg-zinc-800/30 px-3 py-2.5 rounded-lg text-sm font-medium transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                    <span>Clientes</span>
                </a>
                <a href="paginas/vendas/index.php" class="flex items-center space-x-3 text-zinc-400 hover:text-zinc-200 hover:bg-zinc-800/30 px-3 py-2.5 rounded-lg text-sm font-medium transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 002 2h2a2 2 0 002-2z"/></svg>
                    <span>Vendas</span>
                </a>
            </nav>
        </div>

        <div class="pt-4 border-t border-zinc-800/60">
            <a href="logout.php" class="flex items-center justify-center space-x-2 bg-zinc-800 hover:bg-red-600/20 hover:text-red-400 text-zinc-300 font-medium px-4 py-2.5 rounded-xl text-sm transition-all duration-200 w-full group">
                <svg class="w-4 h-4 text-zinc-500 group-hover:text-red-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                <span>Sair do Sistema</span>
            </a>
        </div>
        
    </aside>

    <main class="flex-1 w-full overflow-y-auto">
        <div class="max-w-7xl mx-auto px-6 py-10 md:py-12">
            
            <div class="mb-10">
                <h1 class="text-3xl font-extrabold text-white tracking-tight sm:text-4xl">Painel de Controle</h1>
                <p class="text-zinc-400 mt-2 text-base">Selecione uma das áreas operacionais da Larpintmax para gerenciar.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                
                <div class="bg-zinc-900 border border-zinc-800/80 p-6 rounded-2xl flex flex-col justify-between hover:border-zinc-700 hover:scale-[1.01] transition-all duration-300 shadow-lg group">
                    <div>
                        <div class="w-11 h-11 bg-red-500/10 rounded-xl flex items-center justify-center text-red-500 font-bold text-base mb-5 border border-red-500/10">
                            01
                        </div>
                        <h3 class="text-lg font-bold text-zinc-100 mb-2 group-hover:text-white transition-colors">Módulo de Produtos</h3>
                        <p class="text-zinc-400 text-sm leading-relaxed mb-6">Gerencie o estoque, preços e especificações técnicas de tintas e produtos.</p>
                    </div>
                    <a href="paginas/produtos/index.php" class="inline-flex items-center text-sm font-semibold text-red-500 hover:text-red-400 transition-colors mt-auto w-fit group-hover:translate-x-1 duration-200">
                        Acessar Módulo <span class="ml-1.5 transition-transform duration-200">&rarr;</span>
                    </a>
                </div>

                <div class="bg-zinc-900 border border-zinc-800/80 p-6 rounded-2xl flex flex-col justify-between hover:border-zinc-700 hover:scale-[1.01] transition-all duration-300 shadow-lg group">
                    <div>
                        <div class="w-11 h-11 bg-red-500/10 rounded-xl flex items-center justify-center text-red-500 font-bold text-base mb-5 border border-red-500/10">
                            02
                        </div>
                        <h3 class="text-lg font-bold text-zinc-100 mb-2 group-hover:text-white transition-colors">Módulo de Clientes</h3>
                        <p class="text-zinc-400 text-sm leading-relaxed mb-6">Visualize, edite e controle o cadastro de clientes e compradores parceiros.</p>
                    </div>
                    <a href="paginas/clientes/index.php" class="inline-flex items-center text-sm font-semibold text-red-500 hover:text-red-400 transition-colors mt-auto w-fit group-hover:translate-x-1 duration-200">
                        Acessar Módulo <span class="ml-1.5 transition-transform duration-200">&rarr;</span>
                    </a>
                </div>

                <div class="bg-zinc-900 border border-zinc-800/80 p-6 rounded-2xl flex flex-col justify-between hover:border-zinc-700 hover:scale-[1.01] transition-all duration-300 shadow-lg group">
                    <div>
                        <div class="w-11 h-11 bg-red-500/10 rounded-xl flex items-center justify-center text-red-500 font-bold text-base mb-5 border border-red-500/10">
                            03
                        </div>
                        <h3 class="text-lg font-bold text-zinc-100 mb-2 group-hover:text-white transition-colors">Módulo de Vendas</h3>
                        <p class="text-zinc-400 text-sm leading-relaxed mb-6">Acompanhe relatórios de pedidos, faturamento e ordens de serviço geradas.</p>
                    </div>
                    <a href="paginas/vendas/index.php" class="inline-flex items-center text-sm font-semibold text-red-500 hover:text-red-400 transition-colors mt-auto w-fit group-hover:translate-x-1 duration-200">
                        Acessar Módulo <span class="ml-1.5 transition-transform duration-200">&rarr;</span>
                    </a>
                </div>

            </div>

            <footer class="mt-16 pt-5 border-t border-zinc-900 text-zinc-600 text-xs flex flex-col sm:flex-row justify-between items-center gap-2">
                <p>&copy; <?php echo date('Y'); ?> Larpintmax. Todos os direitos reservados.</p>
                <p class="text-zinc-700">Painel v2.0</p>
            </footer>

        </div>
    </main>

</body>
</html>