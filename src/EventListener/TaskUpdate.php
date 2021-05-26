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
        $em = $event->getEntityManager();
        $owner = $task->getOwner();
        $f = new Finance();

        if ($task->getStatus()->getId() == 4) {
            $remain = $task->getRemain();
            $price = $task->getPrice();
            $amount = $remain * $price;

            $owner->setFrozen($owner->getFrozen() - $amount);
            $owner->setTopup($owner->getTopup() + $amount);

            $type = 56;
        }

        if ($task->getStatus()->getId() == 5) {
            $finance = $task->getFinance();
            $amount = $finance->getAmount();
            $fee = $finance->getFee();

            $owner->setFrozen($owner->getFrozen() - $amount + $fee);
            $owner->setTopup($owner->getTopup() + $amount);

            $type = 61;
        }

        $f->setUser($owner);
        $f->setAmount($amount);
        $f->setType($type);
        $em->persist($f);
        $em->flush();
    }
}
