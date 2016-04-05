$(document).ready(function() {
    $("#contactForm").validate({
        ignore: ".ignore",
        rules: {
            contactName: {
                required: true,
                maxlength: 50,
                pattern: /^[a-zA-Z0-9' ']+$/
            },

            contactEmail: {
                required: true,
                email: true,
                maxlength: 50
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
            contactName: {
                pattern: "No special characters, please."
            },
            hiddenRecaptcha: {
                required: "Please prove you are a human."
            }
        }
    });
});
