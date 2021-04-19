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
use App\Entity\Category;
use App\Entity\Status;
use Doctrine\Persistence\Event\LifecycleEventArgs;

class FinanceNew extends AbstractController
{
    public function __construct()
    {
    }

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
                $t = new Task();
                $cate = $this->getDoctrine()->getRepository(Category::class)->find($postData['cateId']);
                $t->setCategory($cate);
                $t->setDescription($postData['description']);
                $t->setGuides($postData['guides']);
                $t->setLink($postData['link']);
                $t->setName($postData['name']);
                $t->setNote($postData['note']);
                $owner = $this->getDoctrine()->getRepository(User::class)->find($postData['ownerId']);
                $t->setOwner($owner);
                $t->setPrice($postData['price']);
                $t->setQuantity($postData['quantity']);
                $t->setReviewHours($postData['reviewHours']);
                $t->setReviews($postData['reviews']);
                $t->setTitle($postData['title']);
                $t->setWorkHours($postData['workHours']);
                $tStatus = $this->getDoctrine()->getRepository(Status::class)->find(2);
                $t->setStatus($tStatus);
                $em->persist($t);
                break;
            case 2: // stick
                $t = $this->getDoctrine()->getRepository(Task::class)->find($data['entityId']);
                $t->setStickyUntil(new \DateTimeImmutable($postData['stickyUntil']));
                break;
            case 3: // recommend
                $t = $this->getDoctrine()->getRepository(Task::class)->find($data['entityId']);
                $t->setRecommendUntil(new \DateTimeImmutable($postData['recommendUntil']));
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
}
