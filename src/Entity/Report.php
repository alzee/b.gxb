<?php

namespace App\Entity;

use App\Repository\ReportRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource()
 * @ApiFilter(SearchFilter::class, properties={"apply.id": "exact"})
 * @ORM\Entity(repositoryClass=ReportRepository::class)
 */
class Report
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=Apply::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $apply;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $descA;

    /**
     * @ORM\Column(type="simple_array", nullable=true)
     */
    private $picsA = [];

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $descB;

    /**
     * @ORM\Column(type="simple_array", nullable=true)
     */
    private $picsB = [];

    public function getApply(): ?Apply
    {
        return $this->apply;
    }

    public function setApply(Apply $apply): self
    {
        $this->apply = $apply;

        return $this;
    }

    public function getDescA(): ?string
    {
        return $this->descA;
    }

    public function setDescA(?string $descA): self
    {
        $this->descA = $descA;

        return $this;
    }

    public function getPicsA(): ?array
    {
        return $this->picsA;
    }

    public function setPicsA(?array $picsA): self
    {
        $this->picsA = $picsA;

        return $this;
    }

    public function getDescB(): ?string
    {
        return $this->descB;
    }

    public function setDescB(?string $descB): self
    {
        $this->descB = $descB;

        return $this;
    }

    public function getPicsB(): ?array
    {
        return $this->picsB;
    }

    public function setPicsB(?array $picsB): self
    {
        $this->picsB = $picsB;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }
}
