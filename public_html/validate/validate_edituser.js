$(document).ready(function() {
    $("#edituserform").validate({
        ignore: ".ignore",
        rules: {
            password: {
                required: false,
                minlength: 8
            },
            fullname: {
                required: true,
                maxlength: 50,
                pattern: /^[a-zA-Z0-9' ']+$/
            }
        },

        messages: {
            fullname: {
                pattern: "No special characters, please."
            },
        }
    });
});
