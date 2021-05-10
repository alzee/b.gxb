<?php

namespace App\Entity;

use App\Repository\ReadRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 * normalizationContext={"groups"={"read:read"}},
 * denormalizationContext={"groups"={"read:write"}}
 * )
 * @ApiFilter(SearchFilter::class, properties={"user": "exact", "post": "exact"})
 * @ORM\Entity(repositoryClass=ReadRepository::class)
 * @ORM\Table(name="`read`")
 */
class Read
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"read:read"})
     * @Groups({"landpost:read"})
     */
    private $id;

    /**
     * @Groups({"read:read", "read:write"})
     * @Groups({"landpost:read"})
     * @ORM\ManyToOne(targetEntity=User::class)
     */
    private $user;

    /**
     * @Groups({"read:read", "read:write"})
     * @ORM\ManyToOne(targetEntity=LandPost::class)
     */
    private $post;

    /**
     * @Groups({"read:read"})
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

    public function getPost(): ?LandPost
    {
        return $this->post;
    }

    public function setPost(?LandPost $post): self
    {
        $this->post = $post;

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
