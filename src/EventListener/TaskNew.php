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
use App\Entity\Status;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;

class TaskNew extends AbstractController
{
    public function preUpdate(Task $task, PreUpdateEventArgs $event): void
    {
    }

    public function prePersist(Task $task, LifecycleEventArgs $event): void
    {
        $em = $event->getEntityManager();
        $status = $this->getDoctrine()->getRepository(Status::class)->find(2);
        $task->setStatus($status);
    }
}

