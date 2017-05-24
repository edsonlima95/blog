<section class="grid-g-12 estilo-form" style="height: 100%">
    <h1>Cadastro de posts</h1>

    <form method="post" enctype="multipart/form-data" class="grid-g-9 grid-m-12">
        <div class="grid-g-5 grid-m-5" style="margin-right: 20px;">
            <label for="capa">Foto </label>
            <input type="file" name="capa" id="capa" placeholder="Capa" style="padding: 0px">
        </div>
        <div class="grid-g-5 grid-m-5">
            <label for="titulo">Nome </label>
            <input type="text" name="titulo" id="titulo" placeholder="Titulo">
        </div>
        
        <div class="grid-g-5 grid-m-5" style="margin-right: 20px;">
            <label for="titulo">Email </label>
            <input type="email" name="titulo" id="titulo" placeholder="Titulo">
        </div>
        
        <div class="grid-g-5 grid-m-5">
            <label for="titulo">Senha </label>
            <input type="password" name="titulo" id="titulo" placeholder="Titulo">
        </div>
     
        <div class="grid-g-5 grid-m-5" style="margin-right: 20px">
            <label for="autor">Nivel </label>
            <select id="autor" name="autor">
                <option value="" disabled="" selected="">Selecione um autor</option>
                <option value="1">Super admin</option>
                <option value="2">Admin</option>
            </select>
        </div>
        
        <div class="grid-g-5 grid-m-5">
            <label for="data">Data </label>
            <input type="date" id="data" name="data_creacao" value="<?= date('d/m/y H:i:s')?>">
        </div>
        <div class="grid-g-10">
            <input type="submit" name="enviar" class="btn-green" value="Cadastrar">
        </div>
    </form>
</section>