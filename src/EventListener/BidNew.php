<?php
/**
 * vim:ft=php et ts=4 sts=4
 * @author z14 <z@arcz.ee>
 * @version
 * @todo
 */

namespace App\EventListener;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\User;
use App\Entity\Bid;
use App\Entity\Finance;
use Doctrine\Persistence\Event\LifecycleEventArgs;

class BidNew
{
    public function prePersist(Bid $bid, LifecycleEventArgs $event): void
    {
        $em = $event->getEntityManager();
        $bidRepo = $em->getRepository(Bid::class);
        $prevBid = $em->getRepository(Bid::class)->getTodayBid($bid->getPosition());
        
        if (!is_null($prevBid)) {
            $loser = $prevBid->getTask()->getOwner();
            $loser->setTopup($loser->getTopup() + $prevBid->getPrice());

            // new finance
            $f = new Finance();
            $f->setUser($loser);
            $f->setAmount($prevBid->getPrice());
            $f->setType(60);
            $em->persist($f);
        }
    }
}
