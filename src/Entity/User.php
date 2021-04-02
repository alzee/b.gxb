<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ApiResource(
 * normalizationContext={"groups"={"user:read"}},
 * denormalizationContext={"groups"={"user:write"}}
 * )
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
     */
    private $username;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     * @Groups({"user:read", "user:write"})
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
     * @ORM\Column(type="float", nullable=true)
     * @Groups({"user:read", "user:write"})
     */
    private $balanceTopup = 0;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @Groups({"user:read", "user:write"})
     */
    private $balanceTask = 0;

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

    public function getBalanceTopup(): ?float
    {
        return $this->balanceTopup;
    }

    public function setBalanceTopup(float $balanceTopup): self
    {
        $this->balanceTopup = $balanceTopup;

        return $this;
    }

    public function getBalanceTask(): ?float
    {
        return $this->balanceTask;
    }

    public function setBalanceTask(float $balanceTask): self
    {
        $this->balanceTask = $balanceTask;

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
    private $equity;

    /**
     * @Groups({"user:read", "user:write"})
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $collectAt;

    public function __construct()
    {
        $this->applies = new ArrayCollection();
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

    public function getCollectAt(): ?\DateTimeInterface
    {
        return $this->collectAt;
    }

    public function setCollectAt(?\DateTimeInterface $collectAt): self
    {
        $this->collectAt = $collectAt;

        return $this;
    }
}
