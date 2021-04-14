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
        $couponId = $finance->getCouponId();

        $em = $this->getDoctrine()->getManager();
        $user = $this->getDoctrine()->getRepository(User::class)->find($uid);

        if ($couponId != 0) {
            $coupon = $this->getDoctrine()->getRepository(Coupon::class)->find($couponId);
            $user->removeCoupon($coupon);
        }

        // topup and success
        if ($type == 0 && $status == 5) {
            $user->setTopup($user->getTopup() + $amount);
        }

        if ($status == 5) {
            switch ($type) {
            case 1: // post task
                $user->setFrozen($user->getFrozen() + $amount - $fee);
                break;
            case 2: // stick
                break;
            case 3: // recommend
                break;
            case 4: // bid
                break;
            case 5: // equity
                break;
            case 6: // occupy
                break;
            case 7: // landLord
                break;
            case 8: // buyVip
                $level = $user->getLevel();
                $rebate = $level->getPrice() * $level->getTopupRatio();
                $referrer = $user->getReferrer();
                $referrer->setTopup($referrer->getTopup() + $rebate);
                $em->persist($referrer);
                break;
            default:
            }
        }

        $em->persist($user);
        $em->flush();
    }

    // balance
    public function prePersist(Finance $finance, LifecycleEventArgs $event): void
    {
        $uid = $finance->getUser();
        $type = $finance->getType();
        $note = $finance->getNote();
        $amount = $finance->getAmount();
        $status = $finance->getStatus();
        $couponId = $finance->getCouponId();
        $fee = $finance->getFee();

        $em = $this->getDoctrine()->getManager();
        $user = $this->getDoctrine()->getRepository(User::class)->find($uid);

        if ($couponId != 0) {
            $coupon = $this->getDoctrine()->getRepository(Coupon::class)->find($couponId);
            $user->removeCoupon($coupon);
        }

        switch ($type) {
        case 1: // post task
            $user->setFrozen($user->getFrozen() + $amount - $fee);
            break;
        case 2: // stick
            break;
        case 3: // recommend
            break;
        case 4: // bid
            break;
        case 5: // equity
            break;
        case 6: // occupy
            break;
        case 7: // landLord
            break;
        case 8: // buyVip
            $level = $user->getLevel();
            $rebate = $level->getPrice() * $level->getTopupRatio();
            $referrer = $user->getReferrer();
            $referrer->setTopup($referrer->getTopup() + $rebate);
            $em->persist($referrer);
            break;
        default:
        }

        $topup = $user->getTopup();
        if ($topup < $amount) {
            $user->setEarnings($user->getEarnings() - ($amount - $topup));
            $user->setTopup(0);
        }
        else {
            $user->setTopup($user->getTopup() - $amount);
        }

        $em->persist($user);
        $em->flush();
    }
}
