<?php

namespace Tourze\Symfony\Async\Tests\MessageHandler;

use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\Messenger\MessageBusInterface;
use Tourze\Symfony\Async\MessageHandler\ServiceCallHandler;
use Tourze\Symfony\Async\Service\Serializer;

class ServiceCallHandlerTest extends TestCase
{
    private $container;
    private $serializer;
    private $logger;
    private $messageBus;
    private $handler;

    protected function setUp(): void
    {
        $this->container = $this->createMock(ContainerInterface::class);
        $this->serializer = $this->createMock(Serializer::class);
        $this->logger = $this->createMock(LoggerInterface::class);
        $this->messageBus = $this->createMock(MessageBusInterface::class);

        $this->handler = new ServiceCallHandler(
            $this->container,
            $this->serializer,
            $this->logger,
            $this->messageBus
        );
    }

    public function testHandlerCanBeInstantiated(): void
    {
        $this->assertInstanceOf(ServiceCallHandler::class, $this->handler);
    }
}
