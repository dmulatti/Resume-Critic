$(document).ready(function() {
    $("#newuserform").validate({
        ignore: ".ignore",
        rules: {
            uwinid: {
                required: true,
                maxlength: 20,
                pattern: /^[a-zA-Z0-9]+$/,
                remote: 'checkuwinid.php'
            },
            password: {
                required: true,
                minlength: 8
            },
            fullname: {
                required: true,
                maxlength: 50,
                pattern: /^[a-zA-Z0-9' ']+$/
            },

            hiddenRecaptcha: {
                required: function() {
                    if (grecaptcha.getResponse() == '')
                        return true;
                    else
                        return false;
                }
            }
        },

        messages: {
            uwinid: {
                pattern: "Alphanumeric characters only. You don't need to add @uwindsor.ca!",
                remote: "Account already exists!"
            },
            fullname: {
                pattern: "No special characters, please."
            },
            hiddenRecaptcha: {
                required: "Please prove you are a human."
            }
        }
    });
});
