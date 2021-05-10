<?php
/**
 * vim:ft=php et ts=4 sts=4
 * @author z14 <z@arcz.ee>
 * @version
 * @todo
 */

namespace App\EventListener;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Read;
use Doctrine\Persistence\Event\LifecycleEventArgs;

class ReadNew
{
    public function prePersist(Read $read, LifecycleEventArgs $event): void
    {
        $user = $read->getUser();
        $user->setCoin($user->getCoin() + 1);
    }
}
