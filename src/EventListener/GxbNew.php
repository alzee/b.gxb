<?php
/**
 * vim:ft=php et ts=4 sts=4
 * @author z14 <z@arcz.ee>
 * @version
 * @todo
 */

namespace App\EventListener;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Gxb;
use Doctrine\Persistence\Event\LifecycleEventArgs;

class GxbNew
{
    public function __construct()
    {
    }

    public function prePersist(Gxb $gxb, LifecycleEventArgs $event): void
    {
        $user = $gxb->getUser();
        $amount = $gxb->getAmount();
        $user->setGxb($user->getGxb() + $amount);
    }
}

