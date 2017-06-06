<?php

namespace app\helper;

use app\conn\delete;
use app\conn\read;
use app\conn\create;
use app\conn\update;

class funcoes {

    public static $formato;
    public static $dados;

    //validação de string e url amigavel.
    public static function Name($nome) {
        self::$formato = array();
        self::$formato['a'] = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜüÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿRr"!@#$%&*()_-+={[}]/?;:.,\\\'<>°ºª';
        self::$formato['b'] = 'aaaaaaaceeeeiiiidnoooooouuuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr';
        self::$dados = strtr(utf8_decode($nome), utf8_decode(self::$formato['a']), self::$formato['b']); //elimina as acentuaçoes e passa do formato A para o B;
        self::$dados = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', self::$dados);
        self::$dados = strip_tags(trim(self::$dados)); //elimina tags html.
        self::$dados = str_replace(' ', '-', self::$dados);
        self::$dados = str_replace(array('-----', '----', '---', '--'), '-', self::$dados); //se houver mais de um traço ele substitui por apenas 1.

        return strtolower(utf8_encode(self::$dados));
    }

    //Transforma a data padrao timestap para a o padrao normal.
    public static function validaData($data) {
        self::$formato = explode(' ', $data);
        self::$dados = explode('/', self::$formato[0]);
        if (empty(self::$formato[1])):
            self::$formato[1] = date('H:i:s');
        endif;

        return self::$dados[2] . '-' . self::$dados[1] . '-' . self::$dados[0] . ' ' . self::$formato[1];
    }

    //Limta o numero de palavras no texto
    public static function limtarTextos($string, $limite) {
        self::$dados = substr($string, 0, $limite);
        self::$formato = strrpos(self::$dados, ' ');
        $texoCompleto = substr(self::$dados, 0, self::$formato) . '...';

        return $texoCompleto;
    }

    // pega o id da categoria informada.
    public static function categoriaNome($nome, $tabela = null) {
        self::$dados = (isset($tabela) ? $tabela : 'categorias');
        $novo = ucfirst($nome);
        $read = new read();
        $read->ExeRead(self::$dados, "WHERE nome = :nome", "nome={$novo}");
        if ($read->getResultado()):
            return $read->getResultado()[0]['id'];
        else:
            echo "Nenhuma categoria encontrada com o nome <strong>{$nome}</strong>";
        endif;
    }

    //Deleta os usuarios apartir de uma data.
    public static function deltetaUsuarios($data) {
        $data = explode('/', $data);
        $dataStamp = $data[2] . '-' . $data[1] . '-' . $data[0];
        $dataFinal = $dataStamp;
        $delete = new delete();
        $delete->ExeDelete('site_online', "WHERE fim_sessao = :fimsessao", "fimsessao={$dataFinal}");
        if ($delete->getResultado()):
            echo 'Usuarios deletados com sucesso';
        endif;
    }

    //Redireciona imagens.
    public static function redirecionaImagem($nomeImagem, $descricao, $widht = null, $height = null, $caminho = null) {
        self::$dados = (empty($caminho) ? 'uploads/imagens/' . $nomeImagem : $caminho . $nomeImagem);
        if (file_exists(self::$dados) && !is_dir(self::$dados)):
            $url = 'http://localhost/cidadeonline/';
            $caminho = self::$dados;
            $imagem = $caminho;
            return "<img src=\"{$url}/tim.php?src={$imagem}&w={$widht}&h={$height}\" alt=\"{$descricao}\" title=\"{$descricao}\">";
        endif;
    }

    //Metodo com o padrao front-controller.
    public static function frontController($http) {

        if (!empty($http)):
            $caminho = __DIR__ . DIRECTORY_SEPARATOR . '../../admin/views' . DIRECTORY_SEPARATOR . strip_tags(trim($http) . '.php');
        else:
            $caminho = __DIR__ . DIRECTORY_SEPARATOR . '../../admin/views' . DIRECTORY_SEPARATOR . 'home.php';
        endif;

        if (file_exists($caminho)):
            require_once ($caminho);
        else:
            echo "Erro ao tentar incluir o arquivo !";
        endif;
    }

    //Obtem a url
    public static function setHome() {
        $url = (isset($_GET['url']) ? strip_tags(trim($_GET['url'])) : 'index');
        $url = explode('/', $url);
        $url[0] = ($url[0] == null ? 'index' : $url[0]);
        $url[1] = ( empty($url[1]) ? null : $url[1]); //EVITA NOCICE

        if (file_exists(PATH . $url[0] . '.php')):
            require_once (PATH . $url[0] . '.php');
        elseif (file_exists(PATH . $url[0] . '/' . $url[1] . '.php')):
            require_once(PATH . $url[0] . '/' . $url[1] . '.php');
        else:
            if (file_exists(PATH . '404.php')):
                require_once (PATH . '404.php');
            else:
                echo 'O arquivo não existe!';
            endif;
        endif;
    }

    //VISITAS DE ARTIGOS.
    public static function contaVisitas($tabela) {
        $url = filter_input(INPUT_GET, 'url', FILTER_DEFAULT);
        $url = explode('/', $url);
        self::$dados = $url[1];

        $countVisitas = new read();
        $countVisitas->ExeRead($tabela, "WHERE url = :u", "u=" . self::$dados);
        if($countVisitas->getResultado()):
            $visitas = $countVisitas->getResultado()[0]['visitas'];
            $arr = ['visitas' => $visitas + 1];
            $updateVisitas = new update();
            $updateVisitas->ExeUpdate($tabela, $arr, "WHERE url = :u", "u=" . self::$dados);
        endif;
    }

}
