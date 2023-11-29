//Identificar la imagen para el modal
$(function () {
    $('.galeria .contenedor-imagen').on('click' , function () {
        $('#modal').modal;
        var ruta= ($(this).find('img').attr('src'));
        $('#imagen-modal').attr('src' , ruta);
    });
})

//Hacer click fuera del modal y salir
$('#modal').on('click', function () {
    $('#modal').modal('hide');
})