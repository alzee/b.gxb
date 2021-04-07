<?php
/**
 * vim:ft=php et ts=4 sts=4
 * @author z14 <z@arcz.ee>
 * @version
 * @todo
 */

namespace App\EventListener;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Finance;
use App\Entity\User;
use Doctrine\Persistence\Event\LifecycleEventArgs;

class FinanceNew extends AbstractController
{
    private $a;
    private $b;
    private $c;
    
    public function __construct()
    {
    }

    public function postUpdate(Finance $finance, LifecycleEventArgs $event): void
    {
        $uid = $finance->getUser();
        $type = $finance->getType();
        $note = $finance->getNote();
        $amount = $finance->getAmount();
        $status = $finance->getStatus();

        if ($status == 5) {
            $em = $this->getDoctrine()->getManager();
            $user = $this->getDoctrine()->getRepository(User::class)->find($uid);
            $user->setTopup($user->getTopup() + $amount);
            $em->persist($user);
            $em->flush();
        }
    }

    public function prePersist(Finance $finance, LifecycleEventArgs $event): void
    {
    }
}

