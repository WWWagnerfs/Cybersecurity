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
<body class="faleconosco-page">
    <?php require_once 'includes/base/header.php'; ?>
    <main>
        <?php
        // Conexão com o banco de dados
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "seginf";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Erro de conexão: " . $conn->connect_error);
        }

        // Receber os dados do formulário
        $nome = $_POST['nome'];
        $descricao = $_POST['descricao'];
        $preco = $_POST['preco'];

        // Definir o caminho de destino para a imagem
        $pasta_destino = 'includes/imagens/';

        $imagem = $_FILES['imagem']['name']; // Nome original do arquivo
        $imagem_temp = $_FILES['imagem']['tmp_name']; // Caminho temporário do arquivo no servidor
        $imagem_tamanho = $_FILES['imagem']['size']; // Tamanho do arquivo em bytes
        $imagem_tipo = $_FILES['imagem']['type']; // Tipo MIME do arquivo

        if (move_uploaded_file($imagem_temp, $pasta_destino . $imagem)) {
            echo "Imagem do produto foi enviada com sucesso.";
        } else {
            echo "Erro ao enviar imagem do produto.";
        }

        // Consulta SQL de inserção
        $sql = "INSERT INTO produtos (nome, descricao, preco, imagem) VALUES ('$nome', '$descricao', $preco, '$imagem')";

        if ($conn->query($sql) === TRUE) {
            // Consulta SQL para obter os detalhes do produto inserido
            $consultaProduto = "SELECT * FROM produtos ORDER BY id DESC LIMIT 1";
            $resultadoProduto = $conn->query($consultaProduto);

            if ($resultadoProduto->num_rows > 0) {
                while ($row = $resultadoProduto->fetch_assoc()) {
                    echo "<h2>Detalhes do Produto Adicionado</h2>";
                    echo "<p><strong>Nome:</strong> " . $row['nome'] . "</p>";
                    echo "<p><strong>Descrição:</strong> " . $row['descricao'] . "</p>";                    
                    echo "<p><strong>Imagem:</strong> <img src='includes/imagens/" . $row['imagem'] . "' class='imagem-produto'></p>";
                    echo "<p><strong>Preço:</strong> $" . $row['preco'] . "</p>";
                }
            } else {
                echo "Produto não encontrado.";
            }
            echo "<br><br><a href='form.php' class='btn btn-primary'>Adicionar Outro Produto</a>";
        } else {
            echo "Erro ao inserir produto: " . $conn->error;
        }
    

        $conn->close();
        ?>
    </main>
</body>
</html>
