<?php
/**
 * vim:ft=php et ts=4 sts=4
 * @author z14 <z@arcz.ee>
 * @version
 * @todo
 */

namespace App\EventListener;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Land;
use App\Entity\LandTrade;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;

class LandUpdate
{
    public function postUpdate(Land $land, LifecycleEventArgs $event): void
    {
        $em = $event->getEntityManager();
        $landTrade = $em->getRepository(LandTrade::class)->findOneBy(['land' => $land, 'buyer' => NULL], ['id' => 'DESC']);
        if (!is_null($landTrade)) {
            $landTrade->setPrice($land->getPrice());
            $landTrade->setDate(new \DateTimeImmutable());
            $em->flush();
        }
    }
}
