<?php

class Produto
{
    // Atributos do produto
    public $codProd;        // Código do produto
    public $descricao;      // Descrição do produto
    public $preco;          // Preço do produto
    public $estoque;        // Estoque do produto
    public $categoria;       // Categoria do produto

    // Construtor da classe, usado para inicializar os atributos do produto
    public function __construct($codProd, $descricao, $preco, $estoque, $categoria)
    {
        $this->codProd = $codProd;          // Inicializa o código do produto
        $this->descricao = $descricao;      // Inicializa a descrição do produto
        $this->preco = $preco;              // Inicializa o preço do produto
        $this->estoque = $estoque;          // Inicializa o estoque do produto
        $this->categoria = $categoria;      // Inicializa a categoria do produto
    }

    public static function getProduto($codProd)
    {
        // Nome do arquivo do banco de dados SQLite
        $dbFile = '/tmp/bancodedados.db';
        // Conectar ao banco de dados SQLite
        $conn = new SQLite3($dbFile);

        // Filtrar e escapar os dados recebidos via POST para evitar injeção de SQL
        $codProd = SQLite3::escapeString($codProd);

        // Consulta para verificar se existe um cliente com o email fornecido
        $sql = "SELECT * FROM produtos WHERE codProd = '$codProd'";

        // Executar a consulta
        $result = $conn->query($sql);

        $produto = null;

        if ($row = $result->fetchArray()) {
            $produto = new Produto($row['codProd'], $row['descricao'], $row['preco'], $row['estoque'], $row['categoria']);
        }

        // Fechar a conexão com o banco de dados
        $conn->close();

        return $produto;
    }

    public static function getProdutos($categoria)
    {
        // Nome do arquivo do banco de dados SQLite
        $dbFile = '/tmp/bancodedados.db';
        // Conectar ao banco de dados SQLite
        $conn = new SQLite3($dbFile);

        // Filtrar e escapar os dados recebidos via POST para evitar injeção de SQL
        $categoria = SQLite3::escapeString($categoria);

        // Consulta para verificar se existe um cliente com o email fornecido
        $sql = "SELECT * FROM produtos WHERE categoria = '$categoria'";

        // Executar a consulta
        $result = $conn->query($sql);

        $produtos = [];

        // Iterar sobre as linhas do resultado e criar objetos Produto
        while ($row = $result->fetchArray()) {
            $produtos[] = new Produto($row['codProd'], $row['descricao'], $row['preco'], $row['estoque'], $row['categoria']);
        }

        // Fechar a conexão com o banco de dados
        $conn->close();

        return $produtos;
    }
}
