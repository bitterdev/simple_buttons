<?php

namespace Concrete\Package\SimpleButtons;

use Bitter\SimpleButtons\Provider\ServiceProvider;
use Concrete\Core\Package\Package;
use Concrete\Core\Entity\Package as PackageEntity;

class Controller extends Package
{
    protected string $pkgHandle = 'simple_buttons';
    protected string $pkgVersion = '0.0.7';
    protected $appVersionRequired = '9.0.0';
    protected $pkgAutoloaderRegistries = [
        'src/Bitter/SimpleButtons' => 'Bitter\SimpleButtons',
    ];

    public function getPackageDescription(): string
    {
        return t('Add buttons and button groups to your site with more than 50 customizable styles.');
    }

    public function getPackageName(): string
    {
        return t('Simple Buttons');
    }

    public function on_start()
    {
        $autoloadFile = $this->getPackagePath() . DIRECTORY_SEPARATOR . "vendor" . DIRECTORY_SEPARATOR . "autoload.php";

        include($autoloadFile);
        
        /** @var ServiceProvider $serviceProvider */
        /** @noinspection PhpUnhandledExceptionInspection */
        $serviceProvider = $this->app->make(ServiceProvider::class);
        $serviceProvider->register();
    }

    public function install(): PackageEntity
    {
        $pkg = parent::install();
        $this->installContentFile("data.xml");
        return $pkg;
    }

    public function upgrade()
    {
        parent::upgrade();
        $this->installContentFile("data.xml");
    }
}
