<?php

    require 'vendor/autoload.php';

    use  \GuzzleHttp\Client;
    use  \Symfony\Component\DomCrawler\Crawler;

    //new Client() cria uma nova instância do cliente HTTP Guzzle
    $cliente = new Client([

        /*
            verificação SSL/TLS, garantindo que a conexão com o site seja segura e confiável. Se isso não for 
            configurado corretamente, você poderá encontrar erros de certificado SSL.
        */
        'verify' => 'C:\\Users\\mathe\\Downloads\\Importantes\\cacert.pem'
    ]);

    //$X->request('GET', Y); cliente X envia uma requisição HTTP GET para o link Y especificado
    $resposta = $cliente->request('GET', 'https://www.alura.com.br/cursos-online-programacao/php');
    
    /*
        O método getBody() geralmente retorna um objeto Psr\Http\Message\StreamInterface, que é então 
        implicitamente convertido para uma string ao ser atribuído a $html
    */
    $html= $resposta->getBody();

    //Novo objeto crawler (serve para percorrer ou manipular html ou xml)
    $crawler = new Crawler();

    //carrega o conteúdo HTML obtido no objeto Crawler, deixando-o pronto para análise e seleção
    $crawler->addHtmlContent($html);

    //$X->filter(selector: 'Y.Z'); pega cada elemento html do objeto crawler X de tag Y e classe Z e monta uma coleção
    $cursos = $crawler->filter(selector:'span.card-curso__nome');

    //A coleção se comporta como um array 
    foreach($cursos as $curso){

        //$X->textContent; retorna o conteúdo dentro da tag X
        echo "\nCurso: " . $curso->textContent;
    }
