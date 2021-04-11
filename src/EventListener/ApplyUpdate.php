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
use Doctrine\Persistence\Event\LifecycleEventArgs;

class ApplyUpdate extends AbstractController
{
    public function __construct()
    {
    }

    public function postUpdate(Apply $apply, LifecycleEventArgs $event): void
    {
        if ($apply->getStatus()->getId() == 4) {
            $em = $this->getDoctrine()->getManager();
            $price = $apply->getTask()->getPrice();
            $applicant = $apply->getApplicant();
            $owner = $apply->getTask()->getOwner();

            $owner->setEarnings($owner->getEarnings() + $price);
            $applicant->setFrozen($applicant->getFrozen() - $price);
            $em->persist($owner);
            $em->persist($applicant);
            $em->flush();
        }
    }

    public function prePersist(Apply $apply, LifecycleEventArgs $event): void
    {
    }
}
