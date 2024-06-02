<?php

// Nome do arquivo do banco de dados SQLite
$dbFile = '/tmp/bancodedados.db';

// Verifica se o arquivo do banco de dados existe
if (file_exists($dbFile)) {
    // Exclui o arquivo do banco de dados se ele existir
    unlink($dbFile);
}

// Verifica se o arquivo do banco de dados existe
if (!file_exists($dbFile)) {
    // Cria o arquivo do banco de dados se ele não existir
    $handle = fopen($dbFile, 'w') or die("Não foi possível criar o arquivo do banco de dados.");
    fclose($handle);
    echo "Arquivo do banco de dados criado.\n";
}

// Conectar ao banco de dados SQLite
$conn = new SQLite3($dbFile);

if (!$conn) {
    die("Erro ao conectar ao banco de dados: " . $conn->lastErrorMsg());
} else {
    echo "Conexão bem-sucedida ao banco de dados.\n";
}

// SQL para criar uma tabela de clientes
$sql = "CREATE TABLE IF NOT EXISTS clientes (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    email TEXT NOT NULL,
    senha TEXT NOT NULL,
    nome TEXT NOT NULL,
    endereco TEXT NOT NULL,
    telefone TEXT NOT NULL,
    dtNascimento TEXT,
    CPF TEXT,
    identidade TEXT,
    cgc TEXT,
    razaoSocial TEXT,
    tipoCliente TEXT NOT NULL
)";

// Executar a consulta
if ($conn->exec($sql)) {
    echo "Tabela de clientes criada com sucesso.\n";
} else {
    echo "Erro ao criar tabela de clientes: " . $conn->lastErrorMsg();
}

// SQL para criar uma tabela de produtos
$sql = "CREATE TABLE IF NOT EXISTS produtos (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    codProd TEXT NOT NULL,
    descricao TEXT NOT NULL,
    preco REAL NOT NULL,
    estoque INTEGER NOT NULL,
    categoria TEXT NOT NULL
)";

// Executar a consulta
if ($conn->exec($sql)) {
    echo "Tabela de produtos criada com sucesso.\n";
} else {
    echo "Erro ao criar tabela de produtos: " . $conn->lastErrorMsg();
}

// Fechar a conexão com o banco de dados
$conn->close();