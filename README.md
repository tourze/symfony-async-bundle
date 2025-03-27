# Symfony Async Bundle

[English](#english) | [中文](#中文)

## English

A Symfony bundle that provides asynchronous command execution capabilities using Symfony Messenger.

### Features

- Asynchronous command execution
- Built-in error handling and logging
- Support for command options and arguments
- Integration with Symfony Messenger

### Requirements

- PHP 8.1 or higher
- Symfony 6.4 or higher
- Symfony Messenger component

### Installation

```bash
composer require tourze/symfony-async-bundle
```

### Configuration

Enable the bundle in your `config/bundles.php`:

```php
return [
    // ...
    Tourze\Symfony\Async\AsyncBundle::class => ['all' => true],
];
```

### Usage

1. Create a message:

```php
use Tourze\Symfony\Async\Message\RunCommandMessage;

$message = new RunCommandMessage();
$message->setCommand('your:command');
$message->setOptions([
    '--option1' => 'value1',
    '--option2' => 'value2'
]);
```

2. Dispatch the message:

```php
$this->messageBus->dispatch($message, [
    new AsyncStamp()
]);
```

### License

This bundle is licensed under the MIT License.

---

## 中文

一个使用 Symfony Messenger 提供异步命令执行功能的 Symfony Bundle。

### 特性

- 异步命令执行
- 内置错误处理和日志记录
- 支持命令选项和参数
- 与 Symfony Messenger 集成

### 要求

- PHP 8.1 或更高版本
- Symfony 6.4 或更高版本
- Symfony Messenger 组件

### 安装

```bash
composer require tourze/symfony-async-bundle
```

### 配置

在 `config/bundles.php` 中启用 bundle：

```php
return [
    // ...
    Tourze\Symfony\Async\AsyncBundle::class => ['all' => true],
];
```

### 使用方法

1. 创建消息：

```php
use Tourze\Symfony\Async\Message\RunCommandMessage;

$message = new RunCommandMessage();
$message->setCommand('your:command');
$message->setOptions([
    '--option1' => 'value1',
    '--option2' => 'value2'
]);
```

2. 发送消息：

```php
$this->messageBus->dispatch($message, [
    new AsyncStamp()
]);
```

### 许可证

本 Bundle 基于 MIT 许可证。
