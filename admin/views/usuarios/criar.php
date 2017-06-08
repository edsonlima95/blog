<section class="grid-g-12 estilo-form">
    <h1>Cadastrar usuários</h1>
    
    <?php
    use admin\models\usuarios;
    
    $usuario = new usuarios();
    
    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    
    if(isset($dados) && $dados['enviar']):
        unset($dados['enviar']);
        
        //CAPA.
        $dados['capa'] = $_FILES['capa']['tmp_name'] ? $_FILES['capa'] : 'null';
    
        //CADASTRA O USUARIO.
        $usuario->cadastraUsuario($dados);
        
        if(!$usuario->getResultado()):
            echo '<div class="alert">'.$usuario->getError().'<span class="x">X</span></div>';
        else:
            echo '<div class="success">'.$usuario->getError().'<span class="x">X</span></div>';
        endif;
        
    endif;
    ?>
    
    <form method="post" enctype="multipart/form-data" class="grid-g-9 grid-m-12">
        <div class="grid-g-5 grid-m-5" style="margin-right: 20px;">
            <label for="capa">Foto </label>
            <input type="file" name="capa" id="capa" placeholder="Capa" style="padding: 0px">
        </div>
        <div class="grid-g-5 grid-m-5">
            <label for="nome">Nome </label>
            <input type="text" name="nome" id="nome" placeholder="Nome">
        </div>
        
        <div class="grid-g-5 grid-m-5" style="margin-right: 20px;">
            <label for="email">Email </label>
            <input type="email" name="email" id="email" placeholder="Email">
        </div>
        
        <div class="grid-g-5 grid-m-5">
            <label for="password">Senha </label>
            <input type="password" name="token" id="password" placeholder="Senha">
        </div>
     
        <div class="grid-g-5 grid-m-5" style="margin-right: 20px">
            <label for="nivel">Nivel </label>
            <select id="nivel" name="nivel">
                <option value="" selected="">Selecione um autor</option>
                <option value="1">Super admin</option>
                <option value="2">Admin</option>
            </select>
        </div>
        
        <div class="grid-g-5 grid-m-5">
            <label for="data">Data </label>
            <input type="data" id="data" name="data_criacao" value="<?= date('d/m/Y')?>">
        </div>
        <div class="grid-g-10">
            <input type="submit" name="enviar" class="btn-green" value="Cadastrar">
        </div>
    </form>
</section>