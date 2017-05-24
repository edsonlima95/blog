$(function () {
    //Fechas as mensagens.
    $('.x').click(function () {
        var a = $(this).parent().attr('class');
        if (a == 'alert') {
            $('.alert').fadeOut('fast');
        } else if (a == 'error') {
            $('.error').fadeOut('fast');
        } else if (a == 'success') {
            $('.success').fadeOut('fast');
        } else if (a == 'info') {
            $('.info').fadeOut('fast');
        }
    });
    
});