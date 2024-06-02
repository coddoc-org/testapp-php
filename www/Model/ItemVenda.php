<?php

class ItemVenda
{
    // Atributos do item de venda
    public $qtde;        // Quantidade do item vendido
    public $venda;       // Venda à qual este item pertence

    // Construtor da classe, usado para inicializar os atributos do item de venda
    public function __construct($qtde, Venda $venda)
    {
        $this->qtde = $qtde;          // Inicializa a quantidade do item vendido
        $this->venda = $venda;        // Inicializa a venda à qual este item pertence
    }

    // Métodos adicionais podem ser adicionados aqui conforme necessário
}
