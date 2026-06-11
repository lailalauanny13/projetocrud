<?php
include('conexao.php');

$erro = ""; 

if(isset($_POST['email']) || isset($_POST['senha'])) {

    if(strlen($_POST['email']) == 0) {
        $erro = "Preencha seu e-mail!";
    } else if(strlen($_POST['senha']) == 0) {
        $erro = "Preencha sua senha!";
    } else {

        // Com PDO, pegamos os dados direto sem precisar de real_escape_string
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        // Usamos placeholders (:email e :senha) para preparar a query com segurança
        $sql_code = "SELECT * FROM usuarios WHERE email = :email AND senha = :senha";
        
        try {
            $stmt = $pdo->prepare($sql_code);
            
            // Passamos os dados de forma isolada dentro do execute
            $stmt->execute([
                ':email' => $email,
                ':senha' => $senha
            ]);

            // rowCount() substitui o antigo num_rows do mysqli
            $quantidade = $stmt->rowCount();

            if($quantidade == 1) {
                
                // fetch() com o parâmetro FETCH_ASSOC substitui o fetch_assoc()
                $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

                if(!isset($_SESSION)) {
                    session_start();
                }

                $_SESSION['id'] = $usuario['id'];
                $_SESSION['nome'] = "Administrador";

                header("Location: painel.php");
                exit;

            } else {
                $erro = "E-mail ou senha incorretos!";
            }

        } catch (PDOException $e) {
            $erro = "Falha na execução do código SQL: " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <link rel="shortcut icon" type="image/x-icon" href="icon.ico">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Larpintmax - Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-zinc-950 text-zinc-100 min-h-screen flex items-center justify-center font-sans p-4">

    <div class="w-full max-w-md bg-zinc-900 border border-zinc-800 p-8 rounded-2xl shadow-xl">
        
        <div class="text-center mb-8">
            <span class="text-3xl font-black tracking-wider text-white block mb-2">
                LARPINT<span class="text-red-600">MAX</span>
            </span>
            <h1 class="text-zinc-400 text-sm font-medium">Acesse a sua conta administrativa</h1>
        </div>

        <?php if(!empty($erro)): ?>
            <div class="bg-red-950/50 border border-red-800 text-red-400 px-4 py-3 rounded-lg text-sm mb-6 text-center font-medium">
                <?php echo $erro; ?>
            </div>
        <?php endif; ?>

        <form action="" method="POST" class="space-y-5">
            
            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-zinc-400 mb-2">E-mail</label>
                <input 
                    type="text" 
                    name="email" 
                    placeholder="exemplo@larpintmax.com"
                    value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>"
                    class="w-full bg-zinc-950 border border-zinc-800 rounded-lg px-4 py-3 text-zinc-100 placeholder-zinc-600 focus:outline-none focus:border-red-600 focus:ring-1 focus:ring-red-600 transition-colors duration-200"
                >
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-zinc-400 mb-2">Senha</label>
                <input 
                    type="password" 
                    name="senha" 
                    placeholder="••••••••"
                    class="w-full bg-zinc-950 border border-zinc-800 rounded-lg px-4 py-3 text-zinc-100 placeholder-zinc-600 focus:outline-none focus:border-red-600 focus:ring-1 focus:ring-red-600 transition-colors duration-200"
                >
            </div>

            <div class="pt-2">
                <button 
                    type="submit" 
                    class="w-full bg-red-600 hover:bg-red-700 text-white font-semibold py-3 rounded-lg transition-colors duration-200 shadow-md shadow-red-900/20 active:scale-[0.99]"
                >
                    Entrar no Sistema
                </button>
            </div>

        </form>

    </div>

</body>
</html>