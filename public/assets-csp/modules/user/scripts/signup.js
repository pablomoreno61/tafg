$(document).ready(function() {
    //custom validation rule
    $.validator.addMethod( //override email with django email validator regex
        'email',
        function(value, element){
            return this.optional(element) || /(^[-!#$%&'*+/=?^_`{}|~0-9A-Z]+(\.[-!#$%&'*+/=?^_`{}|~0-9A-Z]+)*|^"([\001-\010\013\014\016-\037!#-\[\]-\177]|\\[\001-\011\013\014\016-\177])*")@((?:[A-Z0-9](?:[A-Z0-9-]{0,61}[A-Z0-9])?\.)+(?:[A-Z]{2,6}\.?|[A-Z0-9-]{2,}\.?)$)|\[(25[0-5]|2[0-4]\d|[0-1]?\d?\d)(\.(25[0-5]|2[0-4]\d|[0-1]?\d?\d)){3}\]$/i.test(value);
        },
        "Verifica l'adreça de e-email"
    );

    $('#signup-form').validate({
        errorElement: 'span', //default input error message container
        errorClass: 'help-block', // default input error message class
        focusInvalid: false, // do not focus the last invalid input
        ignore: "",
        rules: {
            email: {
                email: true,
                required: true
            },
            password: {
                required: true,
                minlength: 5
            },
            repassword: {
                required: true,
                equalTo: "#password"
            },
            isPrivacyPolicyAccepted: {
                required: true
            }
        },
        messages: {
            email: {
                email: "Format d'email incorrecte",
                required: "Email requerit"
            },
            password: {
                required: "Contrasenya requerida",
                minlength: "La contrasenya ha de tenir almenys 5 caracters"
            },
            repassword: {
                required: "Repeteix la contrasenya",
                equalTo: "Les contrasenyes han de coincidir"
            },
            isPrivacyPolicyAccepted: {
                required: "Sisplau, accepti les condicions"
            }
        },
        submitHandler: function() {
            var dataString = $("#signup-form").serialize();
            $.ajax(
                {
                    type: "POST",
                    url: '/signup/signup',
                    data: dataString,
                    dataType: 'json',
                    cache: false,
                    success: function(response) {
                        if (response.success) {
                            window.location = response.data.url;
                        } else {
                            $("#alert-message").removeClass('hide');
                        }
                    }
                }
            );
            return false;
        }
    });
});
