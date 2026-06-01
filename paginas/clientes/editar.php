<?php
include('../../protect.php');
include('../../conexao.php');

$id = intval($_GET['id']);

$sql_buscar = "SELECT * FROM clientes WHERE id = '$id'";
$query_buscar = $mysqli->query($sql_buscar) or die($mysqli->error);
$cliente = $query_buscar->fetch_assoc();

if(!$cliente) {
    die("Cliente não encontrado.");
}

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $mysqli->real_escape_string($_POST['nome']);
    $email = $mysqli->real_escape_string($_POST['email']);
    $telefone = $mysqli->real_escape_string($_POST['telefone']);

    if(empty($nome) || empty($email) || empty($telefone)) {
        echo "<script>alert('Preencha todos os campos!');</script>";
    } else {
        $sql_update = "UPDATE clientes SET nome = '$nome', email = '$email', telefone = '$telefone' WHERE id = '$id'";
        if($mysqli->query($sql_update)) {
            header("Location: index.php");
            exit;
        } else {
            echo "Erro ao atualizar: " . $mysqli->error;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Larpintmax - Editar Cliente</title>
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
                <h1 class="text-2xl font-bold text-white tracking-tight">Editar Cliente</h1>
                <p class="text-zinc-400 text-sm mt-1">Atualize as informações cadastrais do cliente.</p>
            </div>

            <form action="" method="POST" class="space-y-6">
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-zinc-400 mb-2">Nome Completo</label>
                    <input type="text" name="nome" value="<?php echo htmlspecialchars($cliente['nome']); ?>" required class="w-full bg-zinc-950 border border-zinc-800 rounded-lg px-4 py-3 text-zinc-100 focus:outline-none focus:border-red-600 focus:ring-1 focus:ring-red-600 transition-colors">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-zinc-400 mb-2">E-mail</label>
                    <input type="email" name="email" value="<?php echo htmlspecialchars($cliente['email']); ?>" required class="w-full bg-zinc-950 border border-zinc-800 rounded-lg px-4 py-3 text-zinc-100 focus:outline-none focus:border-red-600 focus:ring-1 focus:ring-red-600 transition-colors">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-zinc-400 mb-2">Telefone / WhatsApp</label>
                    <input type="text" name="telefone" value="<?php echo htmlspecialchars($cliente['telefone']); ?>" required class="w-full bg-zinc-950 border border-zinc-800 rounded-lg px-4 py-3 text-zinc-100 focus:outline-none focus:border-red-600 focus:ring-1 focus:ring-red-600 transition-colors">
                </div>

                <div class="flex items-center justify-end gap-4 pt-2">
                    <a href="index.php" class="text-sm font-semibold text-zinc-400 hover:text-white transition-colors px-4 py-2.5">Cancelar</a>
                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-semibold px-6 py-2.5 rounded-lg text-sm transition-colors shadow-md shadow-red-900/20">Salvar Alterações</button>
                </div>
            </form>
        </div>
    </main>

</body>
</html>