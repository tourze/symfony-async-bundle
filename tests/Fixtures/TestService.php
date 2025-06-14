<?php

namespace Tourze\Symfony\Async\Tests\Fixtures;

use Tourze\Symfony\AopAsyncBundle\Attribute\Async;

class TestService
{
    private bool $methodCalled = false;

    #[Async]
    public function asyncMethod(string $param1, int $param2): void
    {
        $this->methodCalled = true;
    }

    #[Async(retryCount: 3, delayMs: 1000)]
    public function asyncMethodWithRetry(string $param): void
    {
        $this->methodCalled = true;
    }

    public function wasMethodCalled(): bool
    {
        return $this->methodCalled;
    }
}
