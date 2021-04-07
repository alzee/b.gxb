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
use App\Entity\User;
use Doctrine\Persistence\Event\LifecycleEventArgs;

class GxbNew extends AbstractController
{
    public function __construct()
    {
    }

    public function prePersist(Gxb $gxb, LifecycleEventArgs $event): void
    {
        $uid = $gxb->getUser();
        $amount = $gxb->getAmount();

        $em = $this->getDoctrine()->getManager();
        $user = $this->getDoctrine()->getRepository(User::class)->find($uid);
        $user->setGxb($user->getGxb() + $amount);
        $em->persist($user);
        $em->flush();
    }
}

