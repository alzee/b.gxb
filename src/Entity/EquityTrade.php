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
     * @ORM\JoinColumn(nullable=true)
     */
    private $buyer;

    /**
     * @ORM\Column(type="integer")
     */
    private $equity;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $rmb;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity=User::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $seller;

    /**
     * @ORM\Column(type="smallint")
     */
    private $status = 0;

    public function __construct()
    {
        $this->date = new \DateTimeImmutable();
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

    public function getDate(): ?\DateTimeImmutable
    {
        return $this->date;
    }

    public function setDate(\DateTimeImmutable $date): self
    {
        $this->date = $date;

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

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(int $status): self
    {
        $this->status = $status;

        return $this;
    }
}
