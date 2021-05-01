<?php
/**
 * vim:ft=php et ts=4 sts=4
 * @author z14 <z@arcz.ee>
 * @version
 * @todo
 */

namespace App\EventListener;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\User;
use App\Entity\Apply;
use App\Entity\Config;
use App\Entity\Finance;
use Doctrine\Persistence\Event\LifecycleEventArgs;

class ApplyUpdate extends AbstractController
{
    public function __construct()
    {
    }

    public function postUpdate(Apply $apply, LifecycleEventArgs $event): void
    {
        if ($apply->getStatus()->getId() == 14) {
            $em = $this->getDoctrine()->getManager();
            $price = $apply->getTask()->getPrice();
            $applicant = $apply->getApplicant();
            $owner = $apply->getTask()->getOwner();

            $owner->setFrozen($owner->getFrozen() - $price);
            $applicant->setEarnings($applicant->getEarnings() + $price);
            // new finance for $applicant
            $f0 = new Finance();
            $f0->setUser($applicant);
            $f0->setAmount($price);
            $f0->setType(10);
            $f0->setNote('任务奖励');
            $f0->setStatus(5);
            $em->persist($f0);

            $applicant->setCoin($applicant->getCoin() + intval($price / 100));
            $referer = $applicant->getReferrer();
            if (!is_null($referer)) {
                $configRepo = $em->getRepository(Config::class);
                $rewardRate = $configRepo->findOneBy(['label' => 'referReward'])->getValue();
                $referer->setTopup($referer->getTopup() + ($price * $rewardRate));
                // new finance for $referer
                $f1 = new Finance();
                $f1->setUser($referer);
                $f1->setAmount($price * $rewardRate);
                $f1->setType(11);
                $f1->setNote('任务分销奖励1级 ' . $applicant->getUsername());
                $f1->setStatus(5);
                $em->persist($f1);

                $rOfReferer = $referer->getReferrer();
                if (!is_null($rOfReferer)) {
                    $rewardRate2 = $configRepo->findOneBy(['label' => 'referReward2'])->getValue();
                    $rOfReferer->setTopup($rOfReferer->getTopup() + ($price * $rewardRate2));
                    // new finance for $rOfReferer
                    $f2 = new Finance();
                    $f2->setUser($rOfReferer);
                    $f2->setAmount($price * $rewardRate2);
                    $f2->setType(12);
                    $f2->setNote('任务分销奖励2级 ' . $applicant->getUsername());
                    $f2->setStatus(5);
                    $em->persist($f2);
                }
            }
            $em->flush();
        }
    }

    public function prePersist(Apply $apply, LifecycleEventArgs $event): void
    {
    }
}
