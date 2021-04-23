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
use App\Entity\Conifg;
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
            $applicant->setCoin($applicant->getCoin() + intval($price / 100));
            $referer = $applicant->getReferrer();
            if (!is_null($referer)) {
                $configRepo = $em->getRepository(Config::class);
                $rewardRate = $configRepo->findOneBy(['label' => 'referReward']);
                $referer->setTopup($referer->getTopup() + ($price * $rewardRate));
                // new finance for $referer
                $rOfReferer = $referer->getReferrer();
                if (!is_null($rOfReferer)) {
                    $rewardRate2 = $configRepo->findOneBy(['label' => 'referReward2']);
                    $rOfReferer->setTopup($rOfReferer->getTopup() + ($price * $rewardRate2));
                    // new finance for $rOfReferer
                }
            }
            $em->flush();
        }
    }

    public function prePersist(Apply $apply, LifecycleEventArgs $event): void
    {
    }
}
