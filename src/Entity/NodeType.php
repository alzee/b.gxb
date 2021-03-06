<?php

namespace App\Entity;

use App\Repository\NodeTypeRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=NodeTypeRepository::class)
 */
class NodeType
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @Groups({"node:read"})
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Groups({"node:read", "node:write"})
     * @ORM\Column(type="string", length=255)
     */
    private $name;

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

    public function __toString(): string
    {
        return $this->name;
    }
}
