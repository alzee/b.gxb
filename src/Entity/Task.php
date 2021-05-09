<?php

namespace App\Entity;

use App\Repository\TaskRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\BooleanFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\OrderFilter;
use ApiPlatform\Core\Serializer\Filter\PropertyFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\RangeFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\DateFilter;

/**
 * @ApiResource(
 * normalizationContext={"groups"={"task:read"}},
 * denormalizationContext={"groups"={"task:write"}}
 * )
 * @ORM\Entity(repositoryClass=TaskRepository::class)
 * @ApiFilter(SearchFilter::class, properties={"id": "exact", "title": "partial", "name": "partial", "category.id": "exact", "owner.id": "exact", "owner.username": "exact", "status": "exact"})
 * @ApiFilter(OrderFilter::class, properties={"bidPosition", "date", "price", "stickyUntil", "recommendUntil"})
 * @ApiFilter(RangeFilter::class, properties={"bidPosition"})
 * @ApiFilter(PropertyFilter::class)
 * @ApiFilter(DateFilter::class, properties={"stickyUntil", "recommendUntil", "showUntil"})
 */
class Task
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"task:read"})
     * @Groups({"bid:read"})
     * @Groups({"apply:read"})
     * @Groups({"report:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"task:read", "task:write"})
     * @Groups({"apply:read"})
     * @Groups({"report:read"})
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"task:read", "task:write"})
     * @Groups({"apply:read"})
     * @Groups({"bid:read"})
     * @Groups({"report:read"})
     */
    private $title;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"task:read", "task:write"})
     * @Groups({"apply:read"})
     * @Groups({"bid:read"})
     * @Groups({"report:read"})
     */
    private $price;

    /**
     * @ORM\Column(type="text")
     * @Groups({"task:read", "task:write"})
     * @Groups({"report:read"})
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity=User::class)
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"task:read", "task:write"})
     * @Groups({"apply:read"})
     * @Groups({"bid:read"})
     * @Groups({"report:read"})
     */
    private $owner;

    /**
     * @ORM\ManyToOne(targetEntity=Platform::class)
     * @ORM\JoinColumn(nullable=true)
     * @Groups({"task:read", "task:write"})
     */
    private $platform;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class)
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"task:read", "task:write"})
     * @Groups({"apply:read"})
     * @Groups({"bid:read"})
     * @Groups({"report:read"})
     */
    private $category;

    /**
     * @ORM\ManyToMany(targetEntity=Tag::class)
     * @Groups({"task:read", "task:write"})
     * @Groups({"apply:read"})
     * @Groups({"report:read"})
     */
    private $tag;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"task:read", "task:write"})
     * @Groups({"report:read"})
     */
    private $quantity;

    /**
     * @ORM\Column(type="datetime_immutable")
     * @Groups({"task:read"})
     * @Groups({"report:read"})
     */
    private $date;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups({"task:read"})
     */
    private $bidPosition;

    /**
     * @ORM\OneToMany(targetEntity=Apply::class, mappedBy="task")
     * @Groups({"task:read"})
     */
    private $applies;

    /**
     * @Groups({"task:read"})
     */
    private $countApplies;

    /**
     * @Groups({"task:read"})
     */
    private $remain;

    /**
     * @Groups({"task:read"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $link;

    /**
     * @Groups({"task:read"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $note;

    /**
     * @ORM\Column(type="array", nullable=true)
     * @Groups({"task:read", "task:write"})
     * @Groups({"apply:read"})
     * @Groups({"report:read"})
     */
    private $guides = [];

    /**
     * @ORM\Column(type="array", nullable=true)
     * @Groups({"task:read", "task:write"})
     * @Groups({"apply:read"})
     * @Groups({"report:read"})
     */
    private $reviews = [];

    /**
     * @Groups({"task:read", "task:write"})
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $stickyUntil;

    /**
     * @Groups({"task:read", "task:write"})
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $recommendUntil;

    /**
     * @Groups({"task:read", "task:write"})
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $showUntil;

    /**
     * @Groups({"apply:read"})
     * @Groups({"task:read", "task:write"})
     * @ORM\Column(type="integer", nullable=true)
     */
    private $workHours;

    /**
     * @Groups({"apply:read"})
     * @Groups({"task:read", "task:write"})
     * @ORM\Column(type="integer", nullable=true)
     */
    private $reviewHours;

    /**
     * @Groups({"task:read", "task:write"})
     * @ORM\ManyToOne(targetEntity=Status::class)
     */
    private $status;

    public function __construct()
    {
        $this->tag = new ArrayCollection();
        $this->date = new \DateTimeImmutable();
        //$this->date = $this->date->setTimezone(new \DateTimeZone('Asia/Shanghai'));
        $this->applies = new ArrayCollection();
    }

    public function getCountApplies(): ?int
    {
        return $this->countApplies = sizeof($this->applies);
    }

    public function getRemain(): ?int
    {
        // return $this->quantity - $this->countApplies;
        return $this->getQuantity() - $this->getCountApplies();
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

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getOwner(): ?User
    {
        return $this->owner;
    }

    public function setOwner(User $owner): self
    {
        $this->owner = $owner;

        return $this;
    }

    public function getPlatform(): ?Platform
    {
        return $this->platform;
    }

    public function setPlatform(Platform $platform): self
    {
        $this->platform = $platform;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @return Collection|Tag[]
     */
    public function getTag(): Collection
    {
        return $this->tag;
    }

    public function addTag(Tag $tag): self
    {
        if (!$this->tag->contains($tag)) {
            $this->tag[] = $tag;
        }

        return $this;
    }

    public function removeTag(Tag $tag): self
    {
        $this->tag->removeElement($tag);

        return $this;
    }

    public function __toString(): string
    {
        return $this->name;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getDate(): ?\DateTimeImmutable
    {
        return $this->date;
    }

    public function getBidPosition(): ?int
    {
        return $this->bidPosition;
    }

    public function setBidPosition(?int $bidPosition): self
    {
        $this->bidPosition = $bidPosition;

        return $this;
    }

    /**
     * @return Collection|Apply[]
     */
    public function getApplies(): Collection
    {
        return $this->applies;
    }

    public function addApply(Apply $apply): self
    {
        if (!$this->applies->contains($apply)) {
            $this->applies[] = $apply;
            $apply->setTask($this);
        }

        return $this;
    }

    public function removeApply(Apply $apply): self
    {
        if ($this->applies->removeElement($apply)) {
            // set the owning side to null (unless already changed)
            if ($apply->getTask() === $this) {
                $apply->setTask(null);
            }
        }

        return $this;
    }

    public function getLink(): ?string
    {
        return $this->link;
    }

    public function setLink(?string $link): self
    {
        $this->link = $link;

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

    public function getGuides(): ?array
    {
        return $this->guides;
    }

    public function setGuides(?array $guides): self
    {
        $this->guides = $guides;

        return $this;
    }

    public function getReviews(): ?array
    {
        return $this->reviews;
    }

    public function setReviews(?array $reviews): self
    {
        $this->reviews = $reviews;

        return $this;
    }

    public function getStickyUntil(): ?\DateTimeInterface
    {
        return $this->stickyUntil;
    }

    public function setStickyUntil(?\DateTimeInterface $stickyUntil): self
    {
        $this->stickyUntil = $stickyUntil;

        return $this;
    }

    public function getRecommendUntil(): ?\DateTimeInterface
    {
        return $this->recommendUntil;
    }

    public function setRecommendUntil(?\DateTimeInterface $recommendUntil): self
    {
        $this->recommendUntil = $recommendUntil;

        return $this;
    }

    public function getShowUntil(): ?\DateTimeInterface
    {
        return $this->showUntil;
    }

    public function setShowUntil(?\DateTimeInterface $showUntil): self
    {
        $this->showUntil = $showUntil;

        return $this;
    }

    public function getWorkHours(): ?int
    {
        return $this->workHours;
    }

    public function setWorkHours(?int $workHours): self
    {
        $this->workHours = $workHours;

        return $this;
    }

    public function getReviewHours(): ?int
    {
        return $this->reviewHours;
    }

    public function setReviewHours(?int $reviewHours): self
    {
        $this->reviewHours = $reviewHours;

        return $this;
    }

    public function getStatus(): ?Status
    {
        return $this->status;
    }

    public function setStatus(?Status $status): self
    {
        $this->status = $status;

        return $this;
    }
}
