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
use App\Entity\Bid;
use App\Entity\Land;
use App\Entity\LandPost;
use App\Entity\EquityTrade;
use Doctrine\Persistence\Event\LifecycleEventArgs;

class FinanceNew extends AbstractController
{
    public function prePersist(Finance $finance, LifecycleEventArgs $event): void
    {
        $t = $finance->getType();
        switch ($t) {
        case 1:
            $note = '任务发布';
            break;
        case 2:
            $note = '任务置顶';
            break;
        case 3:
            $note = '任务推荐';
            break;
        case 4:
            $note = '任务竞价';
            break;
        case 5:
            $note = '购买股权';
            break;
        case 6:
            $note = '占领格子';
            break;
        case 7:
            $note = '购买领地';
            break;
        case 8:
            $note = '购买会员';
            break;
        case 19:
            $note = '提现';
            break;
        case 50:
            $note = '充值';
            break;
        case 51:
            // $note = '任务分销奖励1级 $applicant';
            $note = $finance->getNote();
            break;
        case 52:
            // $note = '任务分销奖励2级 $applicant';
            $note = $finance->getNote();
            break;
        case 53:
            $note = '任务奖励';
            break;
        case 54:
            $note = '出售股权';
            break;
        case 55:
            $note = '出售领地';
            break;
        case 56:
            $note = '资金解冻';
            break;
        default:
            $note = 'unkown';
        }
        $finance->setNote($note);
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
            case 50: // topup
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
                $t = $this->getDoctrine()->getRepository(Task::class)->find($postData['taskId']);
                $bid = new Bid();
                $bid->setIsBuyNow($postData['isBuyNow']);
                $bid->setPosition($postData['position']);
                $bid->setPrice($postData['price']);
                $bid->setTask($t);
                $em->persist($bid);
                break;
            case 5: // equity
                $e = $this->getDoctrine()->getRepository(EquityTrade::class)->find($data['entityId']);
                $e->setBuyer($user);
                $e->setStatus(1);
                $user->setEquity($user->getEquity() + $e->getEquity());
                $seller = $e->getSeller();
                $seller->setTopup($seller->getTopup()  + $amount);
                // new finance for $seller
                $f = new Finance();
                $f->setUser($seller);
                $f->setAmount($amount);
                $f->setType(54);
                $f->setStatus(5);
                $em->persist($f);
                break;
            case 6: // occupy
                $owner = $this->getDoctrine()->getRepository(User::class)->find($postData['ownerId']);
                $land = $this->getDoctrine()->getRepository(Land::class)->find($postData['landId']);
                $landPost = new LandPost();
                $landPost->setOwner($owner);
                $landPost->setLand($land);
                $landPost->setBody($postData['body']);
                $landPost->setDays($postData['days']);
                $landPost->setPrice($postData['price']);
                $landPost->setCover($postData['cover']);
                $landPost->setPics($postData['pics']);
                $landPost->setShowUntil(new \DateTime($postData['showUntil']));
                $em->persist($landPost);
                break;
            case 7: // landLord
                $owner = $this->getDoctrine()->getRepository(User::class)->find($postData['ownerId']);
                $land = $this->getDoctrine()->getRepository(Land::class)->find($data['entityId']);
                $originalOwner = $land->getOwner();
                if (!is_null($originalOwner)) {
                    $originalOwner->setTopup($originalOwner->getTopup()  + $amount);
                    // new finance for $originalOwner
                    $f = new Finance();
                    $f->setUser($originalOwner);
                    $f->setAmount($amount);
                    $f->setType(55);
                    $f->setStatus(5);
                    $em->persist($f);
                }
                $land->setPrePrice($postData['prePrice']);
                $land->setOwner($owner);
                $land->setForSale($postData['forSale']);
                break;
            case 8: // buyVip
                $level = $this->getDoctrine()->getRepository(Level::class)->find($postData['levelId']);
                $user->setLevel($level);
                $vipUntil = new \DateTime();
                $vipUntil = $vipUntil->add(new \DateInterval('P' . $level->getDays(). 'D'));
                $user->setVipUntil($vipUntil);
                $rebate = $level->getPrice() * 100 * $level->getTopupRatio();
                if ($referrer = $user->getReferrer()) {
                    $referrer->setTopup($referrer->getTopup() + $rebate);
                }
                break;
            case 19: // withdraw
                break;
            }

            // deduct balance
            if ($type != 50 && $method == 0) {
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
