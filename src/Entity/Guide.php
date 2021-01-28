<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Repository\GuideRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource(
 * normalizationContext={"groups"={"guide:read"}},
 * denormalizationContext={"groups"={"guide:write"}}
 * )
 * @ORM\Entity(repositoryClass=GuideRepository::class)
 */
class Guide
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"guide:read"})
     * @Groups({"task:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"guide:read", "guide:write"})
     * @Groups({"task:read", "task:write"})
     */
    private $figureUrl;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups({"guide:read", "guide:write"})
     * @Groups({"task:read", "task:write"})
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"guide:read", "guide:write"})
     * @Groups({"task:read", "task:write"})
     */
    private $screenshotUrl;

    /**
     * @ORM\ManyToOne(targetEntity=Task::class, inversedBy="guides")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"guide:read", "guide:write"})
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

    public function getTask(): ?Task
    {
        return $this->task;
    }

    public function setTask(?Task $task): self
    {
        $this->task = $task;

        return $this;
    }
}
