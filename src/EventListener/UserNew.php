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
use Doctrine\Persistence\Event\LifecycleEventArgs;

class UserNew extends AbstractController
{
    public function __construct()
    {
    }

    public function postUpdate(User $user, LifecycleEventArgs $event): void
    {
    }

    public function prePersist(User $user, LifecycleEventArgs $event): void
    {
        $em = $this->getDoctrine()->getManager();
        $coupons = $this->getDoctrine()->getRepository(Coupon::class)->findAll();
        foreach ($coupons as $i) {
            $user->addCoupon($i);
        }
        //$em->persist($user);
        //$em->flush();
    }
}

