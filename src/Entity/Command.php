<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\CommandRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommandRepository::class)]
#[ApiResource()]
class Command
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(length: 255)]
    private ?string $status = null;

    #[ORM\ManyToOne(inversedBy: 'commands')]
    private ?User $user = null;

    /**
     * @var Collection<int, CommandItem>
     */
    #[ORM\OneToMany(targetEntity: CommandItem::class, mappedBy: 'command')]
    private Collection $command_items;

    public function __construct()
    {
        $this->command_items = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

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

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection<int, CommandItem>
     */
    public function getCommandItems(): Collection
    {
        return $this->command_items;
    }

    public function addCommandItem(CommandItem $commandItem): static
    {
        if (!$this->command_items->contains($commandItem)) {
            $this->command_items->add($commandItem);
            $commandItem->setCommand($this);
        }

        return $this;
    }

    public function removeCommandItem(CommandItem $commandItem): static
    {
        if ($this->command_items->removeElement($commandItem)) {
            // set the owning side to null (unless already changed)
            if ($commandItem->getCommand() === $this) {
                $commandItem->setCommand(null);
            }
        }

        return $this;
    }
}
