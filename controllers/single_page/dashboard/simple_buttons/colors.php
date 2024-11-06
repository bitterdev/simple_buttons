<?php /** @noinspection PhpMissingFieldTypeInspection */

namespace Concrete\Package\SimpleButtons\Controller\SinglePage\Dashboard\SimpleButtons;

use Concrete\Core\Error\ErrorList\ErrorList;
use Concrete\Core\Page\Controller\DashboardPageController;
use Concrete\Core\Form\Service\Validation;
use Concrete\Core\Site\Service;

class Colors extends DashboardPageController
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
            
            $this->formValidator->addRequiredToken("update_colors");

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
                $config->save("simple_buttons.styles.primary.states.regular.colors.text", (string)$this->request->request->get("primaryButtonRegularTextColor"));
                $config->save("simple_buttons.styles.primary.states.regular.colors.background", (string)$this->request->request->get("primaryButtonRegularBackgroundColor"));
                $config->save("simple_buttons.styles.primary.states.regular.colors.border", (string)$this->request->request->get("primaryButtonRegularBorderColor"));
                $config->save("simple_buttons.styles.primary.states.disabled.colors.text", (string)$this->request->request->get("primaryButtonDisabledTextColor"));
                $config->save("simple_buttons.styles.primary.states.disabled.colors.background", (string)$this->request->request->get("primaryButtonDisabledBackgroundColor"));
                $config->save("simple_buttons.styles.primary.states.disabled.colors.border", (string)$this->request->request->get("primaryButtonDisabledBorderColor"));
                $config->save("simple_buttons.styles.primary.states.active.colors.text", (string)$this->request->request->get("primaryButtonActiveTextColor"));
                $config->save("simple_buttons.styles.primary.states.active.colors.background", (string)$this->request->request->get("primaryButtonActiveBackgroundColor"));
                $config->save("simple_buttons.styles.primary.states.active.colors.border", (string)$this->request->request->get("primaryButtonActiveBorderColor"));
                $config->save("simple_buttons.styles.secondary.states.regular.colors.text", (string)$this->request->request->get("secondaryButtonRegularTextColor"));
                $config->save("simple_buttons.styles.secondary.states.regular.colors.background", (string)$this->request->request->get("secondaryButtonRegularBackgroundColor"));
                $config->save("simple_buttons.styles.secondary.states.regular.colors.border", (string)$this->request->request->get("secondaryButtonRegularBorderColor"));
                $config->save("simple_buttons.styles.secondary.states.disabled.colors.text", (string)$this->request->request->get("secondaryButtonDisabledTextColor"));
                $config->save("simple_buttons.styles.secondary.states.disabled.colors.background", (string)$this->request->request->get("secondaryButtonDisabledBackgroundColor"));
                $config->save("simple_buttons.styles.secondary.states.disabled.colors.border", (string)$this->request->request->get("secondaryButtonDisabledBorderColor"));
                $config->save("simple_buttons.styles.secondary.states.active.colors.text", (string)$this->request->request->get("secondaryButtonActiveTextColor"));
                $config->save("simple_buttons.styles.secondary.states.active.colors.background", (string)$this->request->request->get("secondaryButtonActiveBackgroundColor"));
                $config->save("simple_buttons.styles.secondary.states.active.colors.border", (string)$this->request->request->get("secondaryButtonActiveBorderColor"));

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

        $this->set("primaryButtonRegularTextColor", (string)$config->get("simple_buttons.styles.primary.states.regular.colors.text", "#fff"));
        $this->set("primaryButtonRegularBackgroundColor", (string)$config->get("simple_buttons.styles.primary.states.regular.colors.background", "#0d6efd"));
        $this->set("primaryButtonRegularBorderColor", (string)$config->get("simple_buttons.styles.primary.states.regular.colors.border", "#0d6efd"));
        $this->set("primaryButtonDisabledTextColor", (string)$config->get("simple_buttons.styles.primary.states.disabled.colors.text", "#fff"));
        $this->set("primaryButtonDisabledBackgroundColor", (string)$config->get("simple_buttons.styles.primary.states.disabled.colors.background", "#71acff"));
        $this->set("primaryButtonDisabledBorderColor", (string)$config->get("simple_buttons.styles.primary.states.disabled.colors.border", "#71acff"));
        $this->set("primaryButtonActiveTextColor", (string)$config->get("simple_buttons.styles.primary.states.active.colors.text", "#fff"));
        $this->set("primaryButtonActiveBackgroundColor", (string)$config->get("simple_buttons.styles.primary.states.active.colors.background", "#0b5ed7"));
        $this->set("primaryButtonActiveBorderColor", (string)$config->get("simple_buttons.styles.primary.states.active.colors.border", "#0a58ca"));
        $this->set("secondaryButtonRegularTextColor", (string)$config->get("simple_buttons.styles.secondary.states.regular.colors.text", "#fff"));
        $this->set("secondaryButtonRegularBackgroundColor", (string)$config->get("simple_buttons.styles.secondary.states.regular.colors.background", "#6c757d"));
        $this->set("secondaryButtonRegularBorderColor", (string)$config->get("simple_buttons.styles.secondary.states.regular.colors.border", "#6c757d"));
        $this->set("secondaryButtonDisabledTextColor", (string)$config->get("simple_buttons.styles.secondary.states.disabled.colors.text", "#fff"));
        $this->set("secondaryButtonDisabledBackgroundColor", (string)$config->get("simple_buttons.styles.secondary.states.disabled.colors.background", "#a2a8ad"));
        $this->set("secondaryButtonDisabledBorderColor", (string)$config->get("simple_buttons.styles.secondary.states.disabled.colors.border", "#a2a8ad"));
        $this->set("secondaryButtonActiveTextColor", (string)$config->get("simple_buttons.styles.secondary.states.active.colors.text", "#fff"));
        $this->set("secondaryButtonActiveBackgroundColor", (string)$config->get("simple_buttons.styles.secondary.states.active.colors.background", "#5c636a"));
        $this->set("secondaryButtonActiveBorderColor", (string)$config->get("simple_buttons.styles.secondary.states.active.colors.border", "#565e64"));
    }
}