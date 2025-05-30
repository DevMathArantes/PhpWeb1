<?php

    namespace Matheus\PHPWEB1;

    //É um cliente HTTP, serve para fazer requisições a servidores web (como se fosse um navegador, só que no código).
    use  \GuzzleHttp\ClientInterface;

    //É uma ferramenta para navegar e manipular HTML como se fossem uma árvore de elementos. 
    use  \Symfony\Component\DomCrawler\Crawler;


    class BuscaCurso{

        private $clienteHttp;
        private $crawler;

        public function __construct(ClientInterface $clienteHttp, Crawler $crawler){
            $this->clienteHttp = $clienteHttp;
            $this->crawler = $crawler;
        }

        public function buscar(string $url) : array{
            
            /*
                A função X->request('GET', Y) serve para um objeto da classe ClientInterface enviar uma requisição http
                para o servidor do método GET (pede ao servidor para enviar os dados da URL especificada) na url Y
            */
            $resposta = $this->clienteHttp->request('GET', $url);
            
            /*
                O método getBody() retorna um objeto que representa o corpo da resposta HTTP. Esse objeto pode ser 
                tratado como uma string, contendo o código HTML da página.
            */
            $html= $resposta->getBody();

            /*
                a função X->addHtmlContent(Y) adiciona o conteúdo HTML Y ao objeto da classe Crawler X, permitindo que você use
                os métodos do Crawler para analisar e extrair informações desse HTML.
            */
            $this->crawler->addHtmlContent($html);

            /*
                a função X->filter(selector: Y) do objeto X da classe Crawler para encontrar todos os elementos HTML que 
                correspondem ao seletor CSS Y (sintaxe: 'TAG.CLASSE').
            */
            $itensCursos = $this->crawler->filter(selector:'span.card-curso__nome');

            $cursos = [];

            //A coleção de itens HTML pode ser percorrida como um array
            foreach($itensCursos as $item){

                /*
                    X->textContent retorna a propriedade textContent do objeto X. A propriedade textContent contém o 
                    texto que está dentro do elemento HTML.
                */
                $cursos[] = $item->textContent;
            }

            return $cursos;

        }

    }

