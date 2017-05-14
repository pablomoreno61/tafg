$(document).ready(function() {
    // Try submit with enter key press
    $('input.form-control-solid').keypress(function(e) {
        if (e.which == 13) {
            $('#login-form').submit();
            return false;
        }
    });

    $('#login-form').validate({
        errorElement : 'span', //default input error message container
        errorClass : 'help-block', // default input error message class
        focusInvalid : false, // do not focus the last invalid input
        rules : {
            email: {
                email: true,
                required: true
            },
            password: {
                required: true,
                minlength: 5
            },
            remember : {
                required : false
            }
        },
        messages : {
            email: {
                email: "Format d'email incorrecte",
                required: "Email requerit"
            },
            password: {
                required: "Contrasenya requerida",
                minlength: "La contrasenya ha de tenir almenys 5 caracters"
            }
        },
        submitHandler : function() {
            var dataString = $("#login-form").serialize();
            $.ajax({
                type : "POST",
                url : 'login/login',
                data : dataString,
                cache : false,
                success : function(response) {
                    if (response.success) {
                        window.location = response.data.url;
                    } else {
                        $("#alert-message").removeClass('hide');
                    }
                }
            });
        }
    });
});
