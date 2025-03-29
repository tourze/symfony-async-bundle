<?php

namespace Tourze\Symfony\Async\Aspect;

use Psr\Log\LoggerInterface;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\DelayStamp;
use Tourze\Symfony\Aop\Attribute\Aspect;
use Tourze\Symfony\Aop\Attribute\Before;
use Tourze\Symfony\Aop\Model\JoinPoint;
use Tourze\Symfony\Async\Attribute\Async;
use Tourze\Symfony\Async\Message\ServiceCallMessage;
use Tourze\Symfony\Async\Service\Serializer;

/**
 * 异步执行切面
 */
#[Aspect]
class AsyncAspect
{
    public function __construct(
        private readonly MessageBusInterface $messageBus,
        private readonly Serializer $serializer,
        private readonly LoggerInterface $logger,
    )
    {
    }

    private function getAttribute(JoinPoint $joinPoint): ?Async
    {
        $method = new \ReflectionMethod($joinPoint->getInstance(), $joinPoint->getMethod());
        /** @var \ReflectionAttribute[] $attributes */
        $attributes = $method->getAttributes(Async::class);
        if (empty($attributes)) {
            // 这里返回null，则不进行缓存处理
            return null;
        }

        return $attributes[0]->newInstance();
    }

    #[Before(methodAttribute: Async::class)]
    public function hookAsync(JoinPoint $joinPoint): void
    {
        try {
            // 这里我们创建一个异步执行消息来执行命令
            $message = new ServiceCallMessage();
            $message->setServiceId($joinPoint->getInternalServiceId());
            $message->setMethod($joinPoint->getMethod());
            $message->setParams($this->serializer->encodeParams($joinPoint->getParams()));

            $stamps = [];

            // 补充异步参数
            $attribute = $this->getAttribute($joinPoint);
            if ($attribute) {
                if ($attribute->retryCount > 0) {
                    $message->setMaxRetryCount($attribute->retryCount);
                    $message->setRetryCount($attribute->retryCount);
                }
                if ($attribute->delayMs > 0) {
                    $stamps[] = new DelayStamp($attribute->delayMs);
                }
            }

            $this->messageBus->dispatch($message, $stamps);
            // 停止继续执行
            $joinPoint->setReturnEarly(true);
        } catch (\Throwable $exception) {
            $this->logger->error('异步执行服务逻辑失败，尝试直接同步执行', [
                'exception' => $exception,
                'joinPoint' => $joinPoint,
            ]);
            // 我们这里不处理，就会回到常规的调用方法
        }
    }
}
