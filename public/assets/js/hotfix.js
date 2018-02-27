/**
* Esto oculta los botones de tipo submit y los reemplaza
* por un icono de <loading>. Para desactivar esto en un botón, se debe
* agregar el elemento "data-nodisappear" en el botón. Rafael Agostini.
*/

$('button[type=submit], input[type=submit]').click(function (e) {
    if (!$(this).attr('data-nodisappear')) {
        $(this).parent().append(
            '<div class="text-center"><i class="fa fa-fw fa-refresh fa-2x fa-spin" style="color: #00A7CF"></i></div>'
        );
        $(this).hide();
    }
});