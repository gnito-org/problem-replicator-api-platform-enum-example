<?php

namespace App\StateProvider;

use ApiPlatform\Metadata\CollectionOperationInterface;
use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use App\ApiResource\FooBar;

class FooBarProvider implements ProviderInterface
{
    public function provide(
        Operation|CollectionOperationInterface $operation,
        array $uriVariables = [],
        array $context = []
    ): array|object|null {
        if ($operation instanceof CollectionOperationInterface) {
            return FooBar::cases();
        }

        return FooBar::tryFrom($uriVariables['id']);
    }

}