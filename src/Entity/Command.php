<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\CommandRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: CommandRepository::class)]
#[ApiResource(normalizationContext:['groups' => ['command:read']])]
class Command
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['command:read'])]
    private ?int $id = null;

    #[ORM\Column]
    #[Groups(['command:read'])]
    private ?float $price = null;

    #[ORM\Column(length: 255)]
    #[Groups(['command:read'])]
    private ?string $status = null;

    #[ORM\Column]
    #[Groups(['command:read'])]
    private ?bool $delivery = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    #[Groups(['command:read'])]
    private ?\DateTimeInterface $delivery_date = null;

    #[ORM\ManyToOne(inversedBy: 'commands')]
    #[Groups(['command:read'])]
    private ?User $user = null;

    #[ORM\Column]
    #[Groups(['command:read'])]
    private array $command_items = [];

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function isDelivery(): ?bool
    {
        return $this->delivery;
    }

    public function setDelivery(bool $delivery): static
    {
        $this->delivery = $delivery;

        return $this;
    }

    public function getdelivery_date(): ?\DateTimeInterface
    {
        return $this->delivery_date;
    }

    public function setdelivery_date(\DateTimeInterface $delivery_date): static
    {
        $this->delivery_date = $delivery_date;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getcommand_items(): array
    {
        return $this->command_items;
    }

    public function setcommand_items(array $command_items): static
    {
        $this->command_items = $command_items;

        return $this;
    }
}
