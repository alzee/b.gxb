<?php

namespace App\Entity;

use App\Repository\FinanceRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\OrderFilter;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=FinanceRepository::class)
 * @ApiFilter(SearchFilter::class, properties={"user": "exact", "status": "exact", "type": "exact"})
 * @ApiFilter(OrderFilter::class, properties={"date"})
 */
class Finance
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $note;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\Column(type="integer")
     */
    private $amount = 0;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, cascade={"persist", "remove"})
     */
    private $user;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $prepayid;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $orderid;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $wx_orderid;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $type;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $status = 0;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $couponId;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $fee = 0;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $method = 0;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $data = [];

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $wxpayData = [];

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isFund = false;

    public function __construct()
    {
        $this->date = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNote(): ?string
    {
        return $this->note;
    }

    public function setNote(string $note): self
    {
        $this->note = $note;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getAmount(): ?int
    {
        return $this->amount;
    }

    public function setAmount(int $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getPrepayid(): ?string
    {
        return $this->prepayid;
    }

    public function setPrepayid(?string $prepayid): self
    {
        $this->prepayid = $prepayid;

        return $this;
    }

    public function getOrderid(): ?string
    {
        return $this->orderid;
    }

    public function setOrderid(?string $orderid): self
    {
        $this->orderid = $orderid;

        return $this;
    }

    public function getWxOrderid(): ?string
    {
        return $this->wx_orderid;
    }

    public function setWxOrderid(string $wx_orderid): self
    {
        $this->wx_orderid = $wx_orderid;

        return $this;
    }

    public function getType(): ?int
    {
        return $this->type;
    }

    public function setType(?int $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(?int $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getCouponId(): ?int
    {
        return $this->couponId;
    }

    public function setCouponId(?int $couponId): self
    {
        $this->couponId = $couponId;

        return $this;
    }

    public function getFee(): ?int
    {
        return $this->fee;
    }

    public function setFee(?int $fee): self
    {
        $this->fee = $fee;

        return $this;
    }

    public function getMethod(): ?int
    {
        return $this->method;
    }

    public function setMethod(?int $method): self
    {
        $this->method = $method;

        return $this;
    }

    public function getData(): ?array
    {
        return $this->data;
    }

    public function setData(?array $data): self
    {
        $this->data = $data;

        return $this;
    }

    public function getWxpayData(): ?array
    {
        return $this->wxpayData;
    }

    public function setWxpayData(?array $wxpayData): self
    {
        $this->wxpayData = $wxpayData;

        return $this;
    }

    public function getIsFund(): ?bool
    {
        return $this->isFund;
    }

    public function setIsFund(?bool $isFund): self
    {
        $this->isFund = $isFund;

        return $this;
    }
}
