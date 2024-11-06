<?php

namespace Bitter\SimpleButtons\Provider;

use Bitter\SimpleButtons\Routing\RouteList;
use Concrete\Core\Application\Application;
use Concrete\Core\Asset\AssetList;
use Concrete\Core\Foundation\Service\Provider;
use Concrete\Core\Page\Page;
use Concrete\Core\Routing\RouterInterface;
use Concrete\Core\Site\Config\Liaison;
use Concrete\Core\Site\Service;
use Concrete\Core\View\View;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\EventDispatcher\GenericEvent;
use Tomloprod\Colority\Services\ColorityManager;

class ServiceProvider extends Provider
{
    protected RouterInterface $router;
    protected EventDispatcherInterface $eventDispatcher;
    protected Liaison $config;

    public function __construct(
        Application              $app,
        EventDispatcherInterface $eventDispatcher,
        RouterInterface          $router
    )
    {
        parent::__construct($app);

        $this->router = $router;
        $this->eventDispatcher = $eventDispatcher;

        /** @var Service $siteService */
        /** @noinspection PhpUnhandledExceptionInspection */
        $siteService = $this->app->make(Service::class);
        $site = $siteService->getSite();
        $this->config = $site->getConfigRepository();
    }

    public function register()
    {
        $this->registerRoutes();
        $this->registerAssets();
        $this->injectStyles();
    }

    private function registerAssets()
    {
        $al = AssetList::getInstance();
        $al->register("css", "simple_buttons", "css/simple-buttons.css", [], "simple_buttons");
        $al->register("javascript", "simple_buttons", "js/simple-buttons.js", [], "simple_buttons");
        $al->registerGroup("simple_buttons", [
            ["css", "simple_buttons"],
            ["javascript", "simple_buttons"]
        ]);
    }

    private function toRgb(string $fromColor): string
    {
        return implode(", ", ColorityManager::instance()->parse($fromColor)->toRgb()->getArrayValueColor());
    }

    private function injectStyles()
    {
        $this->eventDispatcher->addListener('on_before_render', function () {


            /** @noinspection CssUnresolvedCustomProperty */
            $js =
                "<script>\n" .
                "CCM_BUTTON_CLASSES = " . json_encode((string)$this->config->get("simple_buttons.options.additional_classes", "")) . ";\n" .
                "</script>\n";

            /** @noinspection CssUnresolvedCustomProperty */
            $css =
                "<style>\n" .
                ":root {\n" .
                "  --primary-button-regular-text-color: " . $this->toRgb($this->config->get("simple_buttons.styles.primary.states.regular.colors.text", "#fff")) . ";\n" .
                "  --primary-button-regular-background-color: " . $this->toRgb($this->config->get("simple_buttons.styles.primary.states.regular.colors.background", "#0d6efd")) . ";\n" .
                "  --primary-button-regular-border-color: " . $this->toRgb($this->config->get("simple_buttons.styles.primary.states.regular.colors.border", "#0d6efd")) . ";\n" .
                "  --primary-button-disabled-text-color: " . $this->toRgb($this->config->get("simple_buttons.styles.primary.states.disabled.colors.text", "#fff")) . ";\n" .
                "  --primary-button-disabled-background-color: " . $this->toRgb($this->config->get("simple_buttons.styles.primary.states.disabled.colors.background", "#71acff")) . ";\n" .
                "  --primary-button-disabled-border-color: " . $this->toRgb($this->config->get("simple_buttons.styles.primary.states.disabled.colors.border", "#71acff")) . ";\n" .
                "  --primary-button-active-text-color: " . $this->toRgb($this->config->get("simple_buttons.styles.primary.states.active.colors.text", "#fff")) . ";\n" .
                "  --primary-button-active-background-color: " . $this->toRgb($this->config->get("simple_buttons.styles.primary.states.active.colors.background", "#0b5ed7")) . ";\n" .
                "  --primary-button-active-border-color: " . $this->toRgb($this->config->get("simple_buttons.styles.primary.states.active.colors.border", "#0a58ca")) . ";\n" .
                "  --secondary-button-regular-text-color: " . $this->toRgb($this->config->get("simple_buttons.styles.secondary.states.regular.colors.text", "#fff")) . ";\n" .
                "  --secondary-button-regular-background-color: " . $this->toRgb($this->config->get("simple_buttons.styles.secondary.states.regular.colors.background", "#6c757d")) . ";\n" .
                "  --secondary-button-regular-border-color: " . $this->toRgb($this->config->get("simple_buttons.styles.secondary.states.regular.colors.border", "#6c757d")) . ";\n" .
                "  --secondary-button-disabled-text-color: " . $this->toRgb($this->config->get("simple_buttons.styles.secondary.states.disabled.colors.text", "#fff")) . ";\n" .
                "  --secondary-button-disabled-background-color: " . $this->toRgb($this->config->get("simple_buttons.styles.secondary.states.disabled.colors.background", "#a2a8ad")) . ";\n" .
                "  --secondary-button-disabled-border-color: " . $this->toRgb($this->config->get("simple_buttons.styles.secondary.states.disabled.colors.border", "#a2a8ad")) . ";\n" .
                "  --secondary-button-active-text-color: " . $this->toRgb($this->config->get("simple_buttons.styles.secondary.states.active.colors.text", "#fff")) . ";\n" .
                "  --secondary-button-active-background-color: " . $this->toRgb($this->config->get("simple_buttons.styles.secondary.states.active.colors.background", "#5c636a")) . ";\n" .
                "  --secondary-button-active-border-color: " . $this->toRgb($this->config->get("simple_buttons.styles.secondary.states.active.colors.border", "#565e64")) . ";\n" .
                "}\n" .
                "</style>\n";

            $view = View::getInstance();
            $c = Page::getCurrentPage();

            if ($c instanceof Page && !$c->isError()) {
                $view->addHeaderItem($css);
                $view->addHeaderItem($js);
                $view->requireAsset("simple_buttons");
                $view->requireAsset("javascript", "jquery");
                $view->requireAsset("css", "font-awesome");
            }
        });
    }

    private function registerRoutes()
    {
        $this->router->loadRouteList(new RouteList());
    }
}