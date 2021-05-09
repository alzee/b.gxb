<?php
/**
 * vim:ft=php et ts=4 sts=4
 * @author z14 <z@arcz.ee>
 * @version
 * @todo
 */

namespace App\EventListener;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Finance;
use App\Entity\User;
use App\Entity\Coupon;
use App\Entity\EquityTrade;
use Doctrine\Persistence\Event\LifecycleEventArgs;

class EquityNew
{
    public function prePersist(EquityTrade $equity, LifecycleEventArgs $event): void
    {
        $seller = $equity->getSeller();
        $seller->setEquity($seller->getEquity() - $equity->getEquity());
    }
}
