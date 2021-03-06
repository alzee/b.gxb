<?php

namespace App\Entity;

use App\Repository\ApplyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\OrderFilter;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 * collectionOperations={"get", "post"},
 * itemOperations={"get", "patch"},
 * normalizationContext={"groups"={"apply:read"}},
 * denormalizationContext={"groups"={"apply:write"}}
 * )
 * @ORM\Entity(repositoryClass=ApplyRepository::class)
 * @ApiFilter(SearchFilter::class, properties={"applicant.id": "exact", "status.id": "exact", "task.id": "exact"})
 * @ApiFilter(OrderFilter::class, properties={"id"})
 */
class Apply
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"apply:read"})
     * @Groups({"report:read"})
     * @Groups({"task:read"})
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Task::class, inversedBy="applies")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"report:read"})
     * @Groups({"apply:read", "apply:write"})
     */
    private $task;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="applies")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"report:read"})
     * @Groups({"apply:read", "apply:write"})
     * @Groups({"task:read", "task:write"})
     */
    private $applicant;

    /**
     * 11 待提交
     * 12 验收中
     * 13 不合格
     * 14 已完成
     * 15 承认不合格
     * @ORM\ManyToOne(targetEntity=Status::class)
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"apply:read", "apply:write"})
     * @Groups({"report:read"})
     * @Groups({"task:read", "task:write"})
     */
    private $status;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"apply:read"})
     * @Groups({"task:read"})
     */
    private $date;

    /**
     * @Groups({"apply:read", "apply:write"})
     * @Groups({"task:read"})
     * @Groups({"report:read"})
     * @ORM\Column(type="simple_array", nullable=true)
     */
    private $pic = [];

    /**
     * @Groups({"apply:read", "apply:write"})
     * @Groups({"task:read"})
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $submitAt;

    /**
     * @Groups({"apply:read", "apply:write"})
     * @Groups({"task:read"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $note;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $approved_at;

    public function __construct()
    {
        $this->date = new \DateTime();
        //$this->date = $this->date->setTimezone(new \DateTimeZone('Asia/Shanghai'));
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTask(): ?task
    {
        return $this->task;
    }

    public function setTask(?task $task): self
    {
        $this->task = $task;

        return $this;
    }

    public function getApplicant(): ?user
    {
        return $this->applicant;
    }

    public function setApplicant(?user $applicant): self
    {
        $this->applicant = $applicant;

        return $this;
    }

    public function getStatus(): ?status
    {
        return $this->status;
    }

    public function setStatus(?status $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function __toString(): string
    {
        return $this->task;
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

    public function getPic(): ?array
    {
        return $this->pic;
    }

    public function setPic(array $pic): self
    {
        $this->pic = $pic;

        return $this;
    }

    public function getSubmitAt(): ?\DateTimeInterface
    {
        return $this->submitAt;
    }

    public function setSubmitAt(?\DateTimeInterface $submitAt): self
    {
        $this->submitAt = $submitAt;

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

    public function getApprovedAt(): ?\DateTimeInterface
    {
        return $this->approved_at;
    }

    public function setApprovedAt(?\DateTimeInterface $approved_at): self
    {
        $this->approved_at = $approved_at;

        return $this;
    }
}
