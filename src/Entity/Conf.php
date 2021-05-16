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
    private $mainlandMinPrice;

    /**
     * @ORM\Column(type="float")
     */
    private $landMinPrice;

    /**
     * @ORM\Column(type="smallint")
     */
    private $mainlandMinDays;

    /**
     * @ORM\Column(type="smallint")
     */
    private $landMinDays;

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
    private $equityPriceMax;

    /**
     * @ORM\Column(type="float")
     */
    private $equityPriceMin;

    /**
     * @ORM\Column(type="float")
     */
    private $dividendFund;

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

    public function getMainlandMinPrice(): ?float
    {
        return $this->mainlandMinPrice;
    }

    public function setMainlandMinPrice(float $mainlandMinPrice): self
    {
        $this->mainlandMinPrice = $mainlandMinPrice;

        return $this;
    }

    public function getLandMinPrice(): ?float
    {
        return $this->landMinPrice;
    }

    public function setLandMinPrice(float $landMinPrice): self
    {
        $this->landMinPrice = $landMinPrice;

        return $this;
    }

    public function getMainlandMinDays(): ?int
    {
        return $this->mainlandMinDays;
    }

    public function setMainlandMinDays(int $mainlandMinDays): self
    {
        $this->mainlandMinDays = $mainlandMinDays;

        return $this;
    }

    public function getLandMinDays(): ?int
    {
        return $this->landMinDays;
    }

    public function setLandMinDays(int $landMinDays): self
    {
        $this->landMinDays = $landMinDays;

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

    public function getEquityPriceMax(): ?float
    {
        return $this->equityPriceMax;
    }

    public function setEquityPriceMax(float $equityPriceMax): self
    {
        $this->equityPriceMax = $equityPriceMax;

        return $this;
    }

    public function getEquityPriceMin(): ?float
    {
        return $this->equityPriceMin;
    }

    public function setEquityPriceMin(float $equityPriceMin): self
    {
        $this->equityPriceMin = $equityPriceMin;

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
}
