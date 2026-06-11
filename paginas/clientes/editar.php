<?php
include(__DIR__ . '/../../protect.php');
include(__DIR__ . '/../../conexao.php');

// Verifica se o ID foi passado na URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = intval($_GET['id']);

try {
    //  Busca o registro atual do cliente usando Prepared Statement
    $sql_buscar = "SELECT * FROM clientes WHERE id = :id";
    $stmt_buscar = $pdo->prepare($sql_buscar);
    $stmt_buscar->execute([':id' => $id]);
    $cliente = $stmt_buscar->fetch(PDO::FETCH_ASSOC);

    if(!$cliente) {
        header("Location: index.php");
        exit;
    }
} catch (PDOException $e) {
    die("Falha na execução do código SQL: " . $e->getMessage());
}

//  Processa o salvamento das alterações
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Com PDO e Prepared Statements, não usamos real_escape_string
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];

    if(empty($nome) || empty($email) || empty($telefone)) {
        echo "<script>alert('Preencha todos os campos!');</script>";
    } else {
        try {
            // Atualiza os dados usando parâmetros vinculados de forma segura
            $sql_update = "UPDATE clientes SET nome = :nome, email = :email, telefone = :telefone WHERE id = :id";
            $stmt_update = $pdo->prepare($sql_update);
            
            $executou = $stmt_update->execute([
                ':nome'     => $nome,
                ':email'    => $email,
                ':telefone' => $telefone,
                ':id'       => $id
            ]);

            if($executou) {
                header("Location: index.php");
                exit;
            } else {
                echo "<script>alert('Erro ao atualizar registro.');</script>";
            }
        } catch (PDOException $e) {
            echo "<script>alert('Erro ao atualizar: " . addslashes($e->getMessage()) . "');</script>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Cliente - LarpintMax</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-zinc-950 text-zinc-100 min-h-screen">

<div class="max-w-2xl mx-auto p-8">

    <div class="bg-zinc-900 border border-zinc-800 rounded-xl p-8">

        <h1 class="text-3xl font-bold mb-6 text-red-500">
            Editar Cliente
        </h1>

        <form action="" method="POST" class="space-y-5">

            <div>
                <label class="block mb-2 text-zinc-300">
                    Nome Completo
                </label>
                <input 
                    type="text" 
                    name="nome" 
                    value="<?php echo htmlspecialchars($cliente['nome']); ?>" 
                    required 
                    class="w-full bg-zinc-800 border border-zinc-700 rounded-lg p-3 focus:outline-none focus:border-red-500 text-zinc-100"
                >
            </div>

            <div>
                <label class="block mb-2 text-zinc-300">
                    E-mail
                </label>
                <input 
                    type="email" 
                    name="email" 
                    value="<?php echo htmlspecialchars($cliente['email']); ?>" 
                    required 
                    class="w-full bg-zinc-800 border border-zinc-700 rounded-lg p-3 focus:outline-none focus:border-red-500 text-zinc-100"
                >
            </div>

            <div>
                <label class="block mb-2 text-zinc-300">
                    Telefone / WhatsApp
                </label>
                <input 
                    type="text" 
                    name="telefone" 
                    value="<?php echo htmlspecialchars($cliente['telefone']); ?>" 
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