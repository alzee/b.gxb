<?php

namespace App\Entity;

use App\Repository\DividendRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=DividendRepository::class)
 */
class Dividend
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity=User::class)
     */
    private $user;

    /**
     * @ORM\Column(type="integer")
     */
    private $amount;

    /**
     * @ORM\Column(type="integer")
     */
    private $coin;

    /**
     * @ORM\Column(type="integer")
     */
    private $coinTotal;

    /**
     * @ORM\Column(type="integer")
     */
    private $fund;

    /**
     * @ORM\Column(type="integer")
     */
    private $coinThreshold;

    public function __construct()
    {
        $this->date = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getAmount(): ?int
    {
        return $this->amount;
    }

    public function setAmount(int $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    public function getCoin(): ?int
    {
        return $this->coin;
    }

    public function setCoin(int $coin): self
    {
        $this->coin = $coin;

        return $this;
    }

    public function getCoinTotal(): ?int
    {
        return $this->coinTotal;
    }

    public function setCoinTotal(int $coinTotal): self
    {
        $this->coinTotal = $coinTotal;

        return $this;
    }

    public function getFund(): ?int
    {
        return $this->fund;
    }

    public function setFund(int $fund): self
    {
        $this->fund = $fund;

        return $this;
    }

    public function getCoinThreshold(): ?int
    {
        return $this->coinThreshold;
    }

    public function setCoinThreshold(int $coinThreshold): self
    {
        $this->coinThreshold = $coinThreshold;

        return $this;
    }
}
