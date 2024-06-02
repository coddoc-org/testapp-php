<?php

class SistemaController
{

    public function login()
    {
        include 'View/login.php';
    }

    public function auth()
    {
        // Verificar se foram recebidos email e senha via POST
        if (isset($_POST['email']) && isset($_POST['senha'])) {
            // Filtrar e escapar os dados recebidos via POST para evitar injeção de SQL
            $email = $_POST['email'];
            $senha = $_POST['senha'];

            $cliente = PessoaFisica::getCliente($email);

            if (!$cliente) {
                $cliente = PessoaJuridica::getCliente($email);
            }

            if ($cliente->senha == $senha) {
                // Serializar o objeto Cliente
                $clienteSerializado = serialize($cliente);

                // Armazenar o objeto serializado na sessão
                $_SESSION['cliente'] = $clienteSerializado;

                $this->limparCarrinho();

                $uri = "/?c=Sistema&m=inicio";
                header("Location: " . $uri);
                exit();
            } else {
                echo "E-mail ou senha incorretos.";
            }
        } else {
            echo "E-mail ou senha não foram enviados.";
        }
    }

    public function sair()
    {
        $_SESSION['cliente'] = null;

        $uri = "/?c=Sistema&m=login";
        header("Location: " . $uri);
        exit();
    }

    public function inicio()
    {
        include 'View/layout/cabecalho.php';

        include 'View/layout/menu.php';

        // Recuperar o objeto serializado da sessão
        $clienteSerializado = $_SESSION['cliente'];

        // Deserializar o objeto para restaurar o objeto original
        $cliente = unserialize($clienteSerializado);

        $tipoCliente = $cliente->getTipoCliente();

        include 'View/inicio.php';

        include 'View/layout/rodape.php';
    }

    public static function limparCarrinho()
    {
        // Variável que armazenará os itens no carrinho
        $carrinho = [];
        // Serializar o carrinho
        $carrinhoSerializado = serialize($carrinho);

        // Armazenar o carrinho serializado na sessão
        $_SESSION['carrinho'] = $carrinhoSerializado;
    }

    public static function enviarEmailDeNotificacao(){
        // Aqui deveria enviar os e-mails necessários, mas por ser um app de exemplo a lógica não foi implementada;        
    }
}
