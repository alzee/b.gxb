<?php

namespace App\Entity;

use App\Repository\ConfRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=ConfRepository::class)
 */
class Conf
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $equity;

    /**
     * @ORM\Column(type="float")
     */
    private $referReward;

    /**
     * @ORM\Column(type="float")
     */
    private $referReward2;

    /**
     * @ORM\Column(type="smallint")
     */
    private $referGXB;

    /**
     * @ORM\Column(type="float")
     */
    private $mainCellMinPrice;

    /**
     * @ORM\Column(type="float")
     */
    private $cellMinPrice;

    /**
     * @ORM\Column(type="smallint")
     */
    private $mainCellMinDays;

    /**
     * @ORM\Column(type="smallint")
     */
    private $cellMinDays;

    /**
     * @ORM\Column(type="integer")
     */
    private $maxPerDay;

    /**
     * @ORM\Column(type="float")
     */
    private $equityGXBRate;

    /**
     * @ORM\Column(type="float")
     */
    private $equityPrice;

    /**
     * @ORM\Column(type="float")
     */
    private $dividendFund;

    /**
     * @ORM\Column(type="boolean")
     */
    private $forceUpdate;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $coinsPerYuan;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $coinThreshold;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $welcome;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $landPrice;

    /**
     * @ORM\Column(type="smallint")
     */
    private $bidStart;

    /**
     * @ORM\Column(type="smallint")
     */
    private $bidIncrement;

    /**
     * @ORM\Column(type="smallint")
     */
    private $buyNow;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEquity(): ?int
    {
        return $this->equity;
    }

    public function setEquity(int $equity): self
    {
        $this->equity = $equity;

        return $this;
    }

    public function getReferReward(): ?float
    {
        return $this->referReward;
    }

    public function setReferReward(float $referReward): self
    {
        $this->referReward = $referReward;

        return $this;
    }

    public function getReferReward2(): ?float
    {
        return $this->referReward2;
    }

    public function setReferReward2(float $referReward2): self
    {
        $this->referReward2 = $referReward2;

        return $this;
    }

    public function getReferGXB(): ?int
    {
        return $this->referGXB;
    }

    public function setReferGXB(int $referGXB): self
    {
        $this->referGXB = $referGXB;

        return $this;
    }

    public function getMainCellMinPrice(): ?float
    {
        return $this->mainCellMinPrice;
    }

    public function setMainCellMinPrice(float $mainCellMinPrice): self
    {
        $this->mainCellMinPrice = $mainCellMinPrice;

        return $this;
    }

    public function getCellMinPrice(): ?float
    {
        return $this->cellMinPrice;
    }

    public function setCellMinPrice(float $cellMinPrice): self
    {
        $this->cellMinPrice = $cellMinPrice;

        return $this;
    }

    public function getMainCellMinDays(): ?int
    {
        return $this->mainCellMinDays;
    }

    public function setMainCellMinDays(int $mainCellMinDays): self
    {
        $this->mainCellMinDays = $mainCellMinDays;

        return $this;
    }

    public function getCellMinDays(): ?int
    {
        return $this->cellMinDays;
    }

    public function setCellMinDays(int $cellMinDays): self
    {
        $this->cellMinDays = $cellMinDays;

        return $this;
    }

    public function getMaxPerDay(): ?int
    {
        return $this->maxPerDay;
    }

    public function setMaxPerDay(int $maxPerDay): self
    {
        $this->maxPerDay = $maxPerDay;

        return $this;
    }

    public function getEquityGXBRate(): ?float
    {
        return $this->equityGXBRate;
    }

    public function setEquityGXBRate(float $equityGXBRate): self
    {
        $this->equityGXBRate = $equityGXBRate;

        return $this;
    }

    public function getEquityPrice(): ?float
    {
        return $this->equityPrice;
    }

    public function setEquityPrice(float $equityPrice): self
    {
        $this->equityPrice = $equityPrice;

        return $this;
    }

    public function getDividendFund(): ?float
    {
        return $this->dividendFund;
    }

    public function setDividendFund(float $dividendFund): self
    {
        $this->dividendFund = $dividendFund;

        return $this;
    }

    public function getForceUpdate(): ?bool
    {
        return $this->forceUpdate;
    }

    public function setForceUpdate(bool $forceUpdate): self
    {
        $this->forceUpdate = $forceUpdate;

        return $this;
    }

    public function getCoinsPerYuan(): ?int
    {
        return $this->coinsPerYuan;
    }

    public function setCoinsPerYuan(?int $coinsPerYuan): self
    {
        $this->coinsPerYuan = $coinsPerYuan;

        return $this;
    }

    public function getCoinThreshold(): ?int
    {
        return $this->coinThreshold;
    }

    public function setCoinThreshold(?int $coinThreshold): self
    {
        $this->coinThreshold = $coinThreshold;

        return $this;
    }

    public function getWelcome(): ?string
    {
        return $this->welcome;
    }

    public function setWelcome(?string $welcome): self
    {
        $this->welcome = $welcome;

        return $this;
    }

    public function getLandPrice(): ?int
    {
        return $this->landPrice;
    }

    public function setLandPrice(?int $landPrice): self
    {
        $this->landPrice = $landPrice;

        return $this;
    }

    public function getBidStart(): ?int
    {
        return $this->bidStart;
    }

    public function setBidStart(int $bidStart): self
    {
        $this->bidStart = $bidStart;

        return $this;
    }

    public function getBidIncrement(): ?int
    {
        return $this->bidIncrement;
    }

    public function setBidIncrement(int $bidIncrement): self
    {
        $this->bidIncrement = $bidIncrement;

        return $this;
    }

    public function getBuyNow(): ?int
    {
        return $this->buyNow;
    }

    public function setBuyNow(int $buyNow): self
    {
        $this->buyNow = $buyNow;

        return $this;
    }
}
