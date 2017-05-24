$(function () {

    //EFEITO MENU.
    $('.menu-lateral').find('ul li').click(function () {
        $(this).find('ul.sub-lateral').slideToggle('fast');
    });

    //ESTADOS E CIDADES.
    $('#estado').change(function () {

        var id = $(this).val();
        var url = 'j_php/cidades.php';
        
        $('#cidade').css('font-weight','bold').html('<option>Carregando cidades...</option>');

        $.post(url, {idestado: id}, function (res) {
            $('#cidade').delay(500).css('font-weight','normal').html(res);
        });

    });
});