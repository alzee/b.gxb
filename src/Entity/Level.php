<?php

namespace App\Entity;

use App\Repository\LevelRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\OrderFilter;

/**
 * @ApiResource(
 * normalizationContext={"groups"={"level:read"}},
 * denormalizationContext={"groups"={"level:write"}}
 * )
 * @ApiFilter(OrderFilter::class, properties={"level"})
 * @ORM\Entity(repositoryClass=LevelRepository::class)
 */
class Level
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @Groups({"user:read"})
     * @Groups({"level:read", "level:write"})
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Groups({"user:read"})
     * @Groups({"level:read", "level:write"})
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @Groups({"user:read"})
     * @Groups({"level:read", "level:write"})
     * @ORM\Column(type="integer")
     */
    private $price;

    /**
     * @Groups({"user:read"})
     * @Groups({"level:read", "level:write"})
     * @ORM\Column(type="integer")
     */
    private $taskLeast;

    /**
     * @Groups({"user:read"})
     * @Groups({"level:read", "level:write"})
     * @ORM\Column(type="float", nullable=true)
     */
    private $postFee;

    /**
     * @Groups({"user:read"})
     * @Groups({"level:read", "level:write"})
     * @ORM\Column(type="float", nullable=true)
     */
    private $withdrawFee;

    /**
     * @Groups({"user:read"})
     * @Groups({"level:read", "level:write"})
     * @ORM\Column(type="integer")
     */
    private $days;

    /**
     * @Groups({"user:read"})
     * @Groups({"level:read", "level:write"})
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $taskLimit;

    /**
     * @Groups({"user:read"})
     * @Groups({"level:read", "level:write"})
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $stickyPrice;

    /**
     * @Groups({"user:read"})
     * @Groups({"level:read", "level:write"})
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $recommendPrice;

    /**
     * @Groups({"user:read"})
     * @Groups({"level:read", "level:write"})
     * @ORM\Column(type="float", nullable=true)
     */
    private $landTradeRatio;

    /**
     * @Groups({"user:read"})
     * @Groups({"level:read", "level:write"})
     * @ORM\Column(type="float", nullable=true)
     */
    private $topupRatio;

    /**
     * @ORM\OneToMany(targetEntity=User::class, mappedBy="level")
     */
    private $users;

    /**
     * @Groups({"user:read"})
     * @Groups({"level:read", "level:write"})
     * @ORM\Column(type="smallint")
     */
    private $level;

    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

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

    public function getPostFee(): ?float
    {
        return $this->postFee;
    }

    public function setPostFee(float $postFee): self
    {
        $this->postFee = $postFee;

        return $this;
    }

    public function getWithdrawFee(): ?float
    {
        return $this->withdrawFee;
    }

    public function setWithdrawFee(float $withdrawFee): self
    {
        $this->withdrawFee = $withdrawFee;

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

    public function getTaskLimit(): ?int
    {
        return $this->taskLimit;
    }

    public function setTaskLimit(?int $taskLimit): self
    {
        $this->taskLimit = $taskLimit;

        return $this;
    }

    public function getStickyPrice(): ?int
    {
        return $this->stickyPrice;
    }

    public function setStickyPrice(?int $stickyPrice): self
    {
        $this->stickyPrice = $stickyPrice;

        return $this;
    }

    public function getRecommendPrice(): ?int
    {
        return $this->recommendPrice;
    }

    public function setRecommendPrice(?int $recommendPrice): self
    {
        $this->recommendPrice = $recommendPrice;

        return $this;
    }

    public function getLandTradeRatio(): ?float
    {
        return $this->landTradeRatio;
    }

    public function setLandTradeRatio(?float $landTradeRatio): self
    {
        $this->landTradeRatio = $landTradeRatio;

        return $this;
    }

    public function getTopupRatio(): ?float
    {
        return $this->topupRatio;
    }

    public function setTopupRatio(?float $topupRatio): self
    {
        $this->topupRatio = $topupRatio;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->setLevel($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getLevel() === $this) {
                $user->setLevel(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->name;
    }

    public function getLevel(): ?int
    {
        return $this->level;
    }

    public function setLevel(int $level): self
    {
        $this->level = $level;

        return $this;
    }
}
