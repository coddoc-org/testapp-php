<?php

// Subclasse PessoaJuridica que estende Cliente
class PessoaJuridica extends Cliente
{
    // Atributos específicos de PessoaJuridica
    public $cgc;             // CGC da pessoa jurídica
    public $razaoSocial;     // Razão social da pessoa jurídica

    // Método construtor da classe PessoaJuridica
    public function __construct($email, $senha, $nome, $endereco, $telefone, $cgc, $razaoSocial)
    {
        parent::__construct($email, $senha, $nome, $endereco, $telefone); // Chama o construtor da classe pai
        $this->cgc = $cgc;             // Inicializa o CGC da pessoa jurídica
        $this->razaoSocial = $razaoSocial; // Inicializa a razão social da pessoa jurídica
        $this->email = $email; // Inicializa o email do cliente
        $this->senha = $senha; // Inicializa a senha do cliente
    }

    // Implementação do método abstrato getTipoCliente
    public function getTipoCliente()
    {
        return "PJ";
    }

    // Implementação do método abstrato getCliente
    public static function getCliente($email)
    {
        // Nome do arquivo do banco de dados SQLite
        $dbFile = '/tmp/bancodedados.db';
        // Conectar ao banco de dados SQLite
        $conn = new SQLite3($dbFile);

        // Filtrar e escapar os dados recebidos via POST para evitar injeção de SQL
        $email = SQLite3::escapeString($email);

        // Consulta para verificar se existe um cliente com o email fornecido
        $sql = "SELECT * FROM clientes WHERE email = '$email' AND tipoCliente = 'PJ'";

        // Executar a consulta
        $result = $conn->query($sql);

        $cliente = null;

        if ($row = $result->fetchArray()) {
            $cliente = new PessoaJuridica($row['email'], $row['senha'], $row['nome'], $row['endereco'], $row['telefone'], $row['cgc'], $row['razaoSocial']);
        }

        // Fechar a conexão com o banco de dados
        $conn->close();

        return $cliente;
    }
}
