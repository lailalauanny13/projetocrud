<body class="bg-zinc-950 text-zinc-100 min-h-screen">

<div class="max-w-2xl mx-auto p-8">

    <div class="bg-zinc-900 border border-zinc-800 rounded-xl p-8">

        <h1 class="text-3xl font-bold mb-6 text-red-500">
            Editar Produto
        </h1>

        <form action="" method="POST" class="space-y-5">

            <div>
                <label class="block mb-2 text-zinc-300">
                    Nome do Produto
                </label>

                <input
                    type="text"
                    name="nome"
                    value="<?php echo htmlspecialchars($produto['nome']); ?>"
                    required
                    class="w-full bg-zinc-800 border border-zinc-700 rounded-lg p-3 focus:outline-none focus:border-red-500"
                >
            </div>

            <div>
                <label class="block mb-2 text-zinc-300">
                    Preço (R$)
                </label>

                <input
                    type="text"
                    name="preco"
                    value="<?php echo htmlspecialchars($produto['preco']); ?>"
                    required
                    class="w-full bg-zinc-800 border border-zinc-700 rounded-lg p-3 focus:outline-none focus:border-red-500"
                >
            </div>

            <div class="flex gap-3">

                <button
                    type="submit"
                    class="bg-red-600 hover:bg-red-700 px-6 py-3 rounded-lg font-semibold transition"
                >
                    Salvar Alterações
                </button>

                <a
                    href="index.php"
                    class="bg-zinc-700 hover:bg-zinc-600 px-6 py-3 rounded-lg transition"
                >
                    Cancelar
                </a>

            </div>

        </form>

    </div>

</div>

</body>