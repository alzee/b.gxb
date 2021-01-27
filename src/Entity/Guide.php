<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\GuideRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=GuideRepository::class)
 */
class Guide
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
    private $figureUrl;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $screenshotUrl;

    /**
     * @ORM\ManyToOne(targetEntity=Task::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $task;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFigureUrl(): ?string
    {
        return $this->figureUrl;
    }

    public function setFigureUrl(string $figureUrl): self
    {
        $this->figureUrl = $figureUrl;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getScreenshotUrl(): ?string
    {
        return $this->screenshotUrl;
    }

    public function setScreenshotUrl(?string $screenshotUrl): self
    {
        $this->screenshotUrl = $screenshotUrl;

        return $this;
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
}
