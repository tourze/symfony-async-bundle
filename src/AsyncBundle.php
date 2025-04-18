<?php

namespace Tourze\Symfony\Async;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Tourze\Symfony\Async\DependencyInjection\Compiler\RemoveUnusedServicePass;

class AsyncBundle extends Bundle
{
    public function build(ContainerBuilder $container): void
    {
        parent::build($container);
        $container->addCompilerPass(new RemoveUnusedServicePass());
    }
}
