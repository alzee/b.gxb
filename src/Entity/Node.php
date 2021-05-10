<?php

namespace App\Entity;

use App\Repository\NodeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\OrderFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;

/**
 * @ApiResource(
 * normalizationContext={"groups"={"node:read"}},
 * denormalizationContext={"groups"={"node:write"}}
 * )
 * @ApiFilter(OrderFilter::class, properties={"id"})
 * @ApiFilter(SearchFilter::class, properties={"type.id": "exact"})
 * @ORM\Entity(repositoryClass=NodeRepository::class)
 */
class Node
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
    private $title;

    /**
     * @Groups({"node:read", "node:write"})
     * @ORM\Column(type="datetime_immutable")
     */
    private $date;

    /**
     * @Groups({"node:read", "node:write"})
     * @ORM\ManyToOne(targetEntity=User::class)
     */
    private $author;

    /**
     * @Groups({"node:read", "node:write"})
     * @ORM\ManyToOne(targetEntity=NodeType::class)
     */
    private $type;

    /**
     * @Groups({"node:read", "node:write"})
     * @ORM\Column(type="text", nullable=true)
     */
    private $body;

    /**
     * @Groups({"node:read", "node:write"})
     * @ORM\OneToMany(targetEntity=Vote::class, mappedBy="node")
     */
    private $votes;

    /**
     * @return Collection|Vote[]
     */
    public function getVotes(): Collection
    {
        return $this->votes;
    }

    public function __construct()
    {
        $this->date = new \DateTimeImmutable();
        $this->votes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

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

    public function getAuthor(): ?User
    {
        return $this->author;
    }

    public function setAuthor(?User $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function getType(): ?NodeType
    {
        return $this->type;
    }

    public function setType(?NodeType $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getBody(): ?string
    {
        return $this->body;
    }

    public function setBody(?string $body): self
    {
        $this->body = $body;

        return $this;
    }
}
