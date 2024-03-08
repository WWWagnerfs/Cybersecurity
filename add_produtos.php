<?php
// Conexão com o banco de dados
$servername = "localhost"; // Endereço do servidor MySQL
$username = "root"; // Nome de usuário do MySQL
$password = ""; // Senha do MySQL
$dbname = "seginf"; // Nome do banco de dados

// Estabelecer conexão com o banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar se houve erro na conexão
if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

// Dados do produto a ser inserido
$nome = "Produto A"; // Nome do produto
$descricao = "Descrição do Produto A"; // Descrição do produto
$preco = 99.99; // Preço do produto

// Consulta SQL de inserção
$sql = "INSERT INTO produtos (nome, descricao, preco) VALUES ('$nome', '$descricao', $preco)";

// Verificar se a inserção foi bem-sucedida
if ($conn->query($sql) === TRUE) {
    echo "Novo produto inserido com sucesso.";
} else {
    echo "Erro ao inserir produto: " . $conn->error;
}

// Fechar conexão com o banco de dados
$conn->close();
?>
