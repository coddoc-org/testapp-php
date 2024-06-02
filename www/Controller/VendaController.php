<?php

class VendaController
{

    public function adicionarAoCarrinho()
    {
        $produto = Produto::getProduto($_GET['codProd']);

        // Recuperar o carrinho serializado da sessão
        $carrinhoSerializado = $_SESSION['carrinho'];

        // Deserializar o carrinho para restaurar a variável original
        $carrinho = unserialize($carrinhoSerializado);

        $carrinho[] = $produto;

        // Serializar o carrinho
        $carrinhoSerializado = serialize($carrinho);

        // Armazenar o carrinho serializado na sessão
        $_SESSION['carrinho'] = $carrinhoSerializado;

        $uri = "/?c=Produto&m=exibirCatalogo&cat=" . urlencode($produto->categoria) . "&msg=" . urlencode('Adicionado ao Carrinho: ' . $produto->descricao);
        header("Location: " . $uri);
        exit();
    }

    public function verCarrinho()
    {
        // Recuperar o carrinho serializado da sessão
        $carrinhoSerializado = $_SESSION['carrinho'];

        // Deserializar o carrinho para restaurar a variável original
        $carrinho = unserialize($carrinhoSerializado);

        include 'View/layout/cabecalho.php';

        include 'View/layout/menu.php';

        include 'View/carrinho.php';

        include 'View/layout/rodape.php';
    }

    public function realizarCheckout()
    {
        // Recuperar o carrinho serializado da sessão
        $carrinhoSerializado = $_SESSION['carrinho'];

        // Deserializar o carrinho para restaurar a variável original
        $carrinho = unserialize($carrinhoSerializado);

        // Recuperar o objeto serializado da sessão
        $clienteSerializado = $_SESSION['cliente'];

        // Deserializar o objeto para restaurar o objeto original
        $cliente = unserialize($clienteSerializado);

        $totalDeItens = count($carrinho);

        $valorTotal = 0;

        foreach ($carrinho as $produto) {
            $valorTotal = $valorTotal + floatval($produto->preco);
        }

        include 'View/layout/cabecalho.php';

        include 'View/layout/menu.php';

        include 'View/checkout.php';

        include 'View/layout/rodape.php';
    }

    public function finalizarCOmpra()
    {
        // Recuperar o carrinho serializado da sessão
        $carrinhoSerializado = $_SESSION['carrinho'];

        // Deserializar o carrinho para restaurar a variável original
        $carrinho = unserialize($carrinhoSerializado);

        // Recuperar o objeto serializado da sessão
        $clienteSerializado = $_SESSION['cliente'];

        // Deserializar o objeto para restaurar o objeto original
        $cliente = unserialize($clienteSerializado);

        PagamentoController::validarDadosDoCartao();

        PagamentoController::autorizaACompra();

        ProdutoController::atualizarEstoque($carrinho);

        SistemaController::limparCarrinho();

        SistemaController::enviarEmailDeNotificacao();

        include 'View/layout/cabecalho.php';

        include 'View/layout/menu.php';

        include 'View/finalizar_compra.php';

        include 'View/layout/rodape.php';
    }
}
