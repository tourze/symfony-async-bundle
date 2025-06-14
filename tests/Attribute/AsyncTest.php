<?php

namespace Tourze\Symfony\Async\Tests\Attribute;

use PHPUnit\Framework\TestCase;
use Tourze\Symfony\AopAsyncBundle\Attribute\Async;

class AsyncTest extends TestCase
{
    public function testConstructor(): void
    {
        $async = new Async();
        $this->assertEquals(0, $async->retryCount);
        $this->assertEquals(0, $async->delayMs);

        $async = new Async(retryCount: 3, delayMs: 1000);
        $this->assertEquals(3, $async->retryCount);
        $this->assertEquals(1000, $async->delayMs);
    }

    public function testAttributeTargetsMethod(): void
    {
        $reflection = new \ReflectionClass(Async::class);
        $attributes = $reflection->getAttributes();

        $this->assertCount(1, $attributes);
        $this->assertEquals(\Attribute::class, $attributes[0]->getName());

        $attribute = $attributes[0]->newInstance();
        $this->assertEquals(\Attribute::TARGET_METHOD, $attribute->flags);
    }
}
