<?php

namespace App\ApiResource;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use App\StateProvider\FooBarProvider;
use Symfony\Component\Serializer\Annotation\Groups;

#[ApiResource(operations: [
    new Get(),
    new GetCollection(),
], normalizationContext: [
    'groups' => [self::RESOURCE_GET],
    'openapi_definition_name' => 'get',
], provider: FooBarProvider::class)]
enum FooBar: string
{
    case Foo = 'foo';
    case Bar = 'bar';

    public const RESOURCE_GET = 'foo_bar:get';

    #[Groups([self::RESOURCE_GET])]
    #[ApiProperty(writable: false, example: '/api/boo_fars/boo')]
    public function getBooFar(): BooFar
    {
        return match ($this) {
            self::Bar => BooFar::Boo,
            self::Foo => BooFar::Far
        };
    }

    #[Groups([self::RESOURCE_GET])]
    #[ApiProperty(writable: false, identifier: true, example: 'foo')]
    public function getId(): string
    {
        return $this->value;
    }

    #[Groups([self::RESOURCE_GET])]
    #[ApiProperty(writable: false, identifier: true, example: 'Foo')]
    public function getName(): string
    {
        return $this->name;
    }
}
