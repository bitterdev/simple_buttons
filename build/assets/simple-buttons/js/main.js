(function ($) {
    $(function () {
        // Replace old input buttons with button elements
        $(".ccm-page input.btn[type='submit'], .ccm-btn-preview-container input.btn[type='submit']").each(function () {
            let $originalBtn = $(this);
            let $newBtn = $("<button/>");

            $.each($originalBtn.get(0).attributes, function() {
                if (this.specified) {
                    $newBtn.attr(this.name, this.value);
                }
            });

            $newBtn.html($originalBtn.attr("value"));
            $newBtn.removeAttr("value");

            $originalBtn.replaceWith($newBtn);
        });

        window.processButtons = function () {
            $(".ccm-page .btn, .ccm-btn-preview-container .btn, .cm__btn, .pm__btn").each(function () {
                let $btn = $(this), $i = null, iconPosition, btnText = $btn.text().trim();

                // Process all buttons that are not build with the button generator
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

                // Append Hover Glow Element
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
        };

        window.processButtons();
    });
})(jQuery);