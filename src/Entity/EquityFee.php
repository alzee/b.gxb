<?php

namespace App\Entity;

use App\Repository\EquityFeeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EquityFeeRepository::class)
 */
class EquityFee
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $l1;

    /**
     * @ORM\Column(type="integer")
     */
    private $l2;

    /**
     * @ORM\Column(type="float")
     */
    private $rate;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isStar;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getL1(): ?int
    {
        return $this->l1;
    }

    public function setL1(int $l1): self
    {
        $this->l1 = $l1;

        return $this;
    }

    public function getL2(): ?int
    {
        return $this->l2;
    }

    public function setL2(int $l2): self
    {
        $this->l2 = $l2;

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

    public function getIsStar(): ?bool
    {
        return $this->isStar;
    }

    public function setIsStar(?bool $isStar): self
    {
        $this->isStar = $isStar;

        return $this;
    }
}
