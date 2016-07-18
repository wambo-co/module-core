<?php
namespace Wambo\Core;
use Wambo\Core\Module\Module;
use Wambo\Core\Module\ModuleRepository;

/**
 * Class App
 * @package Wambo\Core
 */
class App extends \Slim\App
{

    /**
     * App constructor.
     * @param array $container
     */
    public function __construct($container = [])
    {
        parent::__construct($container);
        $this->loadModules();
    }

    /**
     * add modules to App
     */
    private function loadModules()
    {
        /** @var ModuleRepository $repo */
        $repo = $this->getContainer()->get('module_repository');

        /** @var Module $module */
        foreach ($repo->getAll() as $module) {
            $moduleClass = $module->getClass();
            new $moduleClass($this);
        }
    }
}