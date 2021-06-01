<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\BooleanFilter;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Repository\LandRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\OrderFilter;

/**
 * @ApiResource(
 * normalizationContext={"groups"={"land:read"}},
 * denormalizationContext={"groups"={"land:write"}}
 * )
 * @ApiFilter(SearchFilter::class, properties={"name": "exact", "owner.id": "exact"})
 * @ApiFilter(BooleanFilter::class, properties={"forSale"})
 * @ApiFilter(OrderFilter::class, properties={"updatedAt"})
 * @ORM\Entity(repositoryClass=LandRepository::class)
 */
class Land
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @Groups({"land:read"})
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $code;

    /**
     * @Groups({"land:read", "land:write"})
     * @Groups({"landtrade:read"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @Groups({"land:read", "land:write"})
     * @Groups({"landtrade:read"})
     * @ORM\ManyToOne(targetEntity=User::class)
     */
    private $owner;

    /**
     * @Groups({"land:read", "land:write"})
     * @ORM\Column(type="integer", nullable=true)
     */
    private $price;

    /**
     * @Groups({"land:read", "land:write"})
     * @ORM\Column(type="boolean")
     */
    private $forSale = true;

    /**
     * @Groups({"land:read", "land:write"})
     * @ORM\Column(type="integer", nullable=true)
     */
    private $prePrice;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $date;

    /**
     * @Groups({"land:read"})
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updatedAt;

    public function __construct()
    {
        $this->date = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getOwner(): ?User
    {
        return $this->owner;
    }

    public function setOwner(?User $owner): self
    {
        $this->owner = $owner;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(?int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getForSale(): ?bool
    {
        return $this->forSale;
    }

    public function setForSale(bool $forSale): self
    {
        $this->forSale = $forSale;

        return $this;
    }

    public function getPrePrice(): ?int
    {
        return $this->prePrice;
    }

    public function setPrePrice(?int $prePrice): self
    {
        $this->prePrice = $prePrice;

        return $this;
    }

    public function __toString(): string
    {
        return $this->name;
    }

    public function getDate(): ?\DateTimeImmutable
    {
        return $this->date;
    }

    public function setDate(\DateTimeImmutable $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}
