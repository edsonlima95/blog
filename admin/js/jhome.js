$(function () {

    //EFEITO MENU.
    $('.menu-lateral').find('ul li').click(function () {
        $(this).find('ul.sub-lateral').slideToggle('fast');
    });
    
    //EFEITO MENU PERFIL.
    $('.menu-perfil').find('ul li').click(function () {
        $(this).find('ul.sub-perfil').slideToggle('fast');
    });
    
    //ABRE O MENU.
    $('.botao-open').click(function () {
        $('.menu-lateral').animate({width: 'toggle'});
    });

    //ESTADOS E CIDADES.
    $('#estado').change(function () {

        var id = $(this).val();
        var url = 'j_php/cidades.php';

        $('#cidade').css('font-weight', 'bold').html('<option>Carregando cidades...</option>');

        $.post(url, {idestado: id}, function (res) {
            $('#cidade').delay(500).css('font-weight', 'normal').html(res);
        });

    });

    //EFEITO DA TABELA DE CATEGORIAS.
    $('table').find('tr.sub-cat-tabela td').css('display', 'none');
    
    //EFEITO TOGGLE NAS TD.
    $('table').find('tr.row-cat').on('click', function () {
          var id = $(this).attr('id');
          $('table tr.sub-cat-tabela').find('td[id='+id+']').slideToggle('fast');
    });
    
    Shadowbox.init();
    
    
});