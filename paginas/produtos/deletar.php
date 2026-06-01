<?php
include('../../protect.php');
include('../../conexao.php');

$id = intval($_GET['id']);

if(isset($_POST['confirmar'])){

    $sql = "DELETE FROM produtos WHERE id = '$id'";

    if($mysqli->query($sql)){
        header("Location: index.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Excluir Produto</title>

<script src="https://cdn.tailwindcss.com"></script>

</head>
<body class="bg-zinc-950 text-white min-h-screen flex items-center justify-center">

<div class="bg-zinc-900 border border-zinc-800 rounded-xl p-8 w-full max-w-md">

    <h1 class="text-3xl font-bold text-red-500 mb-4">
        Excluir Produto
    </h1>

    <p class="text-zinc-400 mb-6">
        Tem certeza que deseja excluir este produto?
    </p>

    <form method="POST" class="flex gap-3">

        <button
            type="submit"
            name="confirmar"
            class="bg-red-600 hover:bg-red-700 px-5 py-2 rounded-lg transition"
        >
            Sim, excluir
        </button>

        <a
            href="index.php"
            class="bg-zinc-700 hover:bg-zinc-600 px-5 py-2 rounded-lg transition"
        >
            Cancelar
        </a>

    </form>

</div>

</body>
</html>