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
use App\Entity\Task;
use Doctrine\Persistence\Event\LifecycleEventArgs;

class FinanceNew extends AbstractController
{
    public function __construct()
    {
    }

    // wxpay
    public function postUpdate(Finance $finance, LifecycleEventArgs $event): void
    {
        $em = $event->getEntityManager();
        $uid = $finance->getUser();
        $user = $this->getDoctrine()->getRepository(User::class)->find($uid);
        $type = $finance->getType();
        $note = $finance->getNote();
        $amount = $finance->getAmount();
        $status = $finance->getStatus();
        $couponId = $finance->getCouponId();
        $fee = $finance->getFee();
        $method = $finance->getMethod();
        $data = $finance->getData();
        $postData = isset($data['postData']) ? $data['postData'] : [];


        if ($status == 5) {
            if ($couponId != 0) {
                $coupon = $this->getDoctrine()->getRepository(Coupon::class)->find($couponId);
                $user->removeCoupon($coupon);
            }

            switch ($type) {
            case 0: // topup
                $user->setTopup($user->getTopup()  + $amount);
                break;
            case 1: // post task
                $user->setFrozen($user->getFrozen() + $amount - $fee);
                break;
            case 2: // stick
                $task = $this->getDoctrine()->getRepository(Task::class)->find($data['entityId']);
                $task->setStickyUntil(new \DateTimeImmutable($postData['stickyUntil']));
                break;
            case 3: // recommend
                $task = $this->getDoctrine()->getRepository(Task::class)->find($data['entityId']);
                $task->setRecommendUntil(new \DateTimeImmutable($postData['recommendUntil']));
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
                $levelId = $finance->getLevel();
                $level = $this->getDoctrine()->getRepository(Level::class)->find($levelId);
                $rebate = $level->getPrice() * 100 * $level->getTopupRatio();
                if ($referrer = $user->getReferrer()) {
                    $referrer->setTopup($referrer->getTopup() + $rebate);
                }
                break;
            default:
            }

            if ($type != 0) {
                $topup = $user->getTopup();
                if ($topup < $amount) {
                    $user->setEarnings($user->getEarnings() - ($amount - $topup));
                    $user->setTopup(0);
                }
                else {
                    $user->setTopup($user->getTopup() - $amount);
                }
            }
        }

        $em->flush();
    }

    // balance
    public function prePersist(Finance $finance, LifecycleEventArgs $event): void
    {
    }
}
