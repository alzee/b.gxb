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
 * normalizationContext={"groups"={"apply:read"}},
 * denormalizationContext={"groups"={"apply:write"}}
 * )
 * @ORM\Entity(repositoryClass=ApplyRepository::class)
 * @ApiFilter(SearchFilter::class, properties={"applicant.id": "exact", "status.id": "exact", "task.id": "exact"})
 * @ApiFilter(OrderFilter::class, properties={"date"})
 */
class Apply
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"apply:read"})
     * @Groups({"task:read"})
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Task::class, inversedBy="applies")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"apply:read", "apply:write"})
     */
    private $task;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="applies")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"apply:read", "apply:write"})
     * @Groups({"task:read", "task:write"})
     */
    private $applicant;

    /**
     * @ORM\ManyToOne(targetEntity=Status::class)
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"apply:read", "apply:write"})
     * @Groups({"task:read", "task:write"})
     */
    private $status;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"apply:read"})
     */
    private $date;

    /**
     * @ORM\OneToMany(targetEntity=Work::class, mappedBy="apply")
     */
    private $works;

    /**
     * @Groups({"apply:read", "apply:write"})
     * @Groups({"task:read"})
     * @ORM\Column(type="simple_array", nullable=true)
     */
    private $pic = [];

    public function __construct()
    {
        $this->date = new \DateTime();
        //$this->date = $this->date->setTimezone(new \DateTimeZone('Asia/Shanghai'));
        $this->works = new ArrayCollection();
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
        return $this->applicant;
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

    /**
     * @return Collection|Work[]
     */
    public function getWorks(): Collection
    {
        return $this->works;
    }

    public function addWork(Work $work): self
    {
        if (!$this->works->contains($work)) {
            $this->works[] = $work;
            $work->setApply($this);
        }

        return $this;
    }

    public function removeWork(Work $work): self
    {
        if ($this->works->removeElement($work)) {
            // set the owning side to null (unless already changed)
            if ($work->getApply() === $this) {
                $work->setApply(null);
            }
        }

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
}
