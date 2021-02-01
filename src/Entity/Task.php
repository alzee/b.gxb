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

/**
 * @ApiResource(
 * normalizationContext={"groups"={"task:read"}},
 * denormalizationContext={"groups"={"task:write"}}
 * )
 * @ORM\Entity(repositoryClass=TaskRepository::class)
 * @ApiFilter(BooleanFilter::class, properties={"sticky", "recommended", "approved"})
 * @ApiFilter(SearchFilter::class, properties={"title": "partial", "name": "partial", "category.id": "exact"})
 * @ApiFilter(OrderFilter::class, properties={"bidPosition", "date", "price", "sticky"})
 * @ApiFilter(RangeFilter::class, properties={"bidPosition"})
 * @ApiFilter(PropertyFilter::class)
 */
class Task
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"task:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"task:read", "task:write"})
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"task:read", "task:write"})
     * @Groups({"apply:read"})
     */
    private $title;

    /**
     * @ORM\Column(type="float")
     * @Groups({"task:read", "task:write"})
     * @Groups({"apply:read"})
     */
    private $price;

    /**
     * @ORM\Column(type="text")
     * @Groups({"task:read", "task:write"})
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"task:read", "task:write"})
     */
    private $owner;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     * @Groups({"task:read", "task:write"})
     */
    private $sticky = false;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     * @Groups({"task:read", "task:write"})
     */
    private $recommended = false;

    /**
     * @ORM\ManyToOne(targetEntity=Platform::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"task:read", "task:write"})
     */
    private $platform;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"task:read", "task:write"})
     * @Groups({"apply:read"})
     */
    private $category;

    /**
     * @ORM\ManyToMany(targetEntity=Tag::class, cascade={"persist", "remove"})
     * @Groups({"task:read", "task:write"})
     * @Groups({"apply:read"})
     */
    private $tag;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"task:read", "task:write"})
     */
    private $showdays;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"task:read", "task:write"})
     */
    private $approvedays;

    /**
     * @ORM\Column(type="float")
     * @Groups({"task:read", "task:write"})
     */
    private $prepaid;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"task:read", "task:write"})
     */
    private $quantity;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"task:read", "task:write"})
     */
    private $applydays;

    /**
     * @ORM\Column(type="datetime_immutable")
     * @Groups({"task:read"})
     */
    private $date;

    /**
     * @ORM\Column(type="boolean")
     */
    private $approved = false;

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
     * @ORM\OneToMany(targetEntity=Guide::class, mappedBy="task")
     * @Groups({"task:read", "task:write"})
     */
    private $guides;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $link;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $contact;

    public function __construct()
    {
        $this->tag = new ArrayCollection();
        $this->date = new \DateTimeImmutable();
        $this->date = $this->date->setTimezone(new \DateTimeZone('Asia/Shanghai'));
        $this->applies = new ArrayCollection();
        $this->guides = new ArrayCollection();
    }

    public function getCountApplies(): ?int
    {
        return $this->countApplies = sizeof($this->applies);
    }

    public function getRemain(): ?int
    {
        return $this->quantity - $this->countApplies;
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

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
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

    public function getSticky(): ?bool
    {
        return $this->sticky;
    }

    public function setSticky(bool $sticky): self
    {
        $this->sticky = $sticky;

        return $this;
    }

    public function getRecommended(): ?bool
    {
        return $this->recommended;
    }

    public function setRecommended(bool $recommended): self
    {
        $this->recommended = $recommended;

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

    public function getShowdays(): ?int
    {
        return $this->showdays;
    }

    public function setShowdays(int $showdays): self
    {
        $this->showdays = $showdays;

        return $this;
    }

    public function getApprovedays(): ?int
    {
        return $this->approvedays;
    }

    public function setApprovedays(int $approvedays): self
    {
        $this->approvedays = $approvedays;

        return $this;
    }

    public function getPrepaid(): ?float
    {
        return $this->prepaid;
    }

    public function setPrepaid(float $prepaid): self
    {
        $this->prepaid = $prepaid;

        return $this;
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

    public function getApplydays(): ?int
    {
        return $this->applydays;
    }

    public function setApplydays(int $applydays): self
    {
        $this->applydays = $applydays;

        return $this;
    }

    public function getDate(): ?\DateTimeImmutable
    {
        return $this->date;
    }

    public function getApproved(): ?bool
    {
        return $this->approved;
    }

    public function setApproved(bool $approved): self
    {
        $this->approved = $approved;

        return $this;
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

    /**
     * @return Collection|Guide[]
     */
    public function getGuides(): Collection
    {
        return $this->guides;
    }

    public function addGuide(Guide $guide): self
    {
        if (!$this->guides->contains($guide)) {
            $this->guides[] = $guide;
            $guide->setTask($this);
        }

        return $this;
    }

    public function removeGuide(Guide $guide): self
    {
        if ($this->guides->removeElement($guide)) {
            // set the owning side to null (unless already changed)
            if ($guide->getTask() === $this) {
                $guide->setTask(null);
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

    public function getContact(): ?string
    {
        return $this->contact;
    }

    public function setContact(?string $contact): self
    {
        $this->contact = $contact;

        return $this;
    }
}
