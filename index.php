<?php

    //Necessário para que o autoload do composer.json funcione corretamente
    require 'vendor/autoload.php';

    ClasseTest::testar();
    testarImport();

    //A classe Client fornece uma implementação completa e flexível de um cliente HTTP. Ela oferece muitos recursos
    use Matheus\PHPWEB1\BuscaCurso;
    use GuzzleHttp\Client;
    use Symfony\Component\DomCrawler\Crawler;

    //new Client(['base_uri' => X]) serve para definir todas as requisições básicas do objeto como X
    $cliente = new Client(['base_uri' => 'https://www.alura.com.br']);
    $crawler = new Crawler();

    $busca = new BuscaCurso($cliente, $crawler);
    $cursos = $busca->buscar('cursos-online-programacao/php');

    foreach($cursos as $curso){
        echo "\nCurso: " . $curso;
    }
