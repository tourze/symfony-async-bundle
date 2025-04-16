<?php

namespace Tourze\Symfony\Async\Tests\Message;

use PHPUnit\Framework\TestCase;
use Tourze\Symfony\Async\Message\AsyncMessageInterface;
use Tourze\Symfony\Async\Message\RunCommandMessage;
use Tourze\Symfony\Async\Message\ServiceCallMessage;

class AsyncMessageInterfaceTest extends TestCase
{
    public function testServiceCallMessageImplementsInterface(): void
    {
        $this->assertInstanceOf(AsyncMessageInterface::class, new ServiceCallMessage());
    }

    public function testRunCommandMessageImplementsInterface(): void
    {
        $this->assertInstanceOf(AsyncMessageInterface::class, new RunCommandMessage());
    }
}
