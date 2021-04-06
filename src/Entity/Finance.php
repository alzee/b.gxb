<?php

namespace App\Entity;

use App\Repository\FinanceRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=FinanceRepository::class)
 */
class Finance
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $note;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\Column(type="float")
     */
    private $amount;

    /**
     * @ORM\OneToOne(targetEntity=User::class, cascade={"persist", "remove"})
     */
    private $user;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $prepayid;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $orderid;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $wx_orderid;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNote(): ?string
    {
        return $this->note;
    }

    public function setType(string $note): self
    {
        $this->note= $note;

        return $this;
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

    public function getAmount(): ?float
    {
        return $this->amount;
    }

    public function setAmount(float $amount): self
    {
        $this->amount = $amount;

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

    public function getPrepayid(): ?string
    {
        return $this->prepayid;
    }

    public function setPrepayid(?string $prepayid): self
    {
        $this->prepayid = $prepayid;

        return $this;
    }

    public function getOrderid(): ?string
    {
        return $this->orderid;
    }

    public function setOrderid(?string $orderid): self
    {
        $this->orderid = $orderid;

        return $this;
    }

    public function getWxOrderid(): ?string
    {
        return $this->wx_orderid;
    }

    public function setWxOrderid(string $wx_orderid): self
    {
        $this->wx_orderid = $wx_orderid;

        return $this;
    }
}
