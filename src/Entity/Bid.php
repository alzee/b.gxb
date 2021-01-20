<?php

namespace App\Entity;

use App\Repository\BidRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BidRepository::class)
 */
class Bid
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=Task::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $task;

    /**
     * @ORM\Column(type="integer")
     */
    private $bid;

    /**
     * @ORM\Column(type="integer")
     */
    private $position;

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
}
