<?php

namespace App\Entity;

use App\Repository\EquityTradeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
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
    private $seller;

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

    public function getId(): ?int
    {
        return $this->id;
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
}
