<?php

// Iniciar a sessão
session_start();

// Verifica se os parâmetros "controller" e "metodo" estão presentes na query string
if (!(isset($_GET['c']) && isset($_GET['m']))) {
    $uri = "/?c=Sistema&m=inicio";
    header("Location: " . $uri);
    exit();
}

// Verificar se a variável de sessão está definida e tem um valor associado
if (!isset($_SESSION['cliente'])) {

    // Verifica se o controller e o method são um dos que podem ser executados sem autenticação
    if (($_GET['c'] != 'Sistema' || $_GET['m'] != 'login') && ($_GET['c'] != 'Sistema' || $_GET['m'] != 'auth')) {
        $uri = "/?c=Sistema&m=login";
        header("Location: " . $uri);
        exit();
    }
}


// Obtém o nome do controller e do método da query string
$cNome = $_GET['c'] . "Controller";
$mNome = $_GET['m'];

// Verifica se o arquivo do controller existe
$cArquivo = "Controller/{$cNome}.php";
if (file_exists($cArquivo)) {
    // Inclui o arquivo do controller
    require_once $cArquivo;

    // Verifica se a classe do controller existe
    if (class_exists($cNome)) {
        // Instancia o controller
        $controller = new $cNome();

        // Verifica se o método existe na classe do controller
        if (method_exists($controller, $mNome)) {
            // Chama o método no controller
            $controller->$mNome();
        }
    }
}
