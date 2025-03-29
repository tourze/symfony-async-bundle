<?php

namespace Tourze\Symfony\Async\Model;

/**
 * 参考了 Java 的异步实现
 *
 * @see https://blog.csdn.net/lisheng19870305/article/details/116020830
 */
class AsyncResult
{
    /**
     * 取消异步任务
     */
    public function cancel(): bool
    {
        // TODO
    }

    /**
     * 检查任务是否已取消
     */
    public function isCancelled(): bool
    {
        // TODO
    }

    /**
     * 检查任务是否已完成
     */
    public function isDone(): bool
    {
        // TODO
    }

    /**
     * 阻塞地获取异步任务结果
     */
    public function get(): mixed
    {
        // TODO
    }
}
