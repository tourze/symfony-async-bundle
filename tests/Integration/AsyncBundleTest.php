<?php

namespace Tourze\Symfony\Async\Tests\Integration;

use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Tourze\Symfony\Async\AsyncBundle;
use Tourze\Symfony\Async\DependencyInjection\AsyncExtension;

class AsyncBundleTest extends TestCase
{
    public function testBundle(): void
    {
        $bundle = new AsyncBundle();
        $this->assertEquals('AsyncBundle', $bundle->getName());
    }

    public function testExtensionLoadsServices(): void
    {
        $container = new ContainerBuilder();
        $extension = new AsyncExtension();

        $extension->load([], $container);

        // 检查是否注册了必要的服务
        $this->assertTrue($container->hasDefinition('Tourze\Symfony\Async\Aspect\AsyncAspect'));
        $this->assertTrue($container->hasDefinition('Tourze\Symfony\Async\MessageHandler\ServiceCallHandler'));
        $this->assertTrue($container->hasDefinition('Tourze\Symfony\Async\Service\Serializer'));
    }
}
