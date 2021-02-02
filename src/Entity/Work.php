<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Repository\WorkRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource(
 * normalizationContext={"groups"={"work:read"}},
 * denormalizationContext={"groups"={"work:write"}}
 * )
 * @ORM\Entity(repositoryClass=WorkRepository::class)
 */
class Work
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Apply::class, inversedBy="works")
     */
    private $apply;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $imgUrl;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getApply(): ?Apply
    {
        return $this->apply;
    }

    public function setApply(?Apply $apply): self
    {
        $this->apply = $apply;

        return $this;
    }

    public function getImgUrl(): ?string
    {
        return $this->imgUrl;
    }

    public function setImgUrl(?string $imgUrl): self
    {
        $this->imgUrl = $imgUrl;

        return $this;
    }
}
