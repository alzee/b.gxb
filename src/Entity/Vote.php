<?php

namespace App\Entity;

use App\Repository\VoteRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 * collectionOperations={"get", "post"},
 * normalizationContext={"groups"={"vote:read"}},
 * denormalizationContext={"groups"={"vote:write"}}
 * )
 * @ApiFilter(SearchFilter::class, properties={"user": "exact", "node": "exact"})
 * @ORM\Entity(repositoryClass=VoteRepository::class)
 */
class Vote
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"vote:read"})
     * @Groups({"node:read"})
     */
    private $id;

    /**
     * @Groups({"vote:read", "vote:write"})
     * @Groups({"node:read"})
     * @ORM\ManyToOne(targetEntity=User::class)
     */
    private $user;

    /**
     * @Groups({"vote:read", "vote:write"})
     * @ORM\ManyToOne(targetEntity=Node::class)
     */
    private $node;

    /**
     * @Groups({"vote:read", "vote:write"})
     * @Groups({"node:read"})
     * @ORM\Column(type="boolean")
     */
    private $isUp;

    /**
     * @Groups({"vote:read", "vote:write"})
     * @Groups({"node:read"})
     * @ORM\Column(type="datetime")
     */
    private $date;

    public function __construct()
    {
        $this->date = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getNode(): ?Node
    {
        return $this->node;
    }

    public function setNode(?Node $node): self
    {
        $this->node = $node;

        return $this;
    }

    public function getIsUp(): ?bool
    {
        return $this->isUp;
    }

    public function setIsUp(bool $isUp): self
    {
        $this->isUp = $isUp;

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
}
