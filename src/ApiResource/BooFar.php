<?php

namespace App\ApiResource;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use App\StateProvider\BooFarProvider;
use Symfony\Component\Serializer\Annotation\Groups;

#[ApiResource(operations: [
    new Get(),
    new GetCollection(),
], normalizationContext: [
    'groups' => [self::RESOURCE_GET],
    'openapi_definition_name' => 'get',
], provider: BooFarProvider::class)]
enum BooFar: string
{
    case Boo = 'boo';
    case Far = 'far';

    public const RESOURCE_GET = 'boo_Far:get';

    #[Groups([self::RESOURCE_GET])]
    #[ApiProperty(writable: false, openapiContext: ['example' => '/api/foo_bars/boo'])]
    public function getFooBar(): FooBar
    {
        return match ($this) {
            self::Boo => FooBar::Bar,
            self::Far => FooBar::Foo
        };
    }

    #[Groups([self::RESOURCE_GET])]
    #[ApiProperty(writable: false, identifier: true, openapiContext: ['example' => 'boo'])]
    public function getId(): string
    {
        return $this->value;
    }

    #[Groups([self::RESOURCE_GET])]
    #[ApiProperty(writable: false, identifier: true, openapiContext: ['example' => 'Boo'])]
    public function getName(): string
    {
        return $this->name;
    }
}
