<?php

use Bitter\SimpleButtons\Buttons\Builder;
use Bitter\SimpleButtons\Buttons\Button;
use Concrete\Core\Support\Facade\Application;

defined("C5_EXECUTE") or die("Access Denied.");

/** @var array|Button[] $buttons */

$app = Application::getFacadeApplication();
/** @var Builder $buttonBuilder */
/** @noinspection PhpUnhandledExceptionInspection */
$buttonBuilder = $app->make(Builder::class);

echo $buttonBuilder->render($buttons);

