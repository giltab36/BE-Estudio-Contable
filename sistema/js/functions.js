$(document).ready(function () {

    //  Actualizar datos de la empresa
    $('#formEmpresa').submit(function (e) {
        /* e.preventDefault(); */
        var intNit = $('#txtRuc').val();
        var intDv = $('#txtDv').val();
        var strNombreEmp = $('#txtNombre').val();
        var strRSocialEmp = $('#txtRSocial').val();
        var intTelEmp = $('#txtTelEmpresa').val();
        var strEmailEmp = $('#txtEmailEmpresa').val();
        var strDirEmp = $('#txtDirEmpresa').val();

        if (intNit == '' || intDv == '' || strNombreEmp == '' || intTelEmp == '' || strEmailEmp == '' || strDirEmp == '') {
            $('.alertFormEmpresa').html('<p style="color: red;">Todos los campos son obligatorios.</p>');
            $('.alertFormEmpresa').slideDown();
            return false;
        }

        $.ajax({
            url: 'ajax.php',
            type: "POST",
            async: true,
            data: $('#formEmpresa').serialize(),
            beforeSend: function () {
                $('.alertFormEmrpresa').slideUp();
                $('.alertFormEmrpresa').html('');
                $('#formEmpresa input').attr('disabled", disabled');
            },
            success: function (response) {
                var info = JSON.parse(response);
                if (info.cod == '00') {
                    $('.alertChangePass').html('<p style="color: green;">' + info.msg + '</p>');
                    $('.alertFormEmpresa').slideDown();
                } else {
                    $('.alertFormEmpresa').html('<p style="color: red;">' + info.msg + '</p>');
                }
                $('.alertFormEmpresa').slideDown();
                $('#formEmpresa input').removeAttr('disabled');
            },
            error: function (error) {
            }
        });

    });
    
    
    // Función para alternar la visibilidad de la clave
    $('.toggle-password').on('click', function () {
        var password = $(this).prev('.password');
        if (password.css('display') === 'none') {
            password.css('display', 'inline');
            $(this).text('Ocultar');
        } else {
            password.css('display', 'none');
            $(this).text('Mostrar');
        }
    });

    function toggleClave(button) {
        const row = $(button).closest('tr');
        const claveOculta = row.find('.clave_oculta');
        const claveVisible = row.find('.clave_visible');
        if (claveOculta.is(':hidden')) {
            claveOculta.show();
            claveVisible.hide();
        } else {
            claveOculta.hide();
            claveVisible.show();
        }
    }

    
    // Evento para el botón de mostrar/ocultar clave
    $('.btn_toggle_clave').on('click', function () {
        toggleClave(this);
    });

    $('.btn_toggle_clave').on('click', function () {
        toggleClave(this);
    });


    // Mostrar el modal para añadir obligación temporal
    $('#btn_mostrar_formulario').click(function () {
        $('#formularioObligacion').css('display', 'block');
    });

    // Cerrar el modal
    $('#btn_cerrar_formulario').click(function () {
        $('#formularioObligacion').css('display', 'none');
        $('#form_obligacion_temporal')[0].reset(); // Reiniciar el formulario
    });
});
