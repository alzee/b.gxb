<?php

namespace App\Entity;

use App\Repository\CouponRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ApiResource(
 * normalizationContext={"groups"={"coupon:read"}},
 * denormalizationContext={"groups"={"coupon:write"}}
 * )
 * @ORM\Entity(repositoryClass=CouponRepository::class)
 */
class Coupon
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @Groups({"user:read"})
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Groups({"user:read"})
     * @ORM\Column(type="integer", nullable=true)
     */
    private $value;

    /**
     * @Groups({"user:read"})
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $type;

    /**
     * @Groups({"user:read"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $note;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getValue(): ?int
    {
        return $this->value;
    }

    public function setValue(?int $value): self
    {
        $this->value = $value;

        return $this;
    }

    public function getType(): ?int
    {
        return $this->type;
    }

    public function setType(int $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getNote(): ?string
    {
        return $this->note;
    }

    public function setNote(?string $note): self
    {
        $this->note = $note;

        return $this;
    }

    public function __toString(): string
    {
        return $this->note;
    }
}
