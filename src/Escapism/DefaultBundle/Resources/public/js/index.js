$(function () {
    $("#menu").on("click", function (e) {
        e.preventDefault();
        $("nav.blog-nav").toggleClass("active");
    });

    $("a", "li").on("click", function (e) {
        $("nav.blog-nav").removeClass("active");
    });

    $("input").blur(function () {
        $(this).valid();
    }).change(function () {
        $(this).valid();
    });

    $("#newsletter-signup-form").validate({
        rules: {
            "newsletter_signup[firstName]": "required",
            "newsletter_signup[surname]": "required",
            "newsletter_signup[email]": {
                required: true,
                email: true
            },
            "newsletter_signup[termsConditions]": "required"
        },
        messages: {
            "newsletter_signup[firstName]": "Required",
            "newsletter_signup[surname]": "Required",
            "newsletter_signup[email]": {
                required: "Required",
                email: "Please enter a valid email address"
            },
            "newsletter_signup[termsConditions]": "You must accept our terms & conditions"
        },
        errorPlacement: function (error, element) {
            if (element.is(":radio")) {
                error.appendTo(element.parent().parent());
            }
            else if (element.is(":checkbox")) {
                error.appendTo(element.parents('.form-row.form-checkbox-row'));
            }
            else {
                error.insertAfter(element);
                error.appendTo(element.parents('div.form-input'));
            }
        },
        highlight: function (element) {
            if ($(element).is(":radio")) {
                $(element).parent().addClass("error");
            }
            else if ($(element).is(":checkbox")) {
                $(element).parent().addClass("error");
            }
            else {
                $(element).addClass("error");
            }
            $(element).parents('.form-row').addClass('error');
        },
        unhighlight: function (element) {
            if ($(element).is(":radio")) {
                $(element).parent().removeClass("error");
            }
            else if ($(element).is(":checkbox")) {
                $(element).parent().removeClass("error");
            }
            else {
                $(element).removeClass("error");
            }
            $(element).parents('.form-row').removeClass('error');
        },
        submitHandler: function (form) {
            var $url = $(form).attr('action');
            var $method = $(form).attr('method');
            var $data = $(form).serialize();
            var jqxhr = $.ajax({
                type: $method,
                url: $url,
                data: $data,
                dataType: 'json',
                success: function (response) {
                    if ('success' === response.status) {
                        $('form').hide();
                        $('#msg').addClass('success').html(response.message).fadeIn('slow');
                    } else {
                        $('#msg').addClass('error').html(response.message).delay(5000).fadeOut('slow');
                    }
                }
            });

            jqxhr.always(function (response) {
                console.log(response)
            })
        }
    });

    $("#enquiry-form").validate({
        rules: {
            "enquiry[name]": "required",
            "enquiry[subject]": "required",
            "enquiry[email]": {
                required: true,
                email: true
            },
            "enquiry[usermessage]": "required",
            "enquiry[spamCheck]": "required"
        },
        messages: {
            "enquiry[name]": "Required",
            "enquiry[subject]": "Required",
            "enquiry[email]": {
                required: "Required",
                email: "Please enter a valid email address"
            },
            "enquiry[usermessage]": "Please enter a message",
            "enquiry[spamCheck]": "Are you human?"
        },
        errorPlacement: function (error, element) {
            if (element.is(":radio")) {
                error.appendTo(element.parent().parent());
            }
            else if (element.is(":checkbox")) {
                error.appendTo(element.parents('.form-row.form-checkbox-row'));
            }
            else {
                error.insertAfter(element);
                error.appendTo(element.parents('div.form-input'));
            }
        },
        highlight: function (element) {
            if ($(element).is(":radio")) {
                $(element).parent().addClass("error");
            }
            else if ($(element).is(":checkbox")) {
                $(element).parent().addClass("error");
            }
            else {
                $(element).addClass("error");
            }
            $(element).parents('.form-row').addClass('error');
        },
        unhighlight: function (element) {
            if ($(element).is(":radio")) {
                $(element).parent().removeClass("error");
            }
            else if ($(element).is(":checkbox")) {
                $(element).parent().removeClass("error");
            }
            else {
                $(element).removeClass("error");
            }
            $(element).parents('.form-row').removeClass('error');
        },
        submitHandler: function (form) {
            var $url = $(form).attr('action');
            var $method = $(form).attr('method');
            var $data = $(form).serialize();
            var jqxhr = $.ajax({
                type: $method,
                url: $url,
                data: $data,
                dataType: 'json',
                success: function (response) {
                    if ('success' === response.status) {
                        $('form').hide();
                        $('#msg').addClass('success').html(response.message).fadeIn('slow');
                    } else {
                        $('#msg').addClass('error').html(response.message).delay(5000).fadeOut('slow');
                    }
                }
            });

            jqxhr.always(function (response) {
                console.log(response)
            })
        }
    })
});