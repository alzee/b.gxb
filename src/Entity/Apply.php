<?php

namespace App\Entity;

use App\Repository\ApplyRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 * normalizationContext={"groups"={"apply:read"}},
 * denormalizationContext={"groups"={"apply:write"}}
 * )
 * @ORM\Entity(repositoryClass=ApplyRepository::class)
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
     */
    private $date;

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
}
