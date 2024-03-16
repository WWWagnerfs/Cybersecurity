<?php
    session_start();
    if (!isset($_SESSION['login'])) {
        header('Location: logar.php');
        exit();
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Produtos</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <?php require_once 'includes/base/styles.php'; ?>
</head>
<body>
    <?php require_once 'includes/base/header.php'; ?>
    <body class="faleconosco-page">
        <main>
            <h2>Adicionar Novo Produto</h2>
                <form class="form-page" action="add_produtos.php" method="POST" enctype="multipart/form-data">
                    <label for="nome">Nome do Produto:</label>
                        <input type="text" id="nome" name="nome" required><br><br>

                    <label for="descricao">Descrição do Produto:</label>
                        <textarea id="descricao" name="descricao" required></textarea><br><br>

                    <label for="preco">Preço do Produto:</label>
                        <input type="number" id="preco" name="preco" step="0.01" required><br><br>
                    
                    <label for="imagem">Imagem do Produto:</label>
                        <input type="file" id="imagem" name="imagem" required><br><br>

                    <button type="submit">Adicionar Produto</button>
                </form>
        </main>
    </body>
</html>