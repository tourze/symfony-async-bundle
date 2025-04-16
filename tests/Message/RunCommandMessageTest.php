<?php

namespace Tourze\Symfony\Async\Tests\Message;

use PHPUnit\Framework\TestCase;
use Tourze\Symfony\Async\Message\RunCommandMessage;

class RunCommandMessageTest extends TestCase
{
    public function testCommandGetterAndSetter(): void
    {
        $message = new RunCommandMessage();
        $message->setCommand('app:test-command');
        $this->assertEquals('app:test-command', $message->getCommand());
    }

    public function testOptionsGetterAndSetter(): void
    {
        $message = new RunCommandMessage();
        $options = ['--force', '--env=test'];
        $message->setOptions($options);
        $this->assertEquals($options, $message->getOptions());
    }
}
