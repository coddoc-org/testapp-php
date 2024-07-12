<?php
require 'vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Chrome\ChromeOptions;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverExpectedCondition;
use Facebook\WebDriver\WebDriverWait;

class UIComprarProdutoTest extends TestCase
{
    protected $webDriver;

    protected $traceProcess;

    protected $traceID = "3";

    public function setUp(): void
    {
        $host = 'http://host.docker.internal:4444/wd/hub'; // URL do Selenium Server

        $options = new ChromeOptions();
        $options->addArguments([
            '--no-sandbox',
            '--disable-dev-shm-usage',
            // '--headless', // Desabilitar o modo headless para depuração
            '--disable-gpu',
            '--remote-debugging-port=9222',
            '--disable-extensions',
            '--disable-software-rasterizer',
            '--disable-dev-shm-usage',
            '--disable-setuid-sandbox',
            '--disable-logging',
            '--disable-infobars'
        ]);
        $options->setBinary('/opt/google/chrome/chrome'); // Especificar o caminho do Chrome

        $capabilities = DesiredCapabilities::chrome();
        $capabilities->setCapability(ChromeOptions::CAPABILITY, $options);

        $this->webDriver = RemoteWebDriver::create($host, $capabilities);

        $this->startTrace();
    }

    public function tearDown(): void
    {
        if ($this->webDriver) {
            $this->webDriver->quit();
        }

        $this->stopTrace();
        $this->sendTrace();
    }

    protected function startTrace()
    {
        $command = "/root/coddoc-tracescript/coddoc-trace.sh > /dev/null 2>&1 & echo $!";
        $this->traceProcess = shell_exec($command);
    }

    protected function stopTrace()
    {
        if ($this->traceProcess) {
            shell_exec("kill $this->traceProcess");
        }
    }

    protected function sendTrace()
    {
        $command = "/root/coddoc-tracescript/coddoc-send.sh $this->traceID";
        shell_exec($command);
    }

    public function testComprarProduto()
    {
        $this->webDriver->get('http://localhost'); // URL da sua aplicação

        // Aumente o tempo de espera
        $timeout = 10; // segundos
        $sleep = 2;

        // Espera a página ser carregada
        sleep($sleep);

        // Adicione uma espera explícita para garantir que os elementos estejam presentes
        $this->webDriver->wait($timeout, 500)->until(
            WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::name('email'))
        );

        $emailField = $this->webDriver->findElement(WebDriverBy::name('email'));
        $senhaField = $this->webDriver->findElement(WebDriverBy::name('senha'));
        $submitButton = $this->webDriver->findElement(WebDriverBy::cssSelector('button[type="submit"]'));

        // Preencher o formulário de login
        $emailField->sendKeys('jose@email.com');
        $senhaField->sendKeys('123');
        $submitButton->click();

        // Sleep para garantir que a próxima página seja carregada
        sleep($sleep);

        // Espere o menu "CATÁLOGO DE PRODUTOS"
        $this->webDriver->wait($timeout, 500)->until(
            WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::xpath("//div[@id='navbar-menu']//span[contains(text(), 'CATÁLOGO DE PRODUTOS')]"))
        );
        $catalogoMenu = $this->webDriver->findElement(WebDriverBy::xpath("//div[@id='navbar-menu']//span[contains(text(), 'CATÁLOGO DE PRODUTOS')]"));
        $catalogoMenu->click();

        // Sleep para garantir que o menu dropdown seja carregado
        sleep($sleep);

        // Espere a opção "Padaria"
        $this->webDriver->wait($timeout, 500)->until(
            WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::linkText('Padaria'))
        );
        $graosCereaisLink = $this->webDriver->findElement(WebDriverBy::linkText('Padaria'));
        $graosCereaisLink->click();

        // Sleep para garantir que a próxima página seja carregada
        sleep($sleep);

        // Espere a presença do título "PADARIA"
        $this->webDriver->wait($timeout, 500)->until(
            WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::xpath("//h3[contains(text(), 'PADARIA')]"))
        );

        // Clique em "Bolo de Cenoura"
        $this->webDriver->wait($timeout, 500)->until(
            WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::linkText('Bolo de Cenoura'))
        );
        $arrozIntegralLink = $this->webDriver->findElement(WebDriverBy::linkText('Bolo de Cenoura'));
        $arrozIntegralLink->click();

        // Sleep para garantir que a próxima página seja carregada
        sleep($sleep);

        // Espere o alerta de sucesso
        $this->webDriver->wait($timeout, 500)->until(
            WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::cssSelector('div.alert.alert-success'))
        );

        // Espere o menu "CARRINHO"
        $this->webDriver->wait($timeout, 500)->until(
            WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::xpath("//div[@id='navbar-menu']//span[contains(text(), 'CARRINHO')]"))
        );
        $carrinhoMenu = $this->webDriver->findElement(WebDriverBy::xpath("//div[@id='navbar-menu']//span[contains(text(), 'CARRINHO')]"));
        $carrinhoMenu->click();

        // Sleep para garantir que a próxima página seja carregada
        sleep($sleep);

        // Espere a presença do título "CARRINHO"
        $this->webDriver->wait($timeout, 500)->until(
            WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::xpath("//h3[contains(text(), 'CARRINHO')]"))
        );

        // Clique no botão "Comprar"
        $this->webDriver->wait($timeout, 500)->until(
            WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::id('comprar'))
        );
        $comprarButton = $this->webDriver->findElement(WebDriverBy::id('comprar'));
        $this->webDriver->executeScript("arguments[0].scrollIntoView(true);", [$comprarButton]);
        $this->webDriver->wait($timeout, 500)->until(
            WebDriverExpectedCondition::elementToBeClickable(WebDriverBy::id('comprar'))
        );
        $comprarButton->click();

        // Sleep para garantir que a próxima página seja carregada
        sleep($sleep);

        // Espere o botão "Finalizar Compra"
        $this->webDriver->wait($timeout, 500)->until(
            WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::id('finalizar'))
        );
        $finalizarCompraButton = $this->webDriver->findElement(WebDriverBy::id('finalizar'));
        $this->webDriver->executeScript("arguments[0].scrollIntoView(true);", [$finalizarCompraButton]);
        $this->webDriver->wait($timeout, 500)->until(
            WebDriverExpectedCondition::elementToBeClickable(WebDriverBy::id('finalizar'))
        );
        // Submeter o formulário diretamente usando JavaScript
        $this->webDriver->executeScript("arguments[0].form.submit();", [$finalizarCompraButton]);

        // Sleep para garantir que a próxima página seja carregada
        sleep($sleep);

        // Verifique se o botão "Voltar ao Início" está presente
        $this->webDriver->wait($timeout, 500)->until(
            WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::id('voltar'))
        );

        $voltarInicioButton = $this->webDriver->findElement(WebDriverBy::id('voltar'));
        $this->assertSame('Voltar ao Início', $voltarInicioButton->getText());
    }
}
