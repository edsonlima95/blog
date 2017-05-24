<section class="grid-g-12 estilo-form" style="height: 100%">
    <div class="bread">
        <a href="index">Home</a>
        <span>/</span>
        <a class="ativo">Categoria</a>
    </div>
    <?php
    //Namespaces.
    use admin\models\categorias;
    use app\conn\read;
   
    $categoria = new categorias();
    
    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

    if (isset($dados) && $dados['enviar']):
        unset($dados['enviar']);
        
        $categoria->cadastraCategoria($dados);
      
        if(!$categoria->getResultado()):
            echo '<div class="alert">'.$categoria->getError().'<span class="x">X</span></div>';
        else:
            echo '<div class="success">'.$categoria->getError().'<span class="x">X</span></div>';
        endif;
    endif;
    ?>
    <h1>Cadastro de categorias</h1>
    
    <form method="post" enctype="multipart/form-data" class="grid-g-9 grid-m-12">
        <div class="grid-g-5 grid-m-5" style="margin-right: 20px">
            <label for="nome">Nome <span style="color: red">*</span></label>
            <input type="text" name="nome" id="nome" placeholder="Nome" value="<?php if(isset($dados['nome'])) echo $dados['nome']; ?>">
        </div>
        <div class="grid-g-5 grid-m-5">
            <label for="titulo">Titulo <span style="color: red">*</span></label>
            <input type="text" name="titulo" id="titulo" placeholder="Titulo" value="<?php if(isset($dados['titulo'])) echo $dados['titulo']; ?>">
        </div>
        <div class="grid-g-5 grid-m-5" style="margin-right: 20px">
            <label for="cat">Categoria <span style="color: red">*</span></label>
            <select id="cat" name="id_pai">
                <option value="" disabled="" selected="">Selecione uma Categória</option>
                <?php
                $readC = new read();
                $readC->ExeRead('categorias',"WHERE id_pai IS NULL ORDER BY titulo ASC");
                foreach ($readC->getResultado() as $resCat):
                    echo ' <option value="'.$resCat['id'].'"';
                        if(isset($dados['id_pai']) == $resCat['id'])
                            echo 'selected';
                    echo '>'.$resCat['nome'].'</option>';
                endforeach;
                ?>
            </select>
        </div>
        <div class="grid-g-5 grid-m-5">
            <label for="data">Data <span style="color: red">*</span></label>
            <input type="text" id="data" name="data_criacao" value="<?= date('d/m/Y'); ?>">
        </div>
        <div class="grid-m-12">
            <label for="textarea">Descrição <span style="color: red">*</span></label>
            <textarea name="conteudo" id="textarea" placeholder="Descrição"><?php if(isset($dados['conteudo'])) echo $dados['conteudo']; ?></textarea>
        </div>
        <input type="submit" class="btn-green" name="enviar" value="Cadastrar">
    </form>
</section>