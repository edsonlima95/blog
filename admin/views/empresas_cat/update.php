<section class="grid-g-12 estilo-form" style="height: 100%">
    <div class="bread">
        <a href="index">Home</a>
        <span>/</span>
        <a class="ativo">Empresa</a>
    </div>
    <?php
    //Namespaces.
    use admin\models\empresas;
    use app\conn\read;
    
    $empresas = new empresas();
    
    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    $idemp = filter_input(INPUT_GET,'idemp', FILTER_VALIDATE_INT);

    if (isset($dados) && $dados['enviar']):
        unset($dados['enviar']);
        
        $empresas->atualizaEmpresas($dados, $idemp);
        
        if(!$empresas->getResultado()):
            echo '<div class="alert">'.$empresas->getError().'<span class="x">X</span></div>';
        else:
            echo '<div class="success">'.$empresas->getError().'<span class="x">X</span></div>';
        endif;
    else:
        $readEmp = new read();
        $readEmp->ExeRead('categoria_empresas',"WHERE id = :id","id={$idemp}");
        $dados = $readEmp->getResultado()[0];
        $dados['data_criacao'] = $dados['data_criacao'] ? date('d/m/Y H:i:s',strtotime($dados['data_criacao'])) : date('d/m/Y'); 
    endif;
    ?>
    
    <h1>Edição de categorias das empresas</h1>

    <form method="post" enctype="multipart/form-data" class="grid-g-9 grid-m-12">
        <div class="grid-g-5 grid-m-5" style="margin-right: 20px">
            <label for="titulo">Nome categoria </label>
            <input type="text" name="titulo" id="titulo" placeholder="Titulo" value="<?php if(isset($dados['titulo'])) echo $dados['titulo']; ?>">
        </div>
        <div class="grid-g-5 grid-m-5">
            <label for="data">Data </label>
            <input type="text" id="data" name="data_criacao" value="<?php if($dados['data_criacao']) echo $dados['data_criacao']; ?>">
        </div>
        <div class="grid-m-12">
            <label for="textarea">Descrição</label>
            <textarea name="conteudo" id="textarea" placeholder="Descrição"><?php if(isset($dados['conteudo'])) echo $dados['conteudo']; ?></textarea>
        </div>
        <input type="submit" class="btn-green" name="enviar" value="Cadastrar">
    </form>
</section>