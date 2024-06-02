<?php

class Venda
{
    // Atributos da venda
    public $numVenda;     // Número da venda
    public $dataVenda;    // Data da venda
    public $valorTotal;   // Valor total da venda

    // Construtor da classe, usado para inicializar os atributos da venda
    public function __construct($numVenda, $dataVenda, $valorTotal)
    {
        $this->numVenda = $numVenda;       // Inicializa o número da venda
        $this->dataVenda = $dataVenda;     // Inicializa a data da venda
        $this->valorTotal = $valorTotal;   // Inicializa o valor total da venda
    }

    // Métodos adicionais podem ser adicionados aqui conforme necessário
}
