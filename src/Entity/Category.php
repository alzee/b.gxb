<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 * normalizationContext={"groups"={"cate:read"}},
 * denormalizationContext={"groups"={"cate:write"}}
 * )
 * @ORM\Entity(repositoryClass=CategoryRepository::class)
 */
class Category
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"task:read"})
     * @Groups({"cate:read", "cate:write"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"cate:read", "cate:write"})
     * @Groups({"task:read"})
     * @Groups({"bid:read"})
     * @Groups({"apply:read"})
     */
    private $name;

    /**
     * @Groups({"cate:read", "cate:write"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $label;

    /**
     * @Groups({"cate:read", "cate:write"})
     * @ORM\Column(type="float", nullable=true)
     */
    private $rate;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): self
    {
        $this->label = $label;

        return $this;
    }

    public function __toString(): string
    {
        return $this->name;
    }

    public function getRate(): ?float
    {
        return $this->rate;
    }

    public function setRate(?float $rate): self
    {
        $this->rate = $rate;

        return $this;
    }
}
