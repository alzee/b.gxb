<?php
/**
 * vim:ft=php et ts=4 sts=4
 * @author z14 <z@arcz.ee>
 * @version
 * @todo
 */

namespace App\EventListener;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Apply;
use App\Entity\Status;
use Doctrine\Persistence\Event\LifecycleEventArgs;

class ApplyNew
{
    public function prePersist(Apply $apply, LifecycleEventArgs $event): void
    {
        $em = $event->getEntityManager();
        $task = $apply->getTask();
        $apply->setPic([$task->getQuantity(), $task->getCountApplies(), $task->getRemain()]);
        if ($task->getRemain() == 1) {
            $statusPause = $em->getRepository(Status::class)->find(3);
            $task->setStatus($statusPause);
        }
    }
}
