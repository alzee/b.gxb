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
use App\Entity\Report;
use App\Entity\Finance;
use App\Entity\Status;
use Doctrine\Persistence\Event\LifecycleEventArgs;

class ReportUpdate
{
    public function postUpdate(Report $report, LifecycleEventArgs $event): void
    {
        $em = $event->getEntityManager();

        $status = $report->getStatus();

        // nullity
        if ($status == 1) {
            // archive apply
            
            // rm apply
            $apply = $report->getApply();
            $em->remove($apply);
            
        }

        // ok
        if ($status == 2) {
            $doneStatus = $em->getRepository(Status::class)->find(14);
            $apply = $report->getApply();
            $apply->setStatus($doneStatus);
        }

        $em->flush();
    }
}
