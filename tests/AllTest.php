<?php

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

class AllTest extends \PHPUnit_Framework_TestCase
{
    private $container;

    public function setUp()
    {
        $container = new ContainerBuilder();
        $loader    = new YamlFileLoader($container, new FileLocator(__DIR__));
        $loader->load('fixtures/services.yml');

        $this->container = $container;
    }

    public function testApp()
    {
        $this->assertEquals("Hello", $this->container->get('app')->hello());
    }

    public function testCurl()
    {
        $this->assertEquals("Hello", $this->container->get('curl')->doGet());
    }

    public function testProxy()
    {
        $this->assertEquals("Hello", $this->container->get('proxy')->hello());
    }
}
