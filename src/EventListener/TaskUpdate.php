<?php
/**
 * vim:ft=php et ts=4 sts=4
 * @author z14 <z@arcz.ee>
 * @version
 * @todo
 */

namespace App\EventListener;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Task;
use App\Entity\Finance;
use Doctrine\Persistence\Event\LifecycleEventArgs;

class TaskUpdate
{
    public function postUpdate(Task $task, LifecycleEventArgs $event): void
    {
        if ($task->getStatus()->getId() == 4) {
            // unfreeze
            $em = $event->getEntityManager();
            $owner = $task->getOwner();
            $remain = $task->getRemain();
            $price = $task->getPrice();
            $amount = $remain * $price;

            $owner->setFrozen($owner->getFrozen() - $amount);
            $owner->setTopup($owner->getTopup() + $amount);

            // new finance for $referer
            $f = new Finance();
            $f->setUser($owner);
            $f->setAmount($amount);
            $f->setType(56);
            $em->persist($f);

            $em->flush();
        }
    }
}
