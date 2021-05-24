<?php

namespace App\Entity;

use App\Repository\ExchangeRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 * normalizationContext={"groups"={"exchange:read"}},
 * denormalizationContext={"groups"={"exchange:write"}}
 * )
 * @ORM\Entity(repositoryClass=ExchangeRepository::class)
 */
class Exchange
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"exchange:read"})
     */
    private $id;

    /**
     * @Groups({"exchange:read", "exchange:write"})
     * @ORM\Column(type="integer")
     */
    private $equity;

    /**
     * @Groups({"exchange:read"})
     * @ORM\Column(type="datetime_immutable")
     */
    private $date;

    /**
     * @Groups({"exchange:read", "exchange:write"})
     * @ORM\ManyToOne(targetEntity=User::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @Groups({"exchange:read", "exchange:write"})
     * @ORM\Column(type="integer")
     */
    private $gxb;

    public function __construct()
    {
        $this->date = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getDate(): ?\DateTimeImmutable
    {
        return $this->date;
    }

    public function setDate(\DateTimeImmutable $date): self
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

    public function getGxb(): ?int
    {
        return $this->gxb;
    }

    public function setGxb(int $gxb): self
    {
        $this->gxb = $gxb;

        return $this;
    }
}
