<?php

namespace App\Entity;

use App\Repository\EquityTradeRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=EquityTradeRepository::class)
 */
class EquityTrade
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $buyer;

    /**
     * @ORM\Column(type="integer")
     */
    private $equity;

    /**
     * @ORM\Column(type="integer")
     */
    private $rmb;

    /**
     * @ORM\Column(type="float")
     */
    private $rate;

    /**
     * @ORM\ManyToOne(targetEntity=EquityShop::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $shop;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $date;

    public function __construct()
    {
        $this->date = new \DateTimeImmutable();
        $this->date = $this->date->setTimezone(new \DateTimeZone('Asia/Shanghai'));
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getEquity(): ?int
    {
        return $this->equity;
    }

    public function setEquity(int $equity): self
    {
        $this->equity = $equity;

        return $this;
    }

    public function getRmb(): ?int
    {
        return $this->rmb;
    }

    public function setRmb(int $rmb): self
    {
        $this->rmb = $rmb;

        return $this;
    }

    public function getRate(): ?float
    {
        return $this->rate;
    }

    public function setRate(float $rate): self
    {
        $this->rate = $rate;

        return $this;
    }

    public function getShop(): ?EquityShop
    {
        return $this->shop;
    }

    public function setShop(?EquityShop $shop): self
    {
        $this->shop = $shop;

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
}
