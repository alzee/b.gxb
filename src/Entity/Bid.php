<?php

namespace App\Entity;

use App\Repository\BidRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;

/**
 * @ApiResource(
 * normalizationContext={"groups"={"bid:read"}},
 * denormalizationContext={"groups"={"bid:write"}}
 * )
 * @ORM\Entity(repositoryClass=BidRepository::class)
 * @ApiFilter(SearchFilter::class, properties={"position": "exact"})
 */
class Bid
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"bid:read", "bid:write"})
     */
    private $id;

    /**
     * @Groups({"bid:read", "bid:write"})
     * @ORM\OneToOne(targetEntity=Task::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $task;

    /**
     * @Groups({"bid:read", "bid:write"})
     * @ORM\Column(type="integer")
     */
    private $bid;

    /**
     * @Groups({"bid:read", "bid:write"})
     * @ORM\Column(type="integer")
     */
    private $position;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $date;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTask(): ?Task
    {
        return $this->task;
    }

    public function setTask(Task $task): self
    {
        $this->task = $task;

        return $this;
    }

    public function getBid(): ?int
    {
        return $this->bid;
    }

    public function setBid(int $bid): self
    {
        $this->bid = $bid;

        return $this;
    }

    public function getPosition(): ?int
    {
        return $this->position;
    }

    public function setPosition(int $position): self
    {
        $this->position = $position;

        return $this;
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
}
