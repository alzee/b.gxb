<?php

namespace App\Entity;

use App\Repository\ReportRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\OrderFilter;

/**
 * @ApiResource(
 * collectionOperations={"get", "post"},
 * itemOperations={"get", "patch"},
 * normalizationContext={"groups"={"report:read"}},
 * denormalizationContext={"groups"={"report:write"}}
 * )
 * @ApiFilter(SearchFilter::class, properties={"apply": "exact", "apply.applicant": "exact", "apply.task.owner": "exact"})
 * @ApiFilter(OrderFilter::class, properties={"id"})
 * @ORM\Entity(repositoryClass=ReportRepository::class)
 */
class Report
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"report:read"})
     */
    private $id;

    /**
     * @Groups({"report:read", "report:write"})
     * @ORM\OneToOne(targetEntity=Apply::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $apply;

    /**
     * @Groups({"report:read", "report:write"})
     * @Groups({"task:read", "task:write"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $descA;

    /**
     * @Groups({"report:read", "report:write"})
     * @Groups({"task:read", "task:write"})
     * @ORM\Column(type="simple_array", nullable=true)
     */
    private $picsA = [];

    /**
     * @Groups({"report:read", "report:write"})
     * @Groups({"task:read", "task:write"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $descB;

    /**
     * @Groups({"report:read", "report:write"})
     * @Groups({"task:read", "task:write"})
     * @ORM\Column(type="simple_array", nullable=true)
     */
    private $picsB = [];

    /**
     * @Groups({"report:read"})
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $date;

    /**
     * 0 评审中
     * 1 维权无效
     * 2 维权成功
     * @Groups({"report:read", "report:write"})
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $status = 0;

    public function __construct()
    {
        $this->date = new \DateTimeImmutable();
    }

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

    public function getDate(): ?\DateTimeImmutable
    {
        return $this->date;
    }

    public function setDate(?\DateTimeImmutable $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(?int $status): self
    {
        $this->status = $status;

        return $this;
    }
}
