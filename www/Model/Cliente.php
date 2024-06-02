<?php

// Classe abstrata Cliente
abstract class Cliente
{
    // Atributos da classe Cliente
    public $email;       // E-mail do cliente
    public $senha;       // Senha do cliente
    public $nome;        // Nome do cliente
    public $endereco;    // Endereço do cliente
    public $telefone;    // Telefone do cliente

    // Método construtor da classe abstrata Cliente
    public function __construct($email, $senha, $nome, $endereco, $telefone)
    {
        $this->email = $email;           // Inicializa o e-mail do cliente
        $this->senha = $senha;           // Inicializa a senha do cliente
        $this->nome = $nome;             // Inicializa o nome do cliente
        $this->endereco = $endereco;     // Inicializa o endereço do cliente
        $this->telefone = $telefone;     // Inicializa o telefone do cliente
    }

    // Método abstrato que será implementado nas subclasses
    abstract public function getTipoCliente();

    // Método abstrato que será implementado nas subclasses
    abstract public static function getCliente($email);
}
