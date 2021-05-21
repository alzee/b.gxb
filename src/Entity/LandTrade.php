<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\OrderFilter;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Repository\LandTradeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource(
 * normalizationContext={"groups"={"landtrade:read"}},
 * denormalizationContext={"groups"={"landtrade:write"}}
 * )
 * @ApiFilter(OrderFilter::class, properties={"date", "id"})
 * @ORM\Entity(repositoryClass=LandTradeRepository::class)
 */
class LandTrade
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @Groups({"landtrade:read"})
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Groups({"landtrade:read", "landtrade:write"})
     * @ORM\ManyToOne(targetEntity=Land::class)
     */
    private $land;

    /**
     * @Groups({"landtrade:read", "landtrade:write"})
     * @ORM\ManyToOne(targetEntity=User::class)
     */
    private $seller;

    /**
     * @Groups({"landtrade:read", "landtrade:write"})
     * @ORM\ManyToOne(targetEntity=User::class)
     */
    private $buyer;

    /**
     * @Groups({"landtrade:read", "landtrade:write"})
     * @ORM\Column(type="datetime_immutable")
     */
    private $date;

    /**
     * @Groups({"landtrade:read"})
     * @ORM\Column(type="integer", nullable=true)
     */
    private $prePrice;

    /**
     * @Groups({"landtrade:read", "landtrade:write"})
     * @ORM\Column(type="integer", nullable=true)
     */
    private $price;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLand(): ?Land
    {
        return $this->land;
    }

    public function setLand(?Land $land): self
    {
        $this->land = $land;

        return $this;
    }

    public function getSeller(): ?User
    {
        return $this->seller;
    }

    public function setSeller(?User $seller): self
    {
        $this->seller = $seller;

        return $this;
    }

    public function getBuyer(): ?User
    {
        return $this->buyer;
    }

    public function setBuyer(?User $buyer): self
    {
        $this->buyer = $buyer;

        return $this;
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

    public function getPrePrice(): ?int
    {
        return $this->prePrice;
    }

    public function setPrePrice(?int $prePrice): self
    {
        $this->prePrice = $prePrice;

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
}
