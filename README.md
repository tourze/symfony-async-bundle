# Symfony Async Bundle

[English](README.md) | [中文](README.zh-CN.md)

[![Latest Version](https://img.shields.io/packagist/v/tourze/symfony-async-bundle.svg?style=flat-square)](https://packagist.org/packages/tourze/symfony-async-bundle)
[![Total Downloads](https://img.shields.io/packagist/dt/tourze/symfony-async-bundle.svg?style=flat-square)](https://packagist.org/packages/tourze/symfony-async-bundle)
[![License](https://img.shields.io/github/license/tourze/symfony-async-bundle.svg?style=flat-square)](https://packagist.org/packages/tourze/symfony-async-bundle)

A Symfony bundle that provides asynchronous command execution and service method invocation capabilities using Symfony Messenger.

## Features

- Asynchronous command execution with full support for options and arguments
- Service method invocation through the `#[Async]` attribute
- Built-in error handling and logging
- Automatic retry mechanism for failed operations
- Delayed execution support
- Full integration with Symfony Messenger

## Requirements

- PHP 8.1 or higher
- Symfony 6.4 or higher
- Symfony Messenger component

## Installation

```bash
composer require tourze/symfony-async-bundle
```

## Configuration

Enable the bundle in your `config/bundles.php`:

```php
return [
    // ...
    Tourze\Symfony\Async\AsyncBundle::class => ['all' => true],
];
```

Make sure you have configured Symfony Messenger with appropriate transport for async messages.

## Quick Start

### Asynchronous Command Execution

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
        // Create a message to run a command asynchronously
        $message = new RunCommandMessage();
        $message->setCommand('app:my-command');
        $message->setOptions([
            '--option1' => 'value1',
            '--option2' => 'value2'
        ]);

        // Dispatch to queue
        $this->messageBus->dispatch($message, [
            new AsyncStamp()
        ]);

        return 'Command queued for execution';
    }
}
```

### Using Async Attribute

You can mark any service method for asynchronous execution using the `#[Async]` attribute:

```php
<?php

namespace App\Service;

use Tourze\Symfony\Async\Attribute\Async;

class ReportGenerator
{
    #[Async(retryCount: 3, delayMs: 5000)]
    public function generateLargeReport(int $userId): void
    {
        // This method will be executed asynchronously
        // with 3 retry attempts and 5-second delay

        // ...time-consuming operations
    }
}
```

Then call the method normally:

```php
$reportGenerator->generateLargeReport(123);
// This returns immediately, with the actual work happening in the background
```

## Contributing

Please see [CONTRIBUTING.md](CONTRIBUTING.md) for details.

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.
