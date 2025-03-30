<?php

declare(strict_types=1);

namespace Vonage\Account;

use Vonage\Entity\EntityInterface;
use Vonage\Entity\Hydrator\ArrayHydrateInterface;
use Vonage\Entity\JsonResponseTrait;
use Vonage\Entity\JsonSerializableTrait;
use Vonage\Entity\NoRequestResponseTrait;

use function ltrim;
use function preg_replace;
use function strtolower;

class Network implements
    EntityInterface,
    ArrayHydrateInterface
{
    use JsonSerializableTrait;
    use NoRequestResponseTrait;
    use JsonResponseTrait;

    protected array $data = [];

    public function __construct(int|string $networkCode, int|string $networkName)
    {
        $this->data['network_code'] = (string)$networkCode;
        $this->data['network_name'] = (string)$networkName;
    }

    public function getCode(): string
    {
        return $this->data['network_code'];
    }

    public function getName(): string
    {
        return $this->data['network_name'];
    }

    public function getOutboundSmsPrice(): mixed
    {
        return $this->data['sms_price'] ?? $this->data['price'];
    }

    public function getOutboundVoicePrice(): mixed
    {
        return $this->data['voice_price'] ?? $this->data['price'];
    }

    public function getPrefixPrice()
    {
        return $this->data['mt_price'];
    }

    public function getCurrency()
    {
        return $this->data['currency'];
    }

    public function fromArray(array $data): void
    {
        // Convert CamelCase to snake_case as that's how we use array access in every other object
        $storage = [];

        foreach ($data as $k => $v) {
            $k = strtolower(ltrim((string) preg_replace('/[A-Z]([A-Z](?![a-z]))*/', '_$0', $k), '_'));
            $storage[$k] = $v;
        }

        $this->data = $storage;
    }

    public function toArray(): array
    {
        return $this->data;
    }
}
