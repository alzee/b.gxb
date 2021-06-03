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
use App\Entity\LandTrade;
use App\Entity\LandPost;
use App\Entity\EquityTrade;
use App\Entity\EquityFee;
use App\Entity\Conf;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;

class FinanceNew extends AbstractController
{
    public function prePersist(Finance $finance, LifecycleEventArgs $event): void
    {
        $t = $finance->getType();
        $amount = $finance->getAmount();
        $fee = $finance->getFee();
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
            // $note = '提现';
            $user = $finance->getUser();
            $user->setTopup($user->getTopup() - $amount - $fee);
            break;
        case 50:
            $note = '充值';
            break;
        case 51:
            // $note = '任务分销奖励1级 $applicant';
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
            $note = '解冻-任务下架';
            break;
        case 57:
            $note = '格子收益';
            break;
        case 58:
            // $note = '购买会员返利 $user';
            $note = $finance->getNote();
            break;
        case 59:
            $note = '全民分红';
            break;
        case 60:
            $note = '退款-首页竞价';
            break;
        case 61:
            $note = '解冻-任务审核拒绝';
            break;
        default:
            $note = 'unkown';
        }
        if ($t > 50) {
            $finance->setStatus(5);
        } 
        if (isset($note)) {
            $finance->setNote($note);
        }
    }

    public function preUpdate(Finance $finance, PreUpdateEventArgs $event): void
    {
        if ($event->hasChangedField('status') && $event->getNewValue('status') == 5) {
            $finance->setIsFund(true);
        }
    }

    public function postUpdate(Finance $finance, LifecycleEventArgs $event): void
    {
        $em = $event->getEntityManager();
        $conf = $em->getRepository(Conf::class)->find(1);
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
                $tStatus = $this->getDoctrine()->getRepository(Status::class)->find(1);
                $t->setStatus($tStatus);
                $t->setFinance($finance);
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

                $userRepo = $em->getRepository(User::class);
                $count1 = $userRepo->count(['referrer' => $seller]);
                $count2 = $userRepo->count(['ror' => $seller]);
                $feeRates = $em->getRepository(EquityFee::class)->findBy([], ['rate' => 'ASC']);
                foreach ($feeRates as $f) {
                    if ($count1 >= $f->getL1() || $count2 >= $f->getL2()) {
                        $feeRate = $f->getRate();
                        break;
                    }
                }
                $seller->setTopup($seller->getTopup()  + $amount * (1 - $feeRate));
                // new finance for $seller
                $f = new Finance();
                $f->setUser($seller);
                $f->setAmount($amount * (1 - $feeRate));
                $f->setType(54);
                $em->persist($f);
                break;
            case 6: // occupy
                $owner = $this->getDoctrine()->getRepository(User::class)->find($postData['ownerId']);
                $land = $this->getDoctrine()->getRepository(Land::class)->find($postData['landId']);
                $landOwner = $land->getOwner();
                if (!is_null($landOwner)) {
                    $landTrade = $em->getRepository(LandTrade::class)->findOneBy(['buyer' => $landOwner, 'land' => $land], ['date' => 'DESC']);
                    $landBoughtAt = $landTrade->getDate();
                    $now = new \DateTime('now');
                    if ($now->diff($landBoughtAt)->d >= 1) {
                        $landOwner->setTopup($landOwner->getTopup()  + $amount / 2);
                        // new finance for $landOwner
                        $f = new Finance();
                        $f->setUser($landOwner);
                        $f->setAmount($amount / 2);
                        $f->setType(57);
                        $em->persist($f);
                    }
                }

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
                if (isset($data['landId'])) {
                    $land = $this->getDoctrine()->getRepository(Land::class)->find($data['landId']);
                    $landTrade = $this->getDoctrine()->getRepository(LandTrade::class)->findOneBy(['land' => $land, 'buyer' => NULL], ['id' => 'DESC']);
                    if (is_null($landTrade)) {
                        $landTrade =  new LandTrade();
                        $landTrade->setLand($land);
                        $landTrade->setPrePrice($postData['price']);
                        $landTrade->setPrice($postData['price']);
                        $em->persist($landTrade);
                    }
                }

                if (isset($data['id'])) {
                    $landTrade = $this->getDoctrine()->getRepository(LandTrade::class)->find($data['id']);
                    $land = $landTrade->getLand();
                }

                $buyer = $this->getDoctrine()->getRepository(User::class)->find($postData['buyer']);
                $seller = $land->getOwner();


                if (!is_null($seller)) {
                    $ratio = $seller->getLevel()->getLandTradeRatio();
                    $profit = ($land->getPrice() - $land->getPrePrice()) * $ratio;
                    if ($profit > 0) {
                        $total = $land->getPrePrice() + $profit;
                    }
                    else {
                        $total = $land->getPrice();
                    }
                    $seller->setTopup($seller->getTopup()  + $total);
                    // new finance for $seller
                    $f = new Finance();
                    $f->setUser($seller);
                    $f->setAmount($total);
                    $f->setType(55);
                    $em->persist($f);

                    $landTrade->setSeller($seller);
                }

                $landTrade->setBuyer($buyer);
                $landTrade->setDate(new \DateTimeImmutable());

                // sell again immediately
                $landTrade1 =  new LandTrade();
                $landTrade1->setLand($land);
                $landTrade1->setPrePrice($postData['price']);
                $landTrade1->setPrice($postData['price'] * 1.1);
                $landTrade1->setSeller($buyer);
                $landTrade1->setDate(new \DateTimeImmutable());
                $em->persist($landTrade1);

                $land->setPrePrice($postData['price']);
                $land->setPrice($postData['price'] * 1.1);
                $land->setOwner($buyer);
                break;
            case 8: // buyVip
                $level = $this->getDoctrine()->getRepository(Level::class)->find($postData['levelId']);
                $user->setLevel($level);
                if ($referrer = $user->getReferrer()) {
                    $rebate = $level->getPrice() * 100 * $level->getTopupRatio();
                    $referrer->setTopup($referrer->getTopup() + $rebate);
                    // new finance for $referrer
                    $f = new Finance();
                    $f->setUser($referrer);
                    $f->setAmount($rebate);
                    $f->setType(58);
                    $f->setNote('购买会员返利 ' . $user->getUsername());
                    $em->persist($f);
                }
                $conf->setDividendFund($conf->getDividendFund() + $amount);
                break;
            case 19: // withdraw
                break;
            }

            // deduct balance
            if ($type < 19 && $method == 0) {
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
