<?php

// Subclasse PessoaFisica que estende Cliente
class PessoaFisica extends Cliente
{
    // Atributos específicos de PessoaFisica
    public $dtNascimento;    // Data de nascimento da pessoa física
    public $CPF;             // CPF da pessoa física
    public $identidade;      // Identidade da pessoa física

    // Método construtor da classe PessoaFisica
    public function __construct($email, $senha, $nome, $endereco, $telefone, $dtNascimento, $CPF, $identidade)
    {
        parent::__construct($email, $senha, $nome, $endereco, $telefone); // Chama o construtor da classe pai
        $this->dtNascimento = $dtNascimento; // Inicializa a data de nascimento da pessoa física
        $this->CPF = $CPF;             // Inicializa o CPF da pessoa física
        $this->identidade = $identidade; // Inicializa a identidade da pessoa física
        $this->email = $email; // Inicializa o email do cliente
        $this->senha = $senha; // Inicializa a senha do cliente
    }

    // Implementação do método abstrato getTipoCliente
    public function getTipoCliente()
    {
        return "PF";
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
        $sql = "SELECT * FROM clientes WHERE email = '$email' AND tipoCliente = 'PF'";

        // Executar a consulta
        $result = $conn->query($sql);

        $cliente = null;

        if ($row = $result->fetchArray()) {
            $cliente = new PessoaFisica($row['email'], $row['senha'], $row['nome'], $row['endereco'], $row['telefone'],  $row['dtNascimento'],  $row['CPF'],  $row['identidade']);
        }

        // Fechar a conexão com o banco de dados
        $conn->close();

        return $cliente;
    }
}
