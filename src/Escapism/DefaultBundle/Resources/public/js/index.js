$(function () {
    "use strict";
    $("#menu").on("click", function (e) {
        e.preventDefault();
        $("nav.blog-nav").toggleClass("active");
    });

    $("a", "li").on("click", function (e) {
        $("nav.blog-nav").removeClass("active");
    });
});

$(function validateNewsletterForm() {
    $("input").blur(function () {
        $(this).valid();
    }).change(function () {
        $(this).valid();
    });

    $("#newsletter_signup").validate({
        rules: {
            "newsletter_signup[firstName]": "required",
            "newsletter_signup[lastName]": "required",
            "newsletter_signup[email]": {
                required: true,
                email: true
            }
        },
        messages: {
            "newsletter_signup[firstName]": "Required",
            "newsletter_signup[lastName]": "Required",
            "newsletter_signup[email]": {
                required: "Required",
                email: "Please enter a valid email address"
            }
        },
        errorPlacement: function (error, element) {
            if (element.is(":radio")) {
                error.appendTo(element.parent().parent());
            }
            else if (element.is(":checkbox")) {
                error.appendTo(element.parent().next());
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
                // $(element).parent().addClass("error");
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
                // $(element).parent().removeClass("error");
            }
            else {
                $(element).removeClass("error");
            }
            $(element).parents('.form-row').removeClass('error');
        }
    });
});