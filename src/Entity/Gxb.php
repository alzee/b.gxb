<?php

namespace App\Entity;

use App\Repository\GxbRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\OrderFilter;

/**
 * @ApiResource(
 * normalizationContext={"groups"={"gxb:read"}},
 * denormalizationContext={"groups"={"gxb:write"}}
 * )
 * @ApiFilter(SearchFilter::class, properties={"user.id": "exact"})
 * @ApiFilter(OrderFilter::class, properties={"date"})
 * @ORM\Entity(repositoryClass=GxbRepository::class)
 */
class Gxb
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @Groups({"gxb:read"})
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Groups({"gxb:read"})
     * @ORM\Column(type="datetime_immutable")
     */
    private $date;

    /**
     * @Groups({"gxb:read", "gxb:write"})
     * @ORM\Column(type="integer")
     */
    private $amount;

    /**
     * @Groups({"gxb:read", "gxb:write"})
     * @ORM\ManyToOne(targetEntity=User::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @Groups({"gxb:read", "gxb:write"})
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $type;

    public function __construct()
    {
        $this->date = new \DateTimeImmutable();
        //$this->date = $this->date->setTimezone(new \DateTimeZone('Asia/Shanghai'));
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getAmount(): ?int
    {
        return $this->amount;
    }

    public function setAmount(int $amount): self
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

    public function getType(): ?int
    {
        return $this->type;
    }

    public function setType(?int $type): self
    {
        $this->type = $type;

        return $this;
    }
}
