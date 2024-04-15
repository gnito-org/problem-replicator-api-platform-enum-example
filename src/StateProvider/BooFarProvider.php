<?php

namespace App\StateProvider;

use ApiPlatform\Metadata\CollectionOperationInterface;
use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use App\ApiResource\BooFar;

class BooFarProvider implements ProviderInterface
{
    public function provide(
        Operation|CollectionOperationInterface $operation,
        array $uriVariables = [],
        array $context = []
    ): array|object|null {
        if ($operation instanceof CollectionOperationInterface) {
            return BooFar::cases();
        }

        return BooFar::tryFrom($uriVariables['id']);
    }

}