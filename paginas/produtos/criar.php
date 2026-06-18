<?php
include('../../protect.php');
include('../../conexao.php');

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $nome = trim($_POST['nome']);
    $preco = trim($_POST['preco']);

    if(empty($nome) || empty($preco)) {
        echo "<script>alert('Preencha todos os campos!');</script>";
    } else {
        
        $preco = str_replace(',', '.', $preco);

        try {
            
            $sql = "INSERT INTO produtos (nome, preco) VALUES (:nome, :preco)";
            $stmt = $pdo->prepare($sql);
            
            
            $executou = $stmt->execute([
                ':nome'  => $nome,
                ':preco' => $preco
            ]);
            
            if($executou) {
                header("Location: index.php");
                exit;
            } else {
                echo "Erro ao cadastrar.";
            }
        } catch (PDOException $e) {
            echo "Erro ao cadastrar: " . $e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Larpintmax - Novo Produto</title>
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
            <a href="index.php" class="text-sm font-semibold text-zinc-400 hover:text-white transition-colors">
                &larr; Voltar para a Lista
            </a>
        </div>
    </header>

    <main class="flex-1 flex items-center justify-center p-4">
        
        <div class="w-full max-w-xl bg-zinc-900 border border-zinc-800 p-8 rounded-2xl shadow-xl">
            
            <div class="mb-6">
                <h1 class="text-2xl font-bold text-white tracking-tight">Novo Produto</h1>
                <p class="text-zinc-400 text-sm mt-1">Adicione uma nova tinta ou insumo ao catálogo da Larpintmax.</p>
            </div>

            <form action="" method="POST" class="space-y-6">
                
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-zinc-400 mb-2">
                        Nome do Produto
                    </label>
                    <input 
                        type="text" 
                        name="nome" 
                        placeholder="Ex: Tinta Acrílica Premium Fosca Preta 18L"
                        required
                        class="w-full bg-zinc-950 border border-zinc-800 rounded-lg px-4 py-3 text-zinc-100 placeholder-zinc-600 focus:outline-none focus:border-red-600 focus:ring-1 focus:ring-red-600 transition-colors duration-200"
                    >
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-zinc-400 mb-2">
                        Preço (R$)
                    </label>
                    <input 
                        type="text" 
                        name="preco" 
                        placeholder="0.00" 
                        required
                        class="w-full bg-zinc-950 border border-zinc-800 rounded-lg px-4 py-3 text-zinc-100 placeholder-zinc-600 focus:outline-none focus:border-red-600 focus:ring-1 focus:ring-red-600 transition-colors duration-200"
                    >
                </div>

                <div class="flex items-center justify-end gap-4 pt-2">
                    <a 
                        href="index.php" 
                        class="text-sm font-semibold text-zinc-400 hover:text-white transition-colors px-4 py-2.5"
                    >
                        Cancelar
                    </a>
                    
                    <button 
                        type="submit" 
                        class="bg-red-600 hover:bg-red-700 text-white font-semibold px-6 py-2.5 rounded-lg text-sm transition-colors duration-200 shadow-md shadow-red-900/20 active:scale-[0.99]"
                    >
                        Salvar Produto
                    </button>
                </div>

            </form>

        </div>

    </main>

    <footer class="bg-zinc-900 border-t border-zinc-800 text-zinc-500 py-4 text-center text-xs">
        &copy; 2026 Larpintmax. Todos os direitos reservados.
    </footer>

</body>
</html>