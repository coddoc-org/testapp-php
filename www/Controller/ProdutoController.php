<?php

class ProdutoController
{

    public function exibirCatalogo()
    {
        include 'View/layout/cabecalho.php';

        include 'View/layout/menu.php';

        $produtos = Produto::getProdutos($_GET['cat']);

        include 'View/catalogo.php';

        include 'View/layout/rodape.php';
    }

    public static function atualizarEstoque($carrinho){
        // Aqui deveria dar baixa no estoque , mas por ser um app de exemplo a lógica não foi implementada;        
    }
}