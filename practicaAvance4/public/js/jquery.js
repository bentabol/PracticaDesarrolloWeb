$(document).ready(function () {

    //Catpcha del formulario 
    errorCatpcha = false;


    var num1 = Math.round(Math.random() * (10 - 1) + 1);
    var num2 = Math.round(Math.random() * (10 - 1) + 1);
    var total = num1 + num2
    $(".sumaCatpcha").append("<br>" + num1 + " + " + num2);
    $("#inputCatpcha").keyup(function () {
        $('#inputCatpcha').removeClass('good');
        if (parseInt($(this).val()) === total) {
            errorCatpcha = false;
            $('#inputCatpcha').addClass('good');
        } else {
            errorCatpcha = true;
            $('#inputCatpcha').addClass('errorField');

        }
    });

    // Muestra u oculta los paneles
    $('#tipo_0').click(function () {
        $('#div_cliente').show();
        $('#div_gestor').hide();
        $('#div_administrador').hide();
    });
    $('#tipo_1').click(function () {
        $('#div_cliente').hide();
        $('#div_gestor').show();
        $('#div_administrador').hide();
    });
    $('#tipo_2').click(function () {
        $('#div_cliente').hide();
        $('#div_gestor').hide();
        $('#div_administrador').show();
    });

    // Validación de datos antes de enviar
    $('#btEnviar').click(function (event) {


        var error = false;
        $('.help').html('');
        $('.field').removeClass('errorField');
        $('#vipPane').removeClass('errorField');
        $('#email').removeClass('errorField');
        $('#nombre').removeClass('errorField');
        $('#apellidos').removeClass('errorField');
        $('#password').removeClass('errorField');
        $('#password2').removeClass('errorField');



        //Campo botones
        if (!$('#tipo_0').is(':checked') &&
            !$('#tipo_1').is(':checked') &&
            !$('#tipo_2').is(':checked')) {
            error = true;
            $('#email').addClass('errorField');
            $('#email_help').html('Campo vacío');
        }

        // Campo email
        if ($('#email').val() == "") {
            error = true;
            $('#email').addClass('errorField');
            $('#email_help').html('Campo vacío');
        }
        // Verificar que email correcto
        var regExpEmail = /^([a-zA-Z0-9\+\-\.]+)@(([a-zA-Z0-9]+\.)+)[a-zA-Z]+$/;
        if (!regExpEmail.test($('#email').val())) {
            error = true;
            $('#email').addClass('errorField');
            $('#email_help').html('El formato del email es incorrecto');
        }
        // Campo nombre
        if ($('#nombre').val() == "") {
            error = true;
            $('#nombre').addClass('errorField');
            $('#nombre_help').html('Campo vacío');
        }

        if ($('#nombre').val().length > 20) {
            error = true;
            $('#nombre').addClass('errorField');
            $('#nombre_help').html('Nombre no puede ser mayor de 20 caracteres');
        }
        var regNombre = /^([a-zA-Z ]+)$/;
        if (!regNombre.test($('#nombre').val())) {
            error = true;
            $('#nombre').addClass('errorField');
            $('#nombre_help').html('El formato del nombre incorrecto');
        }
        // Campo catpcha
        if ($("#inputCatpcha").val() == "") {
            error = true;
            $('#inputCatpcha').addClass('errorField');
            $('#catpcha_help').html('Campo vacío o incorrecto');
        }

        if (errorCatpcha == true) {
            error = true;
            $('#catpcha_help').html('Campo vacío o incorrecto');
        }
        // Campo lastname
        if ($('#apellidos').val() == "") {
            error = true;
            $('#apellidos').addClass('errorField');
            $('#apellidos_help').html('Campo vacío');
        }
        if ($('#apellidos').val().length > 40) {
            error = true;
            $('#apellidos').addClass('errorField');
            $('#apellidos_help').html('El valor no puede exceder los 40 caracteres');
        }
        // Campo password
        if ($('#password').val() == "") {
            error = true;
            $('#password').addClass('errorField');
            $('#password_help').html('El campo no puede vacío');
        }
        if ($('#password').val() != $('#password1').val()) {
            error = true;
            $('#password').addClass('errorField');
            $('#password_help').html('Las contraseñas no coinciden');
        }
        var regExpUppercase = /[A-Z]+/;
        var regExpLowercase = /[a-z]+/;
        var regExpDigit = /[0-9]+/;
        //Si la contraseña no contiene al menos una MAYUS, un minus, un Digit y es menor de 8 caracteres, no sera valida
        if (!regExpUppercase.test($('#password').val()) ||
            !regExpLowercase.test($('#password').val()) ||
            !regExpDigit.test($('#password').val()) ||
            $('#password').val().length < 8) {
            error = true;
            $('#password').addClass('errorField');
            $('#password_help').html('Elige una contraseña mas compleja');
        }



        // Validación condicional. Solo se produce si se cumplen las condiciones
        if (error) {
            $('#error').css('display', 'block');
            event.preventDefault();
        }
        else if ($('#tipo_1').is(':checked')) {
            //Campo tipo de gestor
            var rango = 0;
            if ($('#labor_1').is(':checked')) {
                rango = 1;
            }
            if ($('#labor_2').is(':checked')) {
                rango = 2;
            }
            if (rango != 1 || rango != 2) {
                error = true;
                $('#apps').addClass('errorField');
                $('#apps_help').html('Marca al menos un tipo de gestor');
            }
        }
    });
    
    // Validación de datos antes de enviar
    $('#btEnviarProyecto').click(function (event) {
        var error = false;
        $('.help').html('');
        $('.field').removeClass('errorField');
        $('#proyectoNombre').removeClass('errorField');
        $('#proyectoDescripcion').removeClass('errorField');
        $('#proyectoResponsable').removeClass('errorField');
        $('#proyectoInicio').removeClass('errorField');
        $('#proyectoFin').removeClass('errorField');
        $('#proyectoArchive').removeClass('proyectoArchive');
        $('#proyectoEstado').removeClass('errorField');
        
        
         if (new Date(proyectoFin) < new Date(proyectoInicio)) {
            alert("La Fecha de Fin no puede ser antes que la Fecha de Inicio");
            return false;
        }
        
        // Campo nombre
        if ($('#proyectoNombre').val() == "") {
            error = true;
            $('#proyectoNombre').addClass('errorField');
            $('#proyectoNombre_help').html('Campo vacío');
        }

        if ($('#proyectoNombre').val().length > 50) {
            error = true;
            $('#proyectoNombre').addClass('errorField');
            $('#proyectoNombre_help').html('Nombre no puede ser mayor de 50 caracteres');
        }
       
        if ($('#proyectoDescripcion').val() == "") {
            error = true;
            $('#proyectoDescripcion').addClass('errorField');
            $('#proyectoDescripcion_help').html('Campo vacío');
        }
        if ($('#proyectoArchive').val() == "") {
            error = true;
            $('#proyectoArchive').addClass('errorField');
            $('#proyectoArchive_help').html('Campo vacío');
        }
        
    });

    $("#btEditarProyecto").click(function () {
        event.preventDefault();
        $("#proyectoNombre2").prop('disabled', false);
        $("#proyectoDescripcion2").prop('disabled', false);
        $("#proyectoInicio2").prop('disabled', false);
        $("#proyectoFin2").prop('disabled', false);
        $("#proyectoResponsable2").prop('disabled', false);
        $("#btEnviar2").css("display", "inline");
    });
    
        // Validación de datos antes de enviar
    $('#btEnviarReunion').click(function (event) {
        var error = false;
        $('.help').html('');
        $('.field').removeClass('errorField');
        $('#tituloReunion').removeClass('errorField');
        $('#fechaReunion').removeClass('errorField');
        $('#horaReunion').removeClass('errorField');
        $('#lugarReunion').removeClass('errorField');
        $('#descripcionReunion').removeClass('errorField');
        
        
        if ($('#tituloReunion').val() == "") {
            error = true;
            $('#tituloReunion').addClass('errorField');
            $('#tituloReunion_help').html('Campo vacío');
        }

        if ($('#tituloReunion').val().length > 50) {
            error = true;
            $('#tituloReunion').addClass('errorField');
            $('#tituloReunion_help').html('Nombre no puede ser mayor de 50 caracteres');
        }
       
        if ($('#descripcionReunion').val() == "") {
            error = true;
            $('#descripcionReunion').addClass('errorField');
            $('#descripcionReunion_help').html('Campo vacío');
        }
        if ($('#fechaReunion').val() == "") {
            error = true;
            $('#fechaReunion').addClass('errorField');
            $('#fechaReunion_help').html('Campo vacío');
        }
        if ($('#lugarReunion').val() == "") {
            error = true;
            $('#lugarReunion').addClass('errorField');
            $('#lugarReunion_help').html('Campo vacío');
        }
        
    });

});  