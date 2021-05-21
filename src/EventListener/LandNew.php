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
use App\Entity\Conf;
use Doctrine\Persistence\Event\LifecycleEventArgs;

class LandNew
{
    public function prePersist(Land $land, LifecycleEventArgs $event): void
    {
        $em = $event->getEntityManager();
        $conf = $em->getRepository(Conf::class)->find(1);
        $land->setPrice($conf->getLandPrice());
    }
}
