# Symfony Async Bundle

[English](README.md) | [中文](README.zh-CN.md)

[![Latest Version](https://img.shields.io/packagist/v/tourze/symfony-async-bundle.svg?style=flat-square)](https://packagist.org/packages/tourze/symfony-async-bundle)
[![Total Downloads](https://img.shields.io/packagist/dt/tourze/symfony-async-bundle.svg?style=flat-square)](https://packagist.org/packages/tourze/symfony-async-bundle)
[![License](https://img.shields.io/github/license/tourze/symfony-async-bundle.svg?style=flat-square)](https://packagist.org/packages/tourze/symfony-async-bundle)

一个使用 Symfony Messenger 提供异步命令执行和服务方法调用功能的 Symfony Bundle。

## 特性

- 支持选项和参数的异步命令执行
- 通过 `#[Async]` 属性进行服务方法调用
- 内置错误处理和日志记录
- 失败操作的自动重试机制
- 延迟执行支持
- 与 Symfony Messenger 完全集成

## 要求

- PHP 8.1 或更高版本
- Symfony 6.4 或更高版本
- Symfony Messenger 组件

## 安装

```bash
composer require tourze/symfony-async-bundle
```

## 配置

在 `config/bundles.php` 中启用 bundle：

```php
return [
    // ...
    Tourze\Symfony\Async\AsyncBundle::class => ['all' => true],
];
```

确保您已经为异步消息配置了 Symfony Messenger 的适当传输。

## 快速开始

### 异步命令执行

```php
<?php

use Symfony\Component\Messenger\MessageBusInterface;use Symfony\Component\Messenger\Stamp\AsyncStamp;use Tourze\AsyncCommandBundle\Message\RunCommandMessage;

class MyController
{
    public function __construct(
        private readonly MessageBusInterface $messageBus
    ) {}

    public function someAction()
    {
        // 创建一个异步运行命令的消息
        $message = new RunCommandMessage();
        $message->setCommand('app:my-command');
        $message->setOptions([
            '--option1' => 'value1',
            '--option2' => 'value2'
        ]);

        // 发送到队列
        $this->messageBus->dispatch($message, [
            new AsyncStamp()
        ]);

        return '命令已加入队列等待执行';
    }
}
```

### 使用 Async 属性

您可以使用 `#[Async]` 属性标记任何服务方法以进行异步执行：

```php
<?php

namespace App\Service;

use Tourze\Symfony\Async\Attribute\Async;

class ReportGenerator
{
    #[Async(retryCount: 3, delayMs: 5000)]
    public function generateLargeReport(int $userId): void
    {
        // 此方法将异步执行
        // 有3次重试尝试和5秒延迟

        // ...耗时操作
    }
}
```

然后正常调用该方法：

```php
$reportGenerator->generateLargeReport(123);
// 这将立即返回，实际工作在后台进行
```

## 贡献

请查看 [CONTRIBUTING.md](CONTRIBUTING.md) 了解详情。

## 许可证

MIT 许可证。请查看 [License 文件](LICENSE) 获取更多信息。
