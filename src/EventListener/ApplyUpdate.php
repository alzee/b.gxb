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
use App\Entity\Conf;
use App\Entity\Finance;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;

class ApplyUpdate
{
    public function preUpdate(Apply $apply, PreUpdateEventArgs $event): void
    {
        if ($event->hasChangedField('status') && $event->getNewValue('status')->getId() == 12) {
            $em = $event->getEntityManager();
            $apply->setSubmitAt(new \DateTime());
        }
    }

    public function postUpdate(Apply $apply, LifecycleEventArgs $event): void
    {
        $applyStatusId = $apply->getStatus()->getId();

        if ($applyStatusId == 13) {
            if (1) {
                // unfreeze?
            }
        }

        if ($applyStatusId == 14) {
            $em = $event->getEntityManager();
            $price = $apply->getTask()->getPrice();
            $applicant = $apply->getApplicant();
            $owner = $apply->getTask()->getOwner();

            $owner->setFrozen($owner->getFrozen() - $price);
            $applicant->setEarnings($applicant->getEarnings() + $price);
            // new finance for $applicant
            $f0 = new Finance();
            $f0->setUser($applicant);
            $f0->setAmount($price);
            $f0->setType(53);
            $em->persist($f0);

            $conf = $em->getRepository(Conf::class)->find(1);

            $coinsPerYuan = $conf->getCoinsPerYuan();
            $applicant->setCoin($applicant->getCoin() + intval(($price / 100) * $coinsPerYuan));
            $referer = $applicant->getReferrer();
            if (!is_null($referer)) {
                $rewardRate = $conf->getReferReward();
                $referer->setTopup($referer->getTopup() + ($price * $rewardRate));
                // new finance for $referer
                $f1 = new Finance();
                $f1->setUser($referer);
                $f1->setAmount($price * $rewardRate);
                $f1->setType(51);
                $f1->setNote($applicant->getUsername());
                $em->persist($f1);

                $rOfReferer = $referer->getReferrer();
                if (!is_null($rOfReferer)) {
                    $rewardRate2 = $conf->getReferReward2();
                    $rOfReferer->setTopup($rOfReferer->getTopup() + ($price * $rewardRate2));
                    // new finance for $rOfReferer
                    $f2 = new Finance();
                    $f2->setUser($rOfReferer);
                    $f2->setAmount($price * $rewardRate2);
                    $f2->setType(52);
                    $f2->setNote($applicant->getUsername());
                    $em->persist($f2);
                }
            }
            $em->flush();
        }
    }
}
