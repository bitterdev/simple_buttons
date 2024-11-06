(function ($) {
    $(function () {
        $(".btn").each(function () {
            let $btn = $(this), $i = null, iconPosition, btnText = $btn.text().trim();

            if ($btn.find("i").length) {
                $i = $btn.find("i").clone();
                iconPosition = ($btn.html().trim().substr(0, 2).toLowerCase() === "<i") ? "left" : "right";
            }

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

        });
    });
})(jQuery);