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
        if ($type == 0 && $status == 5) {
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
        case 1: // post task
            $user->setFrozen($user->getFrozen() + $amount);
        case 2: // stick
        case 3: // recommend
        case 4: // bid
        case 5: // equity
        case 6: // occupy
        case 7: // landLord
        case 8: // buyVip
        default:
            $topup = $user->getTopup();
            if ($topup < $amount) {
                $user->setEarnings($user->getEarnings() - ($amount - $topup));
                $user->setTopup(0);
            }
            else {
                $user->setTopup($user->getTopup() - $amount);
            }
        }

        $em->persist($user);
        $em->flush();
    }
}

