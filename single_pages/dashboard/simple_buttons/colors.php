<?php

defined('C5_EXECUTE') or die('Access Denied.');

use Concrete\Core\Form\Service\Widget\Color;
use Concrete\Core\Support\Facade\Application;
use Concrete\Core\Validation\CSRF\Token;
use Concrete\Core\Form\Service\Form;
use Concrete\Core\View\View;
use Concrete\Core\Application\Service\UserInterface;

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

echo $ui->tabs([
    ['primary-button', t('Primary Button'), true],
    ['secondary-button', t('Secondary Button'), false],
]);

?>

<div class="ccm-dashboard-header-buttons">
    <?php
    /** @noinspection PhpUnhandledExceptionInspection */
    View::element("dashboard/help", [], "simple_buttons");
    ?>
</div>

<form action="#" method="post">
    <?php echo $token->output("update_colors"); ?>

    <div class="tab-content">
        <div class="tab-pane active" id="primary-button" role="tabpanel">
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

        <div class="tab-pane" id="secondary-button" role="tabpanel">
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
    </div>

    <div class="ccm-dashboard-form-actions-wrapper">
        <div class="ccm-dashboard-form-actions">
            <?php echo $form->submit('save', t('Save'), ['class' => 'btn btn-primary float-end']); ?>
        </div>
    </div>
</form>
