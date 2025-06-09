<?php

namespace Tourze\Symfony\Async\Tests\Aspect;

use PHPUnit\Framework\TestCase;
use Psr\Log\LoggerInterface;
use Symfony\Component\Messenger\MessageBusInterface;
use Tourze\AsyncServiceCallBundle\Service\Serializer;
use Tourze\Symfony\Async\Aspect\AsyncAspect;

class AsyncAspectTest extends TestCase
{
    private $messageBus;
    private $serializer;
    private $logger;
    private $aspect;

    protected function setUp(): void
    {
        $this->messageBus = $this->createMock(MessageBusInterface::class);
        $this->serializer = $this->createMock(Serializer::class);
        $this->logger = $this->createMock(LoggerInterface::class);

        $this->aspect = new AsyncAspect(
            $this->messageBus,
            $this->serializer,
            $this->logger
        );
    }

    public function testAspectCanBeInstantiated(): void
    {
        $this->assertInstanceOf(AsyncAspect::class, $this->aspect);
    }
}
