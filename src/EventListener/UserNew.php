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
use App\Entity\Level;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;

class UserNew extends AbstractController
{
    public function preUpdate(User $user, PreUpdateEventArgs $event): void
    {
    }

    public function prePersist(User $user, LifecycleEventArgs $event): void
    {
        $em = $this->getDoctrine()->getManager();
        $coupons = $this->getDoctrine()->getRepository(Coupon::class)->findAll();
        $level = $this->getDoctrine()->getRepository(Level::class)->find(9);
        $referer = $user->getReferrer();
        if (!is_null($referer)) {
            $referer->setGxb($referer->getGxb() + 100);
        }
        foreach ($coupons as $i) {
            $user->addCoupon($i);
        }
        $user->setLevel($level);
    }
}

