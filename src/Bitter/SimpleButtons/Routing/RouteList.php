<?php

namespace Bitter\SimpleButtons\Routing;

use Bitter\SimpleButtons\API\V1\Middleware\FractalNegotiatorMiddleware;
use Bitter\SimpleButtons\API\V1\Configurator;
use Concrete\Core\Routing\RouteListInterface;
use Concrete\Core\Routing\Router;

class RouteList implements RouteListInterface
{
    public function loadRoutes(Router $router)
    {
        $router
            ->buildGroup()
            ->setNamespace('Concrete\Package\SimpleButtons\Controller\Dialog\Support')
            ->setPrefix('/ccm/system/dialogs/simple_buttons')
            ->routes('dialogs/support.php', 'simple_buttons');
    }
}