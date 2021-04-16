<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\OrderFilter;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Repository\LandPostRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource(
 * normalizationContext={"groups"={"landpost:read"}},
 * denormalizationContext={"groups"={"landpost:write"}}
 * )
 * @ApiFilter(SearchFilter::class, properties={"land": "exact"})
 * @ApiFilter(OrderFilter::class, properties={"price"})
 * @ORM\Entity(repositoryClass=LandPostRepository::class)
 */
class LandPost
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @Groups({"landpost:read"})
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Groups({"landpost:read", "landpost:write"})
     * @ORM\ManyToOne(targetEntity=Land::class)
     */
    private $land;

    /**
     * @Groups({"landpost:read", "landpost:write"})
     * @ORM\ManyToOne(targetEntity=User::class)
     */
    private $owner;

    /**
     * @Groups({"landpost:read", "landpost:write"})
     * @ORM\Column(type="integer")
     */
    private $price;

    /**
     * @Groups({"landpost:read", "landpost:write"})
     * @ORM\Column(type="integer")
     */
    private $days;

    /**
     * @Groups({"landpost:read", "landpost:write"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * @Groups({"landpost:read", "landpost:write"})
     * @ORM\Column(type="string", length=255)
     */
    private $body;

    /**
     * @Groups({"landpost:read", "landpost:write"})
     * @ORM\Column(type="string", length=255)
     */
    private $cover;

    /**
     * @Groups({"landpost:read", "landpost:write"})
     * @ORM\Column(type="simple_array", nullable=true)
     */
    private $pics = [];

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLand(): ?Land
    {
        return $this->land;
    }

    public function setLand(?Land $land): self
    {
        $this->land = $land;

        return $this;
    }

    public function getOwner(): ?User
    {
        return $this->owner;
    }

    public function setOwner(?User $owner): self
    {
        $this->owner = $owner;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price / 100;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price * 100;

        return $this;
    }

    public function getDays(): ?int
    {
        return $this->days;
    }

    public function setDays(int $days): self
    {
        $this->days = $days;

        return $this;
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

    public function getBody(): ?string
    {
        return $this->body;
    }

    public function setBody(string $body): self
    {
        $this->body = $body;

        return $this;
    }

    public function getCover(): ?string
    {
        return $this->cover;
    }

    public function setCover(string $cover): self
    {
        $this->cover = $cover;

        return $this;
    }

    public function getPics(): ?array
    {
        return $this->pics;
    }

    public function setPics(?array $pics): self
    {
        $this->pics = $pics;

        return $this;
    }
}
