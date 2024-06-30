<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\ItemRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ItemRepository::class)]
#[ApiResource()]
class Item
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $image = null;

    #[ORM\Column]
    private ?int $price = null;

    /**
     * @var Collection<int, CommandItem>
     */
    #[ORM\OneToMany(targetEntity: CommandItem::class, mappedBy: 'item')]
    private Collection $item;

    #[ORM\ManyToOne(inversedBy: 'category')]
    private ?Category $category = null;

    /**
     * @var Collection<int, ItemService>
     */
    #[ORM\OneToMany(targetEntity: ItemService::class, mappedBy: 'item')]
    private Collection $items_service;

    public function __construct()
    {
        $this->item = new ArrayCollection();
        $this->items_service = new ArrayCollection();
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
    public function getItem(): Collection
    {
        return $this->item;
    }

    public function addItem(CommandItem $item): static
    {
        if (!$this->item->contains($item)) {
            $this->item->add($item);
            $item->setItem($this);
        }

        return $this;
    }

    public function removeItem(CommandItem $item): static
    {
        if ($this->item->removeElement($item)) {
            // set the owning side to null (unless already changed)
            if ($item->getItem() === $this) {
                $item->setItem(null);
            }
        }

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): static
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @return Collection<int, ItemService>
     */
    public function getItemsService(): Collection
    {
        return $this->items_service;
    }

    public function addItemsService(ItemService $itemsService): static
    {
        if (!$this->items_service->contains($itemsService)) {
            $this->items_service->add($itemsService);
            $itemsService->setItem($this);
        }

        return $this;
    }

    public function removeItemsService(ItemService $itemsService): static
    {
        if ($this->items_service->removeElement($itemsService)) {
            // set the owning side to null (unless already changed)
            if ($itemsService->getItem() === $this) {
                $itemsService->setItem(null);
            }
        }

        return $this;
    }
}
