<?php

defined('C5_EXECUTE') or die('Access Denied.');

use Bitter\SimpleButtons\Buttons\Builder;
use Bitter\SimpleButtons\Buttons\Button;
use Bitter\SimpleButtons\Buttons\Enumerations\ButtonStyle;
use Bitter\SimpleButtons\Buttons\Enumerations\IconPosition;
use Concrete\Core\Form\Service\Form;
use Concrete\Core\Support\Facade\Application;
use Concrete\Core\Validation\CSRF\Token;

$app = Application::getFacadeApplication();
/** @var Form $form */
/** @noinspection PhpUnhandledExceptionInspection */
$form = $app->make(Form::class);
/** @var Builder $buttonBuilder */
/** @noinspection PhpUnhandledExceptionInspection */
$buttonBuilder = $app->make(Builder::class);
/** @var Token $token */
/** @noinspection PhpUnhandledExceptionInspection */
$token = $app->make(Token::class);

/** @var string|null $roundedCornerStyle */
/** @var string|null $shadowStyle */
/** @var bool|null $hasAnimatedText */
/** @var bool|null $hasRoundedIcon */
/** @var bool|null $hasAnimatedIcon */
/** @var bool|null $animatedOnHover */
/** @var string|null $backgroundStyle */

$hasAnimatedText = $hasAnimatedText ?? false;
$hasRoundedIcon = $hasRoundedIcon ?? false;
$hasAnimatedIcon = $hasAnimatedIcon ?? false;
$animatedOnHover = $animatedOnHover ?? false;
$backgroundStyle = $backgroundStyle ?? null;
$shadowStyle = $shadowStyle ?? null;
$roundedCornerStyle = $roundedCornerStyle ?? null;

$backgroundStyles = [
    "" => t("Solid Color"),
    "btn-gradient-direction-bottom" => t("Gradient (Top to Bottom)"),
    "btn-gradient-direction-top" => t("Gradient (Bottom to Top)"),
    "btn-gradient-direction-left" => t("Gradient (Right to Left)"),
    "btn-gradient-direction-right" => t("Gradient (Left to Right)"),
];

$shadowStyles = [
    "" => t("No Shadow"),
    "btn-shadow-style-1" => t("Shadow Style 1"),
    "btn-shadow-style-2" => t("Shadow Style 2"),
    "btn-shadow-style-3" => t("Shadow Style 3"),
    "btn-shadow-style-4" => t("Shadow Style 4"),
    "btn-shadow-style-5" => t("Shadow Style 5"),
    "btn-shadow-style-6" => t("Shadow Style 6"),
    "btn-shadow-style-7" => t("Shadow Style 7"),
    "btn-shadow-style-8" => t("Shadow Style 8"),
    "btn-shadow-style-9" => t("Shadow Style 9"),
    "btn-shadow-style-10" => t("Shadow Style 10"),
];

$roundedCornerStyles = [
    "" => t("Solid Color"),
    "btn-rounded-corners-5" => t("Rounded Corners (5px)"),
    "btn-rounded-corners-10" => t("Rounded Corners (10px)"),
    "btn-rounded-corners-15" => t("Rounded Corners (15px)"),
    "btn-rounded-corners-20" => t("Rounded Corners (20px)"),
    "btn-rounded-corners-25" => t("Rounded Corners (25px)"),
    "btn-rounded-corners-30" => t("Rounded Corners (30px)"),
    "btn-rounded-corners-35" => t("Rounded Corners (35px)"),
    "btn-rounded-corners-40" => t("Rounded Corners (40px)"),
    "btn-rounded-corners-45" => t("Rounded Corners (45px)")
];
?>

<form action="#" method="post">
    <?php echo $token->output("update_options"); ?>

    <div class="container">
        <div class="row">
            <div class="col-md-6 col-lg-8 col-sm-12">
                <div class="style-configurator">
                    <div class="form-group">
                        <?php echo $form->label("backgroundStyle", "Background Style"); ?>
                        <?php echo $form->select("backgroundStyle", $backgroundStyles, $backgroundStyle); ?>
                    </div>

                    <div class="form-group">
                        <?php echo $form->label("shadowStyle", "Shadow Style"); ?>
                        <?php echo $form->select("shadowStyle", $shadowStyles, $shadowStyle); ?>
                    </div>

                    <div class="form-group">
                        <?php echo $form->label("roundedCornerStyle", "Rounded Corner Style"); ?>
                        <?php echo $form->select("roundedCornerStyle", $roundedCornerStyles, $roundedCornerStyle); ?>
                    </div>

                    <div class="form-group">
                        <div class="form-check">
                            <?php echo $form->checkbox("hasAnimatedText", "btn-animated-text", $hasAnimatedText); ?>
                            <?php echo $form->label("hasAnimatedText", "Has Animated Text"); ?>
                        </div>

                        <div class="form-check">
                            <?php echo $form->checkbox("hasRoundedIcon", "btn-rounded-icon", $hasRoundedIcon); ?>
                            <?php echo $form->label("hasRoundedIcon", "Has Rounded Icon"); ?>
                        </div>

                        <div class="form-check">
                            <?php echo $form->checkbox("hasAnimatedIcon", "btn-animated-icon", $hasAnimatedIcon); ?>
                            <?php echo $form->label("hasAnimatedIcon", "Has Animated Icon"); ?>
                        </div>

                        <div class="form-check">
                            <?php echo $form->checkbox("animatedOnHover", "btn-animated-on-hover", $animatedOnHover); ?>
                            <?php echo $form->label("animatedOnHover", "Animated On Hover"); ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4 col-sm-12">
                <div class="form-group">
                    <div class="ccm-btn-preview-container border p-3">
                        <?php
                        echo $buttonBuilder->render((new Button())
                            ->setLabel("Lorem Ipsum")
                            ->setIconPosition(IconPosition::ICON_POSITION_LEFT)
                            ->setButtonStyle(ButtonStyle::BUTTON_STYLE_PRIMARY)
                            ->setIcon("fas fa-times")
                            ->setApplyOptions(false)
                        );
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .ccm-btn-preview-container {
            aspect-ratio: 1 / 1;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f7f7f7;
        }
    </style>

    <script>
        (function ($) {
            $(function () {
                $(".style-configurator").find("select, input").change(function () {
                    let classes = [];

                    if ($("#backgroundStyle").val().length) {
                        classes.push($("#backgroundStyle").val());
                    }

                    if ($("#shadowStyle").val().length) {
                        classes.push($("#shadowStyle").val());
                    }

                    if ($("#roundedCornerStyle").val().length) {
                        classes.push($("#roundedCornerStyle").val());
                    }

                    if ($("#hasAnimatedText").is(":checked")) {
                        classes.push($("#hasAnimatedText").val());
                    }

                    if ($("#hasRoundedIcon").is(":checked")) {
                        classes.push($("#hasRoundedIcon").val());
                    }

                    if ($("#hasAnimatedIcon").is(":checked")) {
                        classes.push($("#hasAnimatedIcon").val());
                    }

                    if ($("#animatedOnHover").is(":checked")) {
                        classes.push($("#animatedOnHover").val());
                    }

                    $(".ccm-btn-preview-container .btn").each(function () {
                        let $btn = $(this);

                        if ($btn.data("originalClasses") === null ||
                            typeof $btn.data("originalClasses") === "undefined") {
                            $btn.data("originalClasses", $btn.attr("class"))
                        } else {
                            $btn.attr("class", $btn.data("originalClasses"))
                        }

                        for (let cssClass of classes) {
                            $btn.addClass(cssClass);
                        }
                    });
                }).trigger("change");
            });
        })(jQuery);
    </script>

    <div class="ccm-dashboard-form-actions-wrapper">
        <div class="ccm-dashboard-form-actions">
            <?php echo $form->submit('save', t('Save'), ['class' => 'btn btn-primary float-end']); ?>
        </div>
    </div>
</form>


