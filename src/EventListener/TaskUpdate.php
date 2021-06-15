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
use App\Entity\Conf;

class TaskUpdate
{
    public function postUpdate(Task $task, LifecycleEventArgs $event): void
    {
        $em = $event->getEntityManager();
        $uow = $em->getUnitOfWork();
        $changeSet = $uow->getEntityChangeSet($task);
        $owner = $task->getOwner();
        $conf = $em->getRepository(Conf::class)->find(1);
        $status = $task->getStatus()->getId();

        if (isset($changeSet['status'])) {
            if ($status == 2) {
                $f = $task->getFinance();
                $fee = $f->getFee();
                $conf->setDividendFund($conf->getDividendFund() + $fee);
                $f->setIsFund(true);
                $em->flush();
            }

            if ($status == 4) {
                $remain = $task->getRemain();
                $price = $task->getPrice();
                $amountLeft = $remain * $price;

                $owner->setFrozen($owner->getFrozen() - $amountLeft);
                $owner->setTopup($owner->getTopup() + $amountLeft);

                $type = 56;

                $f = new Finance();
                $f->setUser($owner);
                $f->setAmount($amountLeft);
                $f->setType($type);
                $em->persist($f);
                $em->flush();
            }

            if ($status == 5) {
                $finance = $task->getFinance();
                $amount = $finance->getAmount();
                $fee = $finance->getFee();

                $owner->setFrozen($owner->getFrozen() - $amount);
                $owner->setTopup($owner->getTopup() + $amount + $fee);

                $type = 61;

                $f = new Finance();
                $f->setUser($owner);
                $f->setAmount($amount);
                $f->setType($type);
                $em->persist($f);
                $em->flush();
            }
        }

    }
}
