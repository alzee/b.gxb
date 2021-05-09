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
            $em->flush();
        }
    }
}
