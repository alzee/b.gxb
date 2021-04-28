<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ApiResource(
 * normalizationContext={"groups"={"user:read"}},
 * denormalizationContext={"groups"={"user:write"}}
 * )
 * @ApiFilter(SearchFilter::class, properties={"username": "exact", "phone": "exact", "refcode": "exact", "referrer": "exact", "ror": "exact"})
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @ORM\Table(name="`user`")
 * @Vich\Uploadable
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"user:read"})
     * @Groups({"task:read"})
     * @Groups({"land:read"})
     * @Groups({"gxb:read"})
     * @Groups({"report:read"})
     * @Groups({"equity:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     * @Groups({"task:read"})
     * @Groups({"user:read", "user:write"})
     * @Groups({"apply:read"})
     * @Groups({"land:read"})
     * @Groups({"landpost:read"})
     * @Groups({"bid:read"})
     * @Groups({"node:read"})
     * @Groups({"report:read"})
     * @Groups({"equity:read"})
     */
    private $username;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     * @Groups({"user:write"})
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"task:read"})
     * @Groups({"user:read", "user:write"})
     */
    private $nick;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"task:read"})
     * @Groups({"apply:read"})
     * @Groups({"user:read", "user:write"})
     * @Groups({"land:read"})
     * @Groups({"landpost:read"})
     * @Groups({"node:read"})
     * @Groups({"bid:read"})
     * @Groups({"report:read"})
     */
    private $avatar = '/media/avatar.png';

    /**
     * @Vich\UploadableField(mapping="img", fileNameProperty="avatar")
     * @var File
     */
    private $avatarFile;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"user:read", "user:write"})
     */
    private $phone;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups({"user:read", "user:write"})
     */
    private $topup = 0;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups({"user:read", "user:write"})
     */
    private $earnings = 0;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups({"user:read", "user:write"})
     */
    private $gxb = 0;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function __toString(): string
    {
        return $this->username;
    }

    public function getNick(): ?string
    {
        return $this->nick;
    }

    public function setNick(string $nick): self
    {
        $this->nick = $nick;

        return $this;
    }

    public function getAvatar(): ?string
    {
        return $this->avatar;
    }

    public function setAvatar(?string $avatar): self
    {
        $this->avatar = $avatar;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getTopup(): ?int
    {
        return $this->topup;
    }

    public function setTopup(int $topup): self
    {
        $this->topup = $topup;

        return $this;
    }

    public function getEarnings(): ?int
    {
        return $this->earnings;
    }

    public function setEarnings(int $earnings): self
    {
        $this->earnings = $earnings;

        return $this;
    }

    public function getGxb(): ?int
    {
        return $this->gxb;
    }

    public function setGxb(int $gxb): self
    {
        $this->gxb = $gxb;

        return $this;
    }

    private ?string $plainPassword = null;

    /**
     * @ORM\OneToMany(targetEntity=Apply::class, mappedBy="applicant")
     */
    private $applies;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @Groups({"user:read", "user:write"})
     * @ORM\Column(type="integer", nullable=true)
     */
    private $equity = 1;

    /**
     * @Groups({"user:read", "user:write"})
     * @ORM\Column(type="integer", nullable=true)
     */
    private $frozen = 0;

    /**
     * @Groups({"user:read", "user:write"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $refcode;

    /**
     * @Groups({"user:read", "user:write"})
     * @ORM\Column(type="integer", nullable=true)
     */
    private $coin = 0;

    /**
     * @ORM\OneToMany(targetEntity=Coin::class, mappedBy="user")
     */
    private $coins;

    /**
     * @Groups({"user:read", "user:write"})
     * @ORM\ManyToMany(targetEntity=Coupon::class)
     */
    private $coupon;

    /**
     * @Groups({"user:read", "user:write"})
     * @ORM\ManyToOne(targetEntity=Level::class, inversedBy="users")
     */
    private $level;

    /**
     * @Groups({"user:read", "user:write"})
     * @ORM\ManyToOne(targetEntity=User::class)
     */
    private $referrer;

    /**
     * @Groups({"user:read", "user:write"})
     * @ORM\ManyToOne(targetEntity=User::class)
     */
    private $ror;

    public function __construct()
    {
        $this->applies = new ArrayCollection();
        $this->coins = new ArrayCollection();
        $this->coupon = new ArrayCollection();
        $this->refcode = substr(md5(uniqid()),0,8);
    }

    public function getPlainPassword(): ?string
    {
        return $this->plainPassword;
    }

    public function setPlainPassword(string $password): void
    {
        $this->plainPassword = $password;
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
            $apply->setApplicant($this);
        }

        return $this;
    }

    public function removeApply(Apply $apply): self
    {
        if ($this->applies->removeElement($apply)) {
            // set the owning side to null (unless already changed)
            if ($apply->getApplicant() === $this) {
                $apply->setApplicant(null);
            }
        }

        return $this;
    }

    public function setAvatarFile(File $image = null)
    {
        $this->avatarFile = $image;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($image) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->updatedAt = new \DateTime('now');
        }
    }

    public function getAvatarFile()
    {
        return $this->avatarFile;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getEquity(): ?int
    {
        return $this->equity;
    }

    public function setEquity(?int $equity): self
    {
        $this->equity = $equity;

        return $this;
    }

    public function getFrozen(): ?int
    {
        return $this->frozen;
    }

    public function setFrozen(?int $frozen): self
    {
        $this->frozen = $frozen;

        return $this;
    }

    public function getRefcode(): ?string
    {
        return $this->refcode;
    }

    public function setRefcode(string $refcode): self
    {
        $this->refcode = $refcode;

        return $this;
    }

    public function getCoin(): ?int
    {
        return $this->coin;
    }

    public function setCoin(?int $coin): self
    {
        $this->coin = $coin;

        return $this;
    }

    /**
     * @return Collection|Coin[]
     */
    public function getCoins(): Collection
    {
        return $this->coins;
    }

    public function addCoin(Coin $coin): self
    {
        if (!$this->coins->contains($coin)) {
            $this->coins[] = $coin;
            $coin->setUser($this);
        }

        return $this;
    }

    public function removeCoin(Coin $coin): self
    {
        if ($this->coins->removeElement($coin)) {
            // set the owning side to null (unless already changed)
            if ($coin->getUser() === $this) {
                $coin->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Coupon[]
     */
    public function getCoupon(): Collection
    {
        return $this->coupon;
    }

    public function addCoupon(Coupon $coupon): self
    {
        if (!$this->coupon->contains($coupon)) {
            $this->coupon[] = $coupon;
        }

        return $this;
    }

    public function removeCoupon(Coupon $coupon): self
    {
        $this->coupon->removeElement($coupon);

        return $this;
    }

    public function getLevel(): ?Level
    {
        return $this->level;
    }

    public function setLevel(?Level $level): self
    {
        $this->level = $level;

        return $this;
    }

    public function getReferrer(): ?self
    {
        return $this->referrer;
    }

    public function setReferrer(?self $referrer): self
    {
        $this->referrer = $referrer;

        return $this;
    }

    public function getRor(): ?self
    {
        return $this->ror;
    }

    public function setRor(?self $ror): self
    {
        $this->ror = $ror;

        return $this;
    }
}
