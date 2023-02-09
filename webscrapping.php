<?php
/*ini_set('display_errors', 1);
error_reporting(E_ALL);*/

require_once 'vendor/autoload.php';

use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverSelect;
use Facebook\WebDriver\WebDriverWait;
use Facebook\WebDriver\WebDriverExpectedCondition;
use Facebook\WebDriver\Exception\NoSuchElementException;

$host = 'http://localhost:4444/wd/hub'; // this is the default
$capabilities = DesiredCapabilities::chrome();
$driver = RemoteWebDriver::create($host, $capabilities, 5000);

$driver->get('url-site');
//$driver->manage()->window()->maximize();

$juntas = ['1', '2', '3'];

$comarcaPJE = new WebDriverSelect($driver->findElement(WebDriverBy::id("comarcaPJE")));

//Capturar tag com id 'juntaPJE'
$juntaPJE = $driver->findElement(WebDriverBy::id('juntaPJE'));

$anoPJE = $driver->findElement(WebDriverBy::id('anoPJE'));

$processoPJE = $driver->findElement(WebDriverBy::id('processoPJE'));
    
$limpar = $driver->findElement(WebDriverBy::name('limpar1'));

// Preencher outro input

for($i = 0; $i < count($juntas); $i++){
    $comarcaPJE->selectByValue("121");
    $juntaPJE->sendKeys($juntas[$i]);
    $anoPJE->sendKeys('2006');
    $processoPJE->sendKeys('0018')
    ->submit();
    $limpar->click();

    // Obter o texto de uma tag com id 'unico-pje'
    $headerText = $driver->findElement(WebDriverBy::id('unico-pje'))->getText();

    echo "Número único, " . $headerText . "\n";
}

//$driver->quit();
