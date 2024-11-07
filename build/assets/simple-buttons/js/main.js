(function ($) {
    $(function () {


        $(".btn").each(function () {
            let $btn = $(this), $i = null, iconPosition, btnText = $btn.text().trim();

            if (!$btn.hasClass("btn-processed-text")) {
                if ($btn.find("i").length) {
                    $i = $btn.find("i").clone();
                    iconPosition = ($btn.html().trim().substr(0, 2).toLowerCase() === "<i") ? "left" : "right";
                    $btn.addClass("btn-has-icon");
                }

                $btn.addClass(CCM_BUTTON_CLASSES);

                $btn.html("");

                btnText = " " + btnText;

                let btnTextFormatted = "";

                for (let i = 0; i <= btnText.length; i++) {
                    let b = btnText.substr(i, 1);

                    if (b === " ") {
                        b = "&nbsp;"
                    }

                    btnTextFormatted += "<span>" + b + "</span>";
                }

                $btn.append($("<div/>").addClass("label").html(btnTextFormatted));

                if ($i !== null) {
                    if (iconPosition === "left") {
                        $btn.prepend($i);
                    } else {
                        $btn.append($i);
                    }
                }

                $btn.addClass("btn-processed-text")
            }

            $btn.append($("<div/>").addClass("hover-glow").css({display: "none"}));

            $btn.on({
                'mousemove': function (e) {
                    if ($btn.hasClass("btn-hover-animation-5") && !$btn.hasClass("disabled")) {
                        let x = e.pageX - $btn.offset().left;
                        let y = e.pageY - $btn.offset().top;

                        $btn.find('.hover-glow').css({
                            'display': 'block',
                            'transform': 'translate(' + x + 'px,' + y + 'px)',
                            'opacity': 1
                        });
                    }
                },
                'mouseleave': function () {
                    if ($btn.hasClass("btn-hover-animation-5") && !$btn.hasClass("disabled")) {
                        $btn.find('.hover-glow').css({
                            'opacity': 0
                        });
                    }
                }
            })

        });
    });
})(jQuery);