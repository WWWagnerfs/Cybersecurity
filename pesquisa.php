<?php
session_start();
require_once 'db.php'; // Inclua o arquivo de conexão com o banco de dados

if (isset($_GET['pesquisa'])) {
    // Limpeza da entrada da pesquisa para evitar injeção de SQL
    $termo_pesquisa = mysqli_real_escape_string($conn, $_GET['pesquisa']);

    // Consulta SQL para recuperar apenas os produtos que correspondem à pesquisa
    $consultaProdutos = "SELECT * FROM produtos WHERE nome LIKE '%$termo_pesquisa%'";
    $resultadoProdutos = $conn->query($consultaProdutos);
} else {
    // Consulta para obter informações dos produtos
    $consultaProdutos = "SELECT * FROM produtos";
    $resultadoProdutos = $conn->query($consultaProdutos);
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesquisa de Produtos</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="css/styles.css"> <!-- Adicione o arquivo CSS para estilos personalizados -->
    <?php require_once 'includes/base/styles.php'; ?>
</head>
<body>
    <?php require_once 'includes/base/header.php'; ?>

    <main>
        <h2>Resultados da Pesquisa</h2>
        <?php
        if ($resultadoProdutos->num_rows > 0) {
            while ($row = $resultadoProdutos->fetch_assoc()) {
                echo '<div class="product">';
                echo '<img src="' . $row['imagem'] . '" alt="' . $row['nome'] . '">';
                echo '<div class="product-info">';
                echo '<h3>' . $row['nome'] . '</h3>';
                echo '<p>' . $row['descricao'] . '</p>';
                echo '<p>Preço: $' . $row['preco'] . '</p>';
                echo '<a href="#">Mais informações</a>';
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo '<p>Nenhum produto encontrado.</p>';
        }
        ?>
    </main>
    <footer>
        <div class="social-icons">
            <a href="#" class="social-icon facebook"><i class="fab fa-facebook-f"></i></a>
            <a href="#" class="social-icon twitter"><i class="fab fa-twitter"></i></a>
            <a href="#" class="social-icon instagram"><i class="fab fa-instagram"></i></a>
            <a href="#" class="social-icon telegram"><i class="fab fa-telegram"></i></a>
        </div>
    </footer>
</body>
</html>
