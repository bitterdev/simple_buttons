<?php

namespace Concrete\Package\SimpleButtons;

use Bitter\SimpleButtons\Provider\ServiceProvider;
use Concrete\Core\Package\Package;
use Concrete\Core\Entity\Package as PackageEntity;

class Controller extends Package
{
    protected string $pkgHandle = 'simple_buttons';
    protected string $pkgVersion = '0.1.0';
    protected $appVersionRequired = '9.0.0';
    protected $pkgAutoloaderRegistries = [
        'src/Bitter/SimpleButtons' => 'Bitter\SimpleButtons',
    ];

    public function getPackageDescription(): string
    {
        return t('Simple Buttons is a powerful Concrete CMS add-on that enables customizable button designs.');
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
