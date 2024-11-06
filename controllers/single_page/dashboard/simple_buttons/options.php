<?php /** @noinspection PhpMissingFieldTypeInspection */

namespace Concrete\Package\SimpleButtons\Controller\SinglePage\Dashboard\SimpleButtons;

use Concrete\Core\Error\ErrorList\ErrorList;
use Concrete\Core\Page\Controller\DashboardPageController;
use Concrete\Core\Form\Service\Validation;
use Concrete\Core\Site\Service;

class Options extends DashboardPageController
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

            $this->formValidator->addRequiredToken("update_options");

            if ($this->formValidator->test()) {
                $config->save("simple_buttons.options.animated_on_hover", $this->request->request->has("animatedOnHover"));
                $config->save("simple_buttons.options.has_animated_text", $this->request->request->has("hasAnimatedText"));
                $config->save("simple_buttons.options.has_rounded_icon", $this->request->request->has("hasRoundedIcon"));
                $config->save("simple_buttons.options.has_animated_icon", $this->request->request->has("hasAnimatedIcon"));
                $config->save("simple_buttons.options.background_style", (string)$this->request->request->get("backgroundStyle"));
                $config->save("simple_buttons.options.shadow_style", (string)$this->request->request->get("shadowStyle"));
                $config->save("simple_buttons.options.rounded_corner_style", (string)$this->request->request->get("roundedCornerStyle"));

                $classes = [];

                if ($config->get("simple_buttons.options.animated_on_hover", false)) {
                    $classes[] = "btn-animated-on-hover";
                }

                if ($config->get("simple_buttons.options.has_animated_text", false)) {
                    $classes[] = "btn-animated-text";
                }

                if ($config->get("simple_buttons.options.has_rounded_icon", false)) {
                    $classes[] = "btn-rounded-icon";
                }

                if ($config->get("simple_buttons.options.has_animated_icon", false)) {
                    $classes[] = "btn-animated-icon";
                }

                if (strlen($config->get("simple_buttons.options.background_style", "")) > 0) {
                    $classes[] = $config->get("simple_buttons.options.background_style", "");
                }

                if (strlen($config->get("simple_buttons.options.shadow_style", "")) > 0) {
                    $classes[] = $config->get("simple_buttons.options.shadow_style", "");
                }

                if (strlen($config->get("simple_buttons.options.rounded_corner_style", "")) > 0) {
                    $classes[] = $config->get("simple_buttons.options.rounded_corner_style", "");
                }

                $classesStr = implode(" ", $classes);

                $config->save("simple_buttons.options.additional_classes", $classesStr);

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

        $this->set("animatedOnHover", (bool)$config->get("simple_buttons.options.animated_on_hover", false));
        $this->set("hasAnimatedText", (bool)$config->get("simple_buttons.options.has_animated_text", false));
        $this->set("hasRoundedIcon", (bool)$config->get("simple_buttons.options.has_rounded_icon", false));
        $this->set("hasAnimatedIcon", (bool)$config->get("simple_buttons.options.has_animated_icon", false));
        $this->set("backgroundStyle", (string)$config->get("simple_buttons.options.background_style", ""));
        $this->set("shadowStyle", (string)$config->get("simple_buttons.options.shadow_style", ""));
        $this->set("roundedCornerStyle", (string)$config->get("simple_buttons.options.rounded_corner_style", ""));
    }
}