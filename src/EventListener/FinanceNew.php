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
use Doctrine\Persistence\Event\LifecycleEventArgs;

class FinanceNew extends AbstractController
{
    public function __construct()
    {
    }

    // wxpay
    public function postUpdate(Finance $finance, LifecycleEventArgs $event): void
    {
        $uid = $finance->getUser();
        $type = $finance->getType();
        $note = $finance->getNote();
        $amount = $finance->getAmount();
        $status = $finance->getStatus();

        // topup and success
        if ($type == 1 && $status == 5) {
            $em = $this->getDoctrine()->getManager();
            $user = $this->getDoctrine()->getRepository(User::class)->find($uid);
            $user->setTopup($user->getTopup() + $amount);
            $em->persist($user);
            $em->flush();
        }

    }

    // balance
    public function prePersist(Finance $finance, LifecycleEventArgs $event): void
    {
        $uid = $finance->getUser();
        $type = $finance->getType();
        $note = $finance->getNote();
        $amount = $finance->getAmount();
        $status = $finance->getStatus();

        $em = $this->getDoctrine()->getManager();
        $user = $this->getDoctrine()->getRepository(User::class)->find($uid);

        switch ($type) {
        case 0: // post task
            $user->setFrozen($user->getFrozen() + $amount);
        case 2: // other payment
            $user->setTopup($user->getTopup() - $amount);
            break;
        case 3:
            break;
        default:
            break;
        }

        $em->persist($user);
        $em->flush();
    }
}

