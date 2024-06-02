<?php

// Nome do arquivo do banco de dados SQLite
$dbFile = '/tmp/bancodedados.db';

// Conectar ao banco de dados SQLite
$conn = new SQLite3($dbFile);

if (!$conn) {
    die("Erro ao conectar ao banco de dados: " . $conn->lastErrorMsg());
} else {
    echo "Conexão bem-sucedida ao banco de dados.\n";
}

// Inserir um cliente fictício pessoa física
$email = "jose@email.com";
$senha = "123";
$nome = "João da Silva";
$endereco = "Rua A, 123";
$telefone = "1234567890";
$dtNascimento = "1990-01-01";
$CPF = "123.456.789-00";
$identidade = "123456789";
$tipoCliente = "PF";

$sql = "INSERT INTO clientes (email, senha, nome, endereco, telefone, dtNascimento, CPF, identidade, tipoCliente) VALUES ('$email', '$senha', '$nome', '$endereco', '$telefone', '$dtNascimento', '$CPF', '$identidade', '$tipoCliente')";

if ($conn->exec($sql)) {
    echo "Cliente pessoa física inserido com sucesso.\n";
} else {
    echo "Erro ao inserir cliente pessoa física: " . $conn->lastErrorMsg();
}


// Inserir um cliente fictício pessoa jurídica
$email = "empresa@email.com";
$senha = "123";
$nome = "Empresa XYZ Ltda.";
$endereco = "Av. B, 456";
$telefone = "987654321";
$cgc = "12.345.678/0001-90";
$razaoSocial = "Empresa XYZ Ltda.";
$tipoCliente = "PJ";

$sql = "INSERT INTO clientes (email, senha, nome, endereco, telefone, cgc, razaoSocial, tipoCliente) VALUES ('$email', '$senha', '$nome', '$endereco', '$telefone', '$cgc', '$razaoSocial', '$tipoCliente')";

if ($conn->exec($sql)) {
    echo "Cliente pessoa jurídica inserido com sucesso.\n";
} else {
    echo "Erro ao inserir cliente pessoa jurídica: " . $conn->lastErrorMsg();
}


// Inserir produtos fictícios
$produtos = [
    ["001", "Biscoito de Polvilho", "3,00", 1, "Padaria"],
    ["002", "Bolo de Cenoura", "12,00", 1, "Padaria"],
    ["003", "Rosquinha", "3,50", 200, "Padaria"],
    ["004", "Leite Integral", "3,50", 1000, "Laticínios"],
    ["005", "Queijo Mussarela", "8,00", 500, "Laticínios"],
    ["006", "Iogurte Natural", "2,50", 500, "Laticínios"],
    ["007", "Carne Moída", "15,00", 500, "Carnes e Peixes"],
    ["008", "Filé de Salmão", "25,00", 300, "Carnes e Peixes"],
    ["009", "Frango Congelado", "8,00", 1000, "Carnes e Peixes"],
    ["010", "Arroz Integral", "7,00", 1000, "Grãos e Cereais"],
    ["011", "Feijão Preto", "5,00", 1000, "Grãos e Cereais"],
    ["012", "Aveia em Flocos", "4,00", 500, "Grãos e Cereais"],
    ["013", "Detergente", "2,00", 500, "Produtos de Limpeza"],
    ["014", "Sabão em Pó", "8,00", 1000, "Produtos de Limpeza"],
    ["015", "Desinfetante", "4,00", 1000, "Produtos de Limpeza"],
    ["016", "Cenoura", "2,00", 500, "Hortifruti"],
    ["017", "Tomate", "3,00", 500, "Hortifruti"],
    ["018", "Alface", "2,50", 300, "Hortifruti"]
];


foreach ($produtos as $produto) {
    $codProd = $produto[0];
    $descricao = $produto[1];
    $preco = $produto[2];
    $estoque = $produto[3];
    $categoria = $produto[4];

    $sql = "INSERT INTO produtos (codProd, descricao, preco, estoque, categoria) VALUES ('$codProd', '$descricao', '$preco', '$estoque', '$categoria')";

    if ($conn->exec($sql)) {
        echo "Produto '$descricao' inserido com sucesso.\n";
    } else {
        echo "Erro ao inserir produto '$descricao': " . $conn->lastErrorMsg();
    }
}

// Fechar a conexão com o banco de dados
$conn->close();
