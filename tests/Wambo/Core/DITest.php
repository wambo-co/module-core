<?php

namespace Wambo\Core;

use League\Flysystem\Filesystem;
use League\Flysystem\Memory\MemoryAdapter;
use PHPUnit\Framework\TestCase;
use Slim\Container;
use Wambo\Core\Module\JSONModuleStorage;
use Wambo\Core\Module\ModuleMapper;
use Wambo\Core\Module\ModuleRepository;

/**
 * Class DITest contains DI Tests
 *
 * @package Wambo\Core
 */
class DITest extends TestCase
{

    /**
     * @test
     */
    public function testDIinApp()
    {
        // arrange
        $container = new Container();

        $container['filesystem_adapter'] = function($c) { return new MemoryAdapter(); };
        $container['filesystem'] = function($c) { return new Filesystem($c['filesystem_adapter']); };

        $container['module_repository'] = function($c) {
            $storage = new JSONModuleStorage($c['filesystem'], 'modules.json');
            $mapper = new ModuleMapper();
            return new ModuleRepository($storage, $mapper);
        };
        $app = new App($container);

        // act
        $filesystem = $app->getContainer()->get('filesystem');
        $hasFile = $filesystem->has('notExistingFile.txt');

        // assert
        $this->assertFalse($hasFile);
    }
}