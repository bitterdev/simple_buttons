<?php /** @noinspection PhpMissingFieldTypeInspection */

namespace Concrete\Package\SimpleButtons\Controller\SinglePage\Dashboard;

use Concrete\Core\Error\ErrorList\ErrorList;
use Concrete\Core\Page\Controller\DashboardPageController;
use Concrete\Core\Form\Service\Validation;
use Concrete\Core\Site\Service;

class SimpleButtons extends DashboardPageController
{
    /** @var Validation */
    protected $formValidator;

    public function on_start()
    {
        parent::on_start();
        /** @noinspection PhpUnhandledExceptionInspection */
        $this->formValidator = $this->app->make(Validation::class);
    }

    public function view()
    {
        /** @var Service $siteService */
        /** @noinspection PhpUnhandledExceptionInspection */
        $siteService = $this->app->make(Service::class);
        $site = $siteService->getSite();
        $config = $site->getConfigRepository();

        if ($this->request->getMethod() === "POST") {
            $this->formValidator->setData($this->request->request->all());

            $this->formValidator->addRequiredToken("update_settings");

            $this->formValidator->addRequired("primaryButtonRegularTextColor", t("You need to enter a valid text color for the primary button regular state."));
            $this->formValidator->addRequired("primaryButtonRegularBackgroundColor", t("You need to enter a valid background color for the primary button regular state."));
            $this->formValidator->addRequired("primaryButtonRegularBorderColor", t("You need to enter a valid border color for the primary button regular state."));
            $this->formValidator->addRequired("primaryButtonActiveTextColor", t("You need to enter a valid text color for the primary button active state."));
            $this->formValidator->addRequired("primaryButtonActiveBackgroundColor", t("You need to enter a valid background color for the primary button active state."));
            $this->formValidator->addRequired("primaryButtonActiveBorderColor", t("You need to enter a valid border color for the primary button active state."));
            $this->formValidator->addRequired("primaryButtonDisabledTextColor", t("You need to enter a valid text color for the primary button disabled state."));
            $this->formValidator->addRequired("primaryButtonDisabledBackgroundColor", t("You need to enter a valid background color for the primary button disabled state."));
            $this->formValidator->addRequired("primaryButtonDisabledBorderColor", t("You need to enter a valid border color for the primary button disabled state."));
            $this->formValidator->addRequired("secondaryButtonRegularTextColor", t("You need to enter a valid text color for the secondary button regular state."));
            $this->formValidator->addRequired("secondaryButtonRegularBackgroundColor", t("You need to enter a valid background color for the secondary button regular state."));
            $this->formValidator->addRequired("secondaryButtonRegularBorderColor", t("You need to enter a valid border color for the secondary button regular state."));
            $this->formValidator->addRequired("secondaryButtonActiveTextColor", t("You need to enter a valid text color for the secondary button active state."));
            $this->formValidator->addRequired("secondaryButtonActiveBackgroundColor", t("You need to enter a valid background color for the secondary button active state."));
            $this->formValidator->addRequired("secondaryButtonActiveBorderColor", t("You need to enter a valid border color for the secondary button active state."));
            $this->formValidator->addRequired("secondaryButtonDisabledTextColor", t("You need to enter a valid text color for the secondary button disabled state."));
            $this->formValidator->addRequired("secondaryButtonDisabledBackgroundColor", t("You need to enter a valid background color for the secondary button disabled state."));
            $this->formValidator->addRequired("secondaryButtonDisabledBorderColor", t("You need to enter a valid border color for the secondary button disabled state."));

            if ($this->formValidator->test()) {
                $config->save("simple_buttons.styles.buttons.primary.states.regular.colors.text", (string)$this->request->request->get("primaryButtonRegularTextColor"));
                $config->save("simple_buttons.styles.buttons.primary.states.regular.colors.background", (string)$this->request->request->get("primaryButtonRegularBackgroundColor"));
                $config->save("simple_buttons.styles.buttons.primary.states.regular.colors.border", (string)$this->request->request->get("primaryButtonRegularBorderColor"));
                $config->save("simple_buttons.styles.buttons.primary.states.disabled.colors.text", (string)$this->request->request->get("primaryButtonDisabledTextColor"));
                $config->save("simple_buttons.styles.buttons.primary.states.disabled.colors.background", (string)$this->request->request->get("primaryButtonDisabledBackgroundColor"));
                $config->save("simple_buttons.styles.buttons.primary.states.disabled.colors.border", (string)$this->request->request->get("primaryButtonDisabledBorderColor"));
                $config->save("simple_buttons.styles.buttons.primary.states.active.colors.text", (string)$this->request->request->get("primaryButtonActiveTextColor"));
                $config->save("simple_buttons.styles.buttons.primary.states.active.colors.background", (string)$this->request->request->get("primaryButtonActiveBackgroundColor"));
                $config->save("simple_buttons.styles.buttons.primary.states.active.colors.border", (string)$this->request->request->get("primaryButtonActiveBorderColor"));
                $config->save("simple_buttons.styles.buttons.secondary.states.regular.colors.text", (string)$this->request->request->get("secondaryButtonRegularTextColor"));
                $config->save("simple_buttons.styles.buttons.secondary.states.regular.colors.background", (string)$this->request->request->get("secondaryButtonRegularBackgroundColor"));
                $config->save("simple_buttons.styles.buttons.secondary.states.regular.colors.border", (string)$this->request->request->get("secondaryButtonRegularBorderColor"));
                $config->save("simple_buttons.styles.buttons.secondary.states.disabled.colors.text", (string)$this->request->request->get("secondaryButtonDisabledTextColor"));
                $config->save("simple_buttons.styles.buttons.secondary.states.disabled.colors.background", (string)$this->request->request->get("secondaryButtonDisabledBackgroundColor"));
                $config->save("simple_buttons.styles.buttons.secondary.states.disabled.colors.border", (string)$this->request->request->get("secondaryButtonDisabledBorderColor"));
                $config->save("simple_buttons.styles.buttons.secondary.states.active.colors.text", (string)$this->request->request->get("secondaryButtonActiveTextColor"));
                $config->save("simple_buttons.styles.buttons.secondary.states.active.colors.background", (string)$this->request->request->get("secondaryButtonActiveBackgroundColor"));
                $config->save("simple_buttons.styles.buttons.secondary.states.active.colors.border", (string)$this->request->request->get("secondaryButtonActiveBorderColor"));
                $config->save("simple_buttons.styles.additional_classes", (string)$this->request->request->get("additionalClasses"));

                if (!$this->error->has()) {
                    $this->set("success", t("The settings has been successfully updated."));
                }

            } else {
                /** @var ErrorList $errorList */
                $errorList = $this->formValidator->getError();

                foreach ($errorList->getList() as $error) {
                    $this->error->add($error);
                }
            }
        }

        $backgroundClasses = [
            "" => t("Solid Color"),
            "btn-gradient-direction-bottom" => t("Gradient (Top to Bottom)"),
            "btn-gradient-direction-top" => t("Gradient (Bottom to Top)"),
            "btn-gradient-direction-left" => t("Gradient (Right to Left)"),
            "btn-gradient-direction-right" => t("Gradient (Left to Right)"),
        ];

        $shadowClasses = [
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

        $roundedCornerClasses = [
            "" => t("No Corners"),
            "btn-rounded-corners-5" => "5px",
            "btn-rounded-corners-10" => "10px",
            "btn-rounded-corners-15" => "15px",
            "btn-rounded-corners-20" => "20px",
            "btn-rounded-corners-25" => "25px"
        ];

        $hoverAnimationClasses = [
            "btn-hover-animation-1" => t("Button lifts up"),
            //"btn-hover-animation-2" => t("Text animates"),
            "btn-hover-animation-3" => t("Outline animation"),
            "btn-hover-animation-4" => t("Symbol rotates 45°"),
            "btn-hover-animation-5" => t("Glow effect"),
            "btn-hover-animation-6" => t("Symbol slides in from the side")
        ];

        $fontWeightClasses = [
            "btn-font-weight-100" => "100",
            "btn-font-weight-200" => "200",
            "btn-font-weight-300" => "300",
            "btn-font-weight-400" => "400",
            "btn-font-weight-500" => "500",
            "btn-font-weight-600" => "600",
            "btn-font-weight-700" => "700",
            "btn-font-weight-800" => "800",
            "btn-font-weight-900" => "900",
        ];

        $iconClasses = [
            "" => t("No Background"),
            "btn-icon-rounded-background" => t("Rounded Background"),
            "btn-icon-square-background" => t("Square Background")
        ];

        $this->set("iconClasses", $iconClasses);
        $this->set("backgroundClasses", $backgroundClasses);
        $this->set("shadowClasses", $shadowClasses);
        $this->set("roundedCornerClasses", $roundedCornerClasses);
        $this->set("hoverAnimationClasses", $hoverAnimationClasses);
        $this->set("fontWeightClasses", $fontWeightClasses);
        $this->set("primaryButtonRegularTextColor", (string)$config->get("simple_buttons.styles.buttons.primary.states.regular.colors.text", "#fff"));
        $this->set("primaryButtonRegularBackgroundColor", (string)$config->get("simple_buttons.styles.buttons.primary.states.regular.colors.background", "#0d6efd"));
        $this->set("primaryButtonRegularBorderColor", (string)$config->get("simple_buttons.styles.buttons.primary.states.regular.colors.border", "#0d6efd"));
        $this->set("primaryButtonDisabledTextColor", (string)$config->get("simple_buttons.styles.buttons.primary.states.disabled.colors.text", "#fff"));
        $this->set("primaryButtonDisabledBackgroundColor", (string)$config->get("simple_buttons.styles.buttons.primary.states.disabled.colors.background", "#71acff"));
        $this->set("primaryButtonDisabledBorderColor", (string)$config->get("simple_buttons.styles.buttons.primary.states.disabled.colors.border", "#71acff"));
        $this->set("primaryButtonActiveTextColor", (string)$config->get("simple_buttons.styles.buttons.primary.states.active.colors.text", "#fff"));
        $this->set("primaryButtonActiveBackgroundColor", (string)$config->get("simple_buttons.styles.buttons.primary.states.active.colors.background", "#0b5ed7"));
        $this->set("primaryButtonActiveBorderColor", (string)$config->get("simple_buttons.styles.buttons.primary.states.active.colors.border", "#0a58ca"));
        $this->set("secondaryButtonRegularTextColor", (string)$config->get("simple_buttons.styles.buttons.secondary.states.regular.colors.text", "#fff"));
        $this->set("secondaryButtonRegularBackgroundColor", (string)$config->get("simple_buttons.styles.buttons.secondary.states.regular.colors.background", "#6c757d"));
        $this->set("secondaryButtonRegularBorderColor", (string)$config->get("simple_buttons.styles.buttons.secondary.states.regular.colors.border", "#6c757d"));
        $this->set("secondaryButtonDisabledTextColor", (string)$config->get("simple_buttons.styles.buttons.secondary.states.disabled.colors.text", "#fff"));
        $this->set("secondaryButtonDisabledBackgroundColor", (string)$config->get("simple_buttons.styles.buttons.secondary.states.disabled.colors.background", "#a2a8ad"));
        $this->set("secondaryButtonDisabledBorderColor", (string)$config->get("simple_buttons.styles.buttons.secondary.states.disabled.colors.border", "#a2a8ad"));
        $this->set("secondaryButtonActiveTextColor", (string)$config->get("simple_buttons.styles.buttons.secondary.states.active.colors.text", "#fff"));
        $this->set("secondaryButtonActiveBackgroundColor", (string)$config->get("simple_buttons.styles.buttons.secondary.states.active.colors.background", "#5c636a"));
        $this->set("secondaryButtonActiveBorderColor", (string)$config->get("simple_buttons.styles.buttons.secondary.states.active.colors.border", "#565e64"));
        $this->set("additionalClasses", (string)$config->get("simple_buttons.styles.additional_classes", ""));
    }
}