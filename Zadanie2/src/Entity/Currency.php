<?php

namespace App\Entity;

use App\Repository\CurrencyRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CurrencyRepository::class)]
class Currency
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $currency_code = null;

    #[ORM\Column]
    private ?float $exchange_rate = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getCurrency_code(): ?string
    {
        return $this->currency_code;
    }

    public function setCurrency_code(string $currency_code): self
    {
        $this->currency_code = $currency_code;

        return $this;
    }

    public function getExchange_rate(): ?float
    {
        return $this->exchange_rate;
    }

    public function setExchange_rate(float $exchange_rate): self
    {
        $this->exchange_rate = $exchange_rate;

        return $this;
    }
}
