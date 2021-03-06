<?php

namespace app\helper;

use app\conn\read;
use app\conn\update;
use app\helper\funcoes;

class seo {

    private $link;
    private $dados;
    private $file;
    private $tags;
    //Dados povoados.
    private $seoTags;
    private $seoDados;

    function __construct($file, $link) {
        $this->file = strip_tags(trim($file));
        $this->link = strip_tags(trim($link));
    }

    //Pega as tags do seo, descricão, autor, titulo etc.
    public function getTags() {
        $this->checkDados();
        return $this->seoTags;
    }

    //Obetem os dados do banco de dados.
    public function getDados() {
        $this->checkDados();
        return $this->seoDados;
    }

    //Verifica os dados no banco de acordo com o arquivo e link pelo getSeo.
    private function checkDados() {
        if (!$this->seoDados):
            $this->getSeo();
        endif;
    }

    private function getSeo() {
        $readSeo = new read();

        //Verifica pelo arquivo passado.
        switch ($this->file):
            case 'artigo':
                //Verfica o post pelo link
                $readSeo->ExeRead('posts', "WHERE url LIKE '%' :link '%'", "link={$this->link}");
                if (!$readSeo->getResultado()):
                    $this->seoTags = null;
                    $this->seoDados = null;
                else:
                    extract($readSeo->getResultado()[0]);

                    //Recebe o resultado do banco.
                    $this->seoDados = $readSeo->getResultado()[0];

                    //Seta os valores no setTags caso exista o artigo.
                    $this->dados = [$titulo . ' | ' . SITENOME, $conteudo, BASE."artigo/{$url}", BASE.'view/img/site.png'];
                endif;
                break;
            case 'empresa':
                //Verfica o post pelo link
                $readSeo->ExeRead('empresas', "WHERE url LIKE '%' :link '%'", "link={$this->link}");
                if (!$readSeo->getResultado()):
                    $this->seoTags = null;
                    $this->seoDados = null;
                else:
                    extract($readSeo->getResultado()[0]);

                    //Recebe o resultado do banco.
                    $this->seoDados = $readSeo->getResultado()[0];

                    //Seta os valores no setTags caso exista o artigo.
                    $this->dados = [$titulo . ' | ' . SITENOME, $conteudo, BASE."empresa/{$url}", BASE."view/img/site.png"];
                endif;
                break;
            case'categorias':
                //Verfica a categoria pelo link
                $readSeo->ExeRead('categorias', "WHERE url = :link", "link={$this->link}");
                if (!$readSeo->getResultado()):
                    $this->seoTags = null;
                    $this->seoDados = null;
                else:
                    extract($readSeo->getResultado()[0]);

                    //Recebe o resultado do banco.
                    $this->seoDados = $readSeo->getResultado()[0];

                    //Seta os valores no setTags caso exista o artigo.
                    $this->dados = [$titulo . ' | ' . SITENOME, $conteudo, BASE."categorias/{$nome}", BASE.'view/img/site.png'];
                endif;
                break;
            case 'pesquisa';
                //Verfica a categoria pelo link
                $readSeo->ExeRead('posts', "WHERE status = 1 AND (titulo LIKE '%' :link '%' OR conteudo LIKE '%' :link '%')", "link={$this->link}");
                if (!$readSeo->getResultado()):
                    $this->seoTags = null;
                    $this->seoDados = null;
                else:
                    //Cria um indice e recebe a quantidade de resultados.
                    $this->seoDados['count'] = $readSeo->getRowCount();

                    //Seta os valores no setTags caso exista o artigo.
                    $this->dados = ["Pesquisa por: {$this->link} " . SITENOME, "Sua pesquisa por {$this->link} retornou {$this->seoDados['count']} resultados!", BASE."pesquisa/{$this->link}", BASE.'view/img/site.png'];
                endif;
                break;
            case 'empresas';
                $readSeo->ExeRead('categoria_empresas', "WHERE url = :url", "url={$this->link}");
                if (!$readSeo->getResultado()):
                    $this->seoTags = null;
                    $this->seoDados = null;
                else:
                    extract($readSeo->getResultado()[0]);

                    $this->seoDados = $readSeo->getResultado()[0];
                    $this->dados = [$titulo . ' | ' . SITENOME, $conteudo, BASE . $url, BASE . 'views/img/site.png'];
                endif;

                break;
            case 'index':
                //Se não existir nenhum dos case vai seta esses default no meta.
                $this->dados = [SITENOME . ' | Guida de noticias e empresas', SITEDESC,BASE, BASE.'view/img/site.png'];
                break;
            default :
                $this->dados = ['Opsssss nada encontrado!', ' Guida de noticias e empreasas', SITEDESC, BASE.'404', BASE.'view/img/site.png'];
        endswitch;

        //Executa o setTags.
        if ($this->dados):
            $this->setTags();
        endif;
    }

    private function setTags() {
        //Seta as tags de acordo com os resultados setados no $this->dados.
        $this->tags['Title'] = $this->dados[0];
        $this->tags['Content'] = funcoes::limtarTextos(html_entity_decode($this->dados[1]), 25);
        $this->tags['Link'] = $this->dados[2];
        $this->tags['Image'] = $this->dados[3];

        //Limap os dados e espaços em branco.
        $this->tags = array_map('strip_tags', $this->tags);
        $this->tags = array_map('trim', $this->tags);

        //Libera a memoria pois ja foi setada os valores.
        $this->dados = null;

        //NORMAL PAGE
        $this->seoTags = '<title>' . $this->tags['Title'] . '</title> ' . "\n";
        $this->seoTags .= '<meta name="description" content="' . $this->tags['Content'] . '"/>' . "\n";
        $this->seoTags .= '<meta name="robots" content="index, follow" />' . "\n";
        $this->seoTags .= '<link rel="canonical" href="' . $this->tags['Link'] . '">' . "\n";
        $this->seoTags .= "\n";

        //FACEBOOK
        $this->seoTags .= '<meta property="og:site_name" content="' . SITENOME . '" />' . "\n";
        $this->seoTags .= '<meta property="og:locale" content="pt_BR" />' . "\n";
        $this->seoTags .= '<meta property="og:title" content="' . $this->tags['Title'] . '" />' . "\n";
        $this->seoTags .= '<meta property="og:description" content="' . $this->tags['Content'] . '" />' . "\n";
        $this->seoTags .= '<meta property="og:image" content="' . $this->tags['Image'] . '" />' . "\n";
        $this->seoTags .= '<meta property="og:url" content="' . $this->tags['Link'] . '" />' . "\n";
        $this->seoTags .= '<meta property="og:type" content="article" />' . "\n";
        $this->seoTags .= "\n";

        //ITEM GROUP (TWITTER)
        $this->seoTags .= '<meta itemprop="name" content="' . $this->tags['Title'] . '">' . "\n";
        $this->seoTags .= '<meta itemprop="description" content="' . $this->tags['Content'] . '">' . "\n";
        $this->seoTags .= '<meta itemprop="url" content="' . $this->tags['Link'] . '">' . "\n";


        //Libera a memoria pois ja foi setada os valores.
        $this->tags = null;
    }

}
