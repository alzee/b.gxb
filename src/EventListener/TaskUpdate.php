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
        $owner = $task->getOwner();
        $conf = $em->getRepository(Conf::class)->find(1);

        if ($task->getStatus()->getId() == 2) {
            $f = $task->getFinance();
            $fee = $f->getFee();
            $conf->setDividendFund($conf->getDividendFund() + $fee);
            $f->setIsFund(true);
            $em->flush();
        }

        if ($task->getStatus()->getId() == 4) {
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

        if ($task->getStatus()->getId() == 5) {
            $finance = $task->getFinance();
            $amount = $finance->getAmount();
            $fee = $finance->getFee();

            $owner->setFrozen($owner->getFrozen() - $amount + $fee);
            $owner->setTopup($owner->getTopup() + $amount);

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
