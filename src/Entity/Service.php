<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\ServiceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ServiceRepository::class)]
#[ApiResource()]
class Service
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $image = null;

    #[ORM\Column]
    private ?int $price = null;

    /**
     * @var Collection<int, CommandItem>
     */
    #[ORM\OneToMany(targetEntity: CommandItem::class, mappedBy: 'service')]
    private Collection $service;

    /**
     * @var Collection<int, ItemService>
     */
    #[ORM\OneToMany(targetEntity: ItemService::class, mappedBy: 'service')]
    private Collection $itemServices;

    public function __construct()
    {
        $this->service = new ArrayCollection();
        $this->itemServices = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): static
    {
        $this->price = $price;

        return $this;
    }

    /**
     * @return Collection<int, CommandItem>
     */
    public function getService(): Collection
    {
        return $this->service;
    }

    public function addService(CommandItem $service): static
    {
        if (!$this->service->contains($service)) {
            $this->service->add($service);
            $service->setService($this);
        }

        return $this;
    }

    public function removeService(CommandItem $service): static
    {
        if ($this->service->removeElement($service)) {
            // set the owning side to null (unless already changed)
            if ($service->getService() === $this) {
                $service->setService(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, ItemService>
     */
    public function getItemServices(): Collection
    {
        return $this->itemServices;
    }

    public function addItemService(ItemService $itemService): static
    {
        if (!$this->itemServices->contains($itemService)) {
            $this->itemServices->add($itemService);
            $itemService->setService($this);
        }

        return $this;
    }

    public function removeItemService(ItemService $itemService): static
    {
        if ($this->itemServices->removeElement($itemService)) {
            // set the owning side to null (unless already changed)
            if ($itemService->getService() === $this) {
                $itemService->setService(null);
            }
        }

        return $this;
    }
}
