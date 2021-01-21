<?php

namespace App\Entity;

use App\Repository\LevelRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LevelRepository::class)
 */
class Level
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="integer")
     */
    private $price;

    /**
     * @ORM\Column(type="integer")
     */
    private $taskLeast;

    /**
     * @ORM\Column(type="decimal", precision=3, scale=2)
     */
    private $postFee;

    /**
     * @ORM\Column(type="decimal", precision=3, scale=2)
     */
    private $withdrawFee;

    /**
     * @ORM\Column(type="integer")
     */
    private $stickyFee;

    /**
     * @ORM\Column(type="integer")
     */
    private $days;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getTaskLeast(): ?int
    {
        return $this->taskLeast;
    }

    public function setTaskLeast(int $taskLeast): self
    {
        $this->taskLeast = $taskLeast;

        return $this;
    }

    public function getPostFee(): ?string
    {
        return $this->postFee;
    }

    public function setPostFee(string $postFee): self
    {
        $this->postFee = $postFee;

        return $this;
    }

    public function getWithdrawFee(): ?string
    {
        return $this->withdrawFee;
    }

    public function setWithdrawFee(string $withdrawFee): self
    {
        $this->withdrawFee = $withdrawFee;

        return $this;
    }

    public function getStickyFee(): ?int
    {
        return $this->stickyFee;
    }

    public function setStickyFee(int $stickyFee): self
    {
        $this->stickyFee = $stickyFee;

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
}
