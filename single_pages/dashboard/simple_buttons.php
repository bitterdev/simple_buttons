<?php

defined('C5_EXECUTE') or die('Access Denied.');

use Bitter\SimpleButtons\Buttons\Enumerations\ButtonSize;
use Bitter\SimpleButtons\Buttons\Enumerations\ButtonStyle;
use Bitter\SimpleButtons\Buttons\Enumerations\IconPosition;
use Concrete\Core\Form\Service\Widget\Color;
use Concrete\Core\Support\Facade\Application;
use Concrete\Core\Validation\CSRF\Token;
use Concrete\Core\Form\Service\Form;
use Concrete\Core\View\View;
use Concrete\Core\Application\Service\UserInterface;
use Bitter\SimpleButtons\Buttons\Builder;
use Bitter\SimpleButtons\Buttons\Button;

/** @var array $iconClasses */
/** @var array $fontWeightClasses */
/** @var array $hoverAnimationClasses */
/** @var array $shadowClasses */
/** @var array $roundedCornerClasses */
/** @var array $backgroundClasses */

/** @var string $additionalClasses */
/** @var string $primaryButtonRegularTextColor */
/** @var string $primaryButtonRegularBackgroundColor */
/** @var string $primaryButtonRegularBorderColor */
/** @var string $primaryButtonActiveTextColor */
/** @var string $primaryButtonActiveBackgroundColor */
/** @var string $primaryButtonActiveBorderColor */
/** @var string $primaryButtonDisabledTextColor */
/** @var string $primaryButtonDisabledBackgroundColor */
/** @var string $primaryButtonDisabledBorderColor */
/** @var string $secondaryButtonRegularTextColor */
/** @var string $secondaryButtonRegularBackgroundColor */
/** @var string $secondaryButtonRegularBorderColor */
/** @var string $secondaryButtonActiveTextColor */
/** @var string $secondaryButtonActiveBackgroundColor */
/** @var string $secondaryButtonActiveBorderColor */
/** @var string $secondaryButtonDisabledTextColor */
/** @var string $secondaryButtonDisabledBackgroundColor */
/** @var string $secondaryButtonDisabledBorderColor */

$app = Application::getFacadeApplication();
/** @var Form $form */
/** @noinspection PhpUnhandledExceptionInspection */
$form = $app->make(Form::class);
/** @var Token $token */
/** @noinspection PhpUnhandledExceptionInspection */
$token = $app->make(Token::class);
/** @var Color $colorPicker */
/** @noinspection PhpUnhandledExceptionInspection */
$colorPicker = $app->make(Color::class);
/** @var UserInterface $ui */
/** @noinspection PhpUnhandledExceptionInspection */
$ui = $app->make(UserInterface::class);
/** @var Builder $buttonBuilder */
/** @noinspection PhpUnhandledExceptionInspection */
$buttonBuilder = $app->make(Builder::class);

?>

<div class="ccm-dashboard-header-buttons">
    <?php
    /** @noinspection PhpUnhandledExceptionInspection */
    View::element("dashboard/help", [], "simple_buttons");
    ?>
</div>

<?php \Concrete\Core\View\View::element("dashboard/did_you_know", [], "simple_buttons"); ?>

<form action="#" method="post">
    <?php echo $token->output("update_settings"); ?>

    <?php echo $form->hidden("additionalClasses", $additionalClasses); ?>


    <?php echo $ui->tabs([
        ['general', t('General'), true],
        ['primary-button', t('Primary Button'), false],
        ['secondary-button', t('Secondary Button'), false],
        ['full-preview', t('Full Preview'), false],
    ]); ?>

    <div class="tab-content">
        <div class="tab-pane active" id="general" role="tabpanel">
            <div class="row">
                <div class="col-md-8 col-lg-8 col-sm-12">
                    <div class="style-configurator">
                        <div class="form-group">
                            <?php echo $form->label("backgroundClass", "Background"); ?>
                            <?php echo $form->select("backgroundClass", $backgroundClasses); ?>
                        </div>

                        <div class="form-group">
                            <?php echo $form->label("shadowClass", "Shadow"); ?>
                            <?php echo $form->select("shadowClass", $shadowClasses); ?>
                        </div>

                        <div class="form-group">
                            <?php echo $form->label("roundedCornerClass", "Rounded Corner"); ?>
                            <?php echo $form->select("roundedCornerClass", $roundedCornerClasses); ?>
                        </div>

                        <div class="form-group">
                            <?php echo $form->label("iconClass", "Icon"); ?>
                            <?php echo $form->select("iconClasses", $iconClasses); ?>
                        </div>

                        <div class="form-group">
                            <?php echo $form->label("hoverAnimationClass", "Hover Animation"); ?>

                            <?php $i = 0; ?>

                            <?php foreach ($hoverAnimationClasses as $key => $value) { ?>
                                <?php $i++; ?>

                                <div class="form-check">
                                    <?php echo $form->checkbox("hoverAnimationClass-" . $i, $key, false); ?>
                                    <?php echo $form->label("hoverAnimationClass-" . $i, $value); ?>
                                </div>
                            <?php } ?>
                        </div>

                        <div class="form-group">
                            <?php echo $form->label("fontWeightClass", "Font Weight"); ?>
                            <?php echo $form->select("fontWeightClass", $fontWeightClasses); ?>
                        </div>

                        <div class="form-group">
                            <div class="form-check">
                                <?php echo $form->checkbox("textUppercase", "btn-text-uppercase", false); ?>
                                <?php echo $form->label("textUppercase", "Text Uppercase"); ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 col-lg-4 col-sm-12">
                    <div class="form-group">
                        <div class="ccm-btn-preview-container border ccm-btn-small-preview">
                            <div class="row justify-content-center align-items-center p-3">
                                <?php foreach ([ButtonStyle::BUTTON_STYLE_PRIMARY, ButtonStyle::BUTTON_STYLE_SECONDARY] as $buttonStyle) {
                                    echo $buttonBuilder->render((new Button())
                                        ->setLabel($buttonStyle === ButtonStyle::BUTTON_STYLE_PRIMARY ? t("Primary Button") : t("Secondary Button"))
                                        ->setSize(ButtonSize::BUTTON_SIZE_REGULAR)
                                        ->setIconPosition(IconPosition::ICON_POSITION_LEFT)
                                        ->setButtonStyle($buttonStyle)
                                        ->setIcon("fas fa-times")
                                        ->setApplyOptions(false)
                                    );
                                } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="tab-pane" id="primary-button" role="tabpanel">
            <div class="row">
                <div class="col-md-8 col-lg-8 col-sm-12">
                    <fieldset>
                        <legend>
                            <?php echo t("Regular State"); ?>
                        </legend>

                        <div class="form-group">
                            <?php echo $form->label("primaryButtonRegularTextColor", t("Text Color")); ?>

                            <div>
                                <?php $colorPicker->output("primaryButtonRegularTextColor", $primaryButtonRegularTextColor); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <?php echo $form->label("primaryButtonRegularBackgroundColor", t("Background Color")); ?>

                            <div>
                                <?php $colorPicker->output("primaryButtonRegularBackgroundColor", $primaryButtonRegularBackgroundColor); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <?php echo $form->label("primaryButtonRegularBorderColor", t("Border Color")); ?>

                            <div>
                                <?php $colorPicker->output("primaryButtonRegularBorderColor", $primaryButtonRegularBorderColor); ?>
                            </div>

                            <p class="help-block">
                                <?php echo t("Note: For outline buttons, the border color is also used as the text color."); ?>
                            </p>
                        </div>
                    </fieldset>

                    <fieldset>
                        <legend>
                            <?php echo t("Active State"); ?>
                        </legend>

                        <div class="form-group">
                            <?php echo $form->label("primaryButtonActiveTextColor", t("Text Color")); ?>

                            <div>
                                <?php $colorPicker->output("primaryButtonActiveTextColor", $primaryButtonActiveTextColor); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <?php echo $form->label("primaryButtonActiveBackgroundColor", t("Background Color")); ?>

                            <div>
                                <?php $colorPicker->output("primaryButtonActiveBackgroundColor", $primaryButtonActiveBackgroundColor); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <?php echo $form->label("primaryButtonActiveBorderColor", t("Border Color")); ?>

                            <div>
                                <?php $colorPicker->output("primaryButtonActiveBorderColor", $primaryButtonActiveBorderColor); ?>
                            </div>
                        </div>
                    </fieldset>

                    <fieldset>
                        <legend>
                            <?php echo t("Disabled State"); ?>
                        </legend>

                        <div class="form-group">
                            <?php echo $form->label("primaryButtonDisabledTextColor", t("Text Color")); ?>

                            <div>
                                <?php $colorPicker->output("primaryButtonDisabledTextColor", $primaryButtonDisabledTextColor); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <?php echo $form->label("primaryButtonDisabledBackgroundColor", t("Background Color")); ?>

                            <div>
                                <?php $colorPicker->output("primaryButtonDisabledBackgroundColor", $primaryButtonDisabledBackgroundColor); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <?php echo $form->label("primaryButtonDisabledBorderColor", t("Border Color")); ?>

                            <div>
                                <?php $colorPicker->output("primaryButtonDisabledBorderColor", $primaryButtonDisabledBorderColor); ?>
                            </div>
                        </div>
                    </fieldset>
                </div>

                <div class="col-md-4 col-lg-4 col-sm-12">
                    <div class="form-group">
                        <div class="ccm-btn-preview-container border ccm-btn-small-preview">
                            <div class="row justify-content-center align-items-center p-3">
                                <?php foreach ([false, true] as $outline) {
                                    echo $buttonBuilder->render((new Button())
                                        ->setLabel($outline ? t("Primary Button %s", t("(Outline)")) : t("Primary Button %s", t("(Regular)")))
                                        ->setSize(ButtonSize::BUTTON_SIZE_REGULAR)
                                        ->setIconPosition(IconPosition::ICON_POSITION_LEFT)
                                        ->setOutline($outline)
                                        ->setButtonStyle(ButtonStyle::BUTTON_STYLE_PRIMARY)
                                        ->setIcon("fas fa-times")
                                        ->setApplyOptions(false)
                                    );
                                } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="tab-pane" id="secondary-button" role="tabpanel">
            <div class="row">
                <div class="col-md-8 col-lg-8 col-sm-12">
                    <fieldset>
                        <legend>
                            <?php echo t("Regular State"); ?>
                        </legend>

                        <div class="form-group">
                            <?php echo $form->label("secondaryButtonRegularTextColor", t("Text Color")); ?>

                            <div>
                                <?php $colorPicker->output("secondaryButtonRegularTextColor", $secondaryButtonRegularTextColor); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <?php echo $form->label("secondaryButtonRegularBackgroundColor", t("Background Color")); ?>

                            <div>
                                <?php $colorPicker->output("secondaryButtonRegularBackgroundColor", $secondaryButtonRegularBackgroundColor); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <?php echo $form->label("secondaryButtonRegularBorderColor", t("Border Color")); ?>

                            <div>
                                <?php $colorPicker->output("secondaryButtonRegularBorderColor", $secondaryButtonRegularBorderColor); ?>
                            </div>

                            <p class="help-block">
                                <?php echo t("Note: For outline buttons, the border color is also used as the text color."); ?>
                            </p>
                        </div>
                    </fieldset>

                    <fieldset>
                        <legend>
                            <?php echo t("Active State"); ?>
                        </legend>

                        <div class="form-group">
                            <?php echo $form->label("secondaryButtonActiveTextColor", t("Text Color")); ?>

                            <div>
                                <?php $colorPicker->output("secondaryButtonActiveTextColor", $secondaryButtonActiveTextColor); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <?php echo $form->label("secondaryButtonActiveBackgroundColor", t("Background Color")); ?>

                            <div>
                                <?php $colorPicker->output("secondaryButtonActiveBackgroundColor", $secondaryButtonActiveBackgroundColor); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <?php echo $form->label("secondaryButtonActiveBorderColor", t("Border Color")); ?>

                            <div>
                                <?php $colorPicker->output("secondaryButtonActiveBorderColor", $secondaryButtonActiveBorderColor); ?>
                            </div>
                        </div>
                    </fieldset>

                    <fieldset>
                        <legend>
                            <?php echo t("Disabled State"); ?>
                        </legend>

                        <div class="form-group">
                            <?php echo $form->label("secondaryButtonDisabledTextColor", t("Text Color")); ?>

                            <div>
                                <?php $colorPicker->output("secondaryButtonDisabledTextColor", $secondaryButtonDisabledTextColor); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <?php echo $form->label("secondaryButtonDisabledBackgroundColor", t("Background Color")); ?>

                            <div>
                                <?php $colorPicker->output("secondaryButtonDisabledBackgroundColor", $secondaryButtonDisabledBackgroundColor); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <?php echo $form->label("secondaryButtonDisabledBorderColor", t("Border Color")); ?>

                            <div>
                                <?php $colorPicker->output("secondaryButtonDisabledBorderColor", $secondaryButtonDisabledBorderColor); ?>
                            </div>
                        </div>
                    </fieldset>
                </div>

                <div class="col-md-4 col-lg-4 col-sm-12">
                    <div class="form-group">
                        <div class="ccm-btn-preview-container border ccm-btn-small-preview">
                            <div class="row justify-content-center align-items-center p-3">
                                <?php foreach ([false, true] as $outline) {
                                    echo $buttonBuilder->render((new Button())
                                        ->setLabel($outline ? t("Secondary Button %s", t("(Outline)")) : t("Secondary Button %s", t("(Regular)")))
                                        ->setSize(ButtonSize::BUTTON_SIZE_REGULAR)
                                        ->setIconPosition(IconPosition::ICON_POSITION_LEFT)
                                        ->setOutline($outline)
                                        ->setButtonStyle(ButtonStyle::BUTTON_STYLE_SECONDARY)
                                        ->setIcon("fas fa-times")
                                        ->setApplyOptions(false)
                                    );
                                } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="tab-pane" id="full-preview" role="tabpanel">
            <div class="ccm-btn-preview-container border p-3">
                <div class="row">
                    <?php foreach ([IconPosition::ICON_POSITION_LEFT, null, IconPosition::ICON_POSITION_RIGHT] as $iconPosition) { ?>
                        <div class="col">
                            <?php foreach ([ButtonSize::BUTTON_SIZE_SMALL, ButtonSize::BUTTON_SIZE_REGULAR, ButtonSize::BUTTON_SIZE_LARGE] as $buttonSize) {
                                foreach ([ButtonStyle::BUTTON_STYLE_PRIMARY, ButtonStyle::BUTTON_STYLE_SECONDARY] as $buttonStyle) {
                                    foreach ([false, true] as $outline) {
                                        foreach ([false, true] as $disabled) {

                                            $ext = [];

                                            $ext[] = $outline ? t("Outline") : t("Regular");

                                            if ($disabled) {
                                                $ext[] = t("Disabled");
                                            }

                                            $ext[] = $buttonSize === ButtonSize::BUTTON_SIZE_SMALL ? t("Small") : ($buttonSize === ButtonSize::BUTTON_SIZE_LARGE ? t("Large") : t("Regular"));

                                            $label = ($buttonStyle === ButtonStyle::BUTTON_STYLE_PRIMARY ? t("Primary Button") : t("Secondary Button")) . " (" . implode(", ", $ext) . ")";

                                            echo $buttonBuilder->render((new Button())
                                                ->setLabel($label)
                                                ->setIsDisabled($disabled)
                                                ->setOutline($outline)
                                                ->setSize($buttonSize)
                                                ->setIconPosition($iconPosition)
                                                ->setButtonStyle($buttonStyle)
                                                ->setIcon($iconPosition !== null ? "fas fa-times" : "")
                                                ->setApplyOptions(false)
                                            );
                                        }
                                    }
                                }
                            } ?>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>

    <style>
        .ccm-btn-small-preview {
            aspect-ratio: 1 / 1;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .ccm-btn-small-preview .row {
            width: 100%;
        }

        .ccm-btn-small-preview .btn {
            width: 100% !important;
        }

        .ccm-btn-preview-container .btn {
            display: grid !important;
        }

        .ccm-btn-preview-container {
            background-color: #f7f7f7;
        }
    </style>

    <script>
        (function ($) {
            $(function () {

                let classes = $("#additionalClasses").val().split(" ");

                for (let cssClass of classes) {
                    if (cssClass.length > 0) {
                        let $option = $(".style-configurator").find("option[value='" + cssClass + "']");
                        let $checkbox = $(".style-configurator").find("input[value='" + cssClass + "']");

                        if ($option.length) {
                            $option.parent().val(cssClass);
                        } else {
                            $checkbox.prop("checked", "checked");
                        }
                    }
                }

                let colorValues = function (color) {
                    if (color === '')
                        return;
                    if (color.toLowerCase() === 'transparent')
                        return [0, 0, 0, 0];
                    if (color[0] === '#') {
                        if (color.length < 7) {
                            color = '#' + color[1] + color[1] + color[2] + color[2] + color[3] + color[3] + (color.length > 4 ? color[4] + color[4] : '');
                        }
                        return [parseInt(color.substr(1, 2), 16),
                            parseInt(color.substr(3, 2), 16),
                            parseInt(color.substr(5, 2), 16),
                            color.length > 7 ? parseInt(color.substr(7, 2), 16) / 255 : 1];
                    }
                    if (color.indexOf('rgb') === -1) {
                        var temp_elem = document.body.appendChild(document.createElement('fictum'));
                        var flag = 'rgb(1, 2, 3)';
                        temp_elem.style.color = flag;
                        if (temp_elem.style.color !== flag)
                            return;
                        temp_elem.style.color = color;
                        if (temp_elem.style.color === flag || temp_elem.style.color === '')
                            return;
                        color = getComputedStyle(temp_elem).color;
                        document.body.removeChild(temp_elem);
                    }
                    if (color.indexOf('rgb') === 0) {
                        if (color.indexOf('rgba') === -1)
                            color += ',1';
                        return color.match(/[\.\d]+/g).map(function (a) {
                            return +a
                        });
                    }
                }

                let toRgb = function (fromColor) {
                    let colors = colorValues(fromColor);
                    let retVal = "0, 0, 0";

                    if (typeof colors === "object" && colors.length === 4) {
                        retVal = colors[0] + ", " + colors[1] + ", " + colors[2];
                    }

                    console.log(retVal);

                    return retVal;
                }

                $("[data-color-picker]").on("change", function () {
                    let root = document.documentElement;

                    root.style.setProperty('--primary-button-regular-text-color', toRgb($("input[name='primaryButtonRegularTextColor']").val()));
                    root.style.setProperty('--primary-button-regular-background-color', toRgb($("input[name='primaryButtonRegularBackgroundColor']").val()));
                    root.style.setProperty('--primary-button-regular-border-color', toRgb($("input[name='primaryButtonRegularBorderColor']").val()));
                    root.style.setProperty('--primary-button-disabled-text-color', toRgb($("input[name='primaryButtonDisabledTextColor']").val()));
                    root.style.setProperty('--primary-button-disabled-background-color', toRgb($("input[name='primaryButtonDisabledBackgroundColor']").val()));
                    root.style.setProperty('--primary-button-disabled-border-color', toRgb($("input[name='primaryButtonDisabledBorderColor']").val()));
                    root.style.setProperty('--primary-button-active-text-color', toRgb($("input[name='primaryButtonActiveTextColor']").val()));
                    root.style.setProperty('--primary-button-active-background-color', toRgb($("input[name='primaryButtonActiveBackgroundColor']").val()));
                    root.style.setProperty('--primary-button-active-border-color', toRgb($("input[name='primaryButtonActiveBorderColor']").val()));
                    root.style.setProperty('--secondary-button-regular-text-color', toRgb($("input[name='secondaryButtonRegularTextColor']").val()));
                    root.style.setProperty('--secondary-button-regular-background-color', toRgb($("input[name='secondaryButtonRegularBackgroundColor']").val()));
                    root.style.setProperty('--secondary-button-regular-border-color', toRgb($("input[name='secondaryButtonRegularBorderColor']").val()));
                    root.style.setProperty('--secondary-button-disabled-text-color', toRgb($("input[name='secondaryButtonDisabledTextColor']").val()));
                    root.style.setProperty('--secondary-button-disabled-background-color', toRgb($("input[name='secondaryButtonDisabledBackgroundColor']").val()));
                    root.style.setProperty('--secondary-button-disabled-border-color', toRgb($("input[name='secondaryButtonDisabledBorderColor']").val()));
                    root.style.setProperty('--secondary-button-active-text-color', toRgb($("input[name='secondaryButtonActiveTextColor']").val()));
                    root.style.setProperty('--secondary-button-active-background-color', toRgb($("input[name='secondaryButtonActiveBackgroundColor']").val()));
                    root.style.setProperty('--secondary-button-active-border-color', toRgb($("input[name='secondaryButtonActiveBorderColor']").val()));
                });

                $(".style-configurator").find("select, input").on("change", function () {
                    let classes = [];

                    $(".style-configurator").find("select, input[type='checkbox']").each(function () {
                        if (this.tagName === "SELECT" || $(this).is(":checked")) {
                            classes.push($(this).val());
                        }
                    });

                    $("#additionalClasses").val(classes.join(" "));

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
