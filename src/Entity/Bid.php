<?php

namespace App\Entity;

use App\Repository\BidRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\OrderFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\DateFilter;

/**
 * @ApiResource(
 * normalizationContext={"groups"={"bid:read"}},
 * denormalizationContext={"groups"={"bid:write"}}
 * )
 * @ORM\Entity(repositoryClass=BidRepository::class)
 * @ApiFilter(SearchFilter::class, properties={"position": "exact"})
 * @ApiFilter(OrderFilter::class, properties={"date"})
 * @ApiFilter(DateFilter::class, properties={"date"})
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
     * @ORM\ManyToOne(targetEntity=Task::class)
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
     * @Groups({"bid:read"})
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $date;

    /**
     * @Groups({"bid:read", "bid:write"})
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isBuyNow;

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

    public function __construct()
    {
        $this->date = new \DateTimeImmutable();
        //$this->date = $this->date->setTimezone(new \DateTimeZone('Asia/Shanghai'));
    }

    public function getIsBuyNow(): ?bool
    {
        return $this->isBuyNow;
    }

    public function setIsBuyNow(?bool $isBuyNow): self
    {
        $this->isBuyNow = $isBuyNow;

        return $this;
    }

}
