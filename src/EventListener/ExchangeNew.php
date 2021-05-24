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
use App\Entity\Exchange;
use App\Entity\Conf;
use Doctrine\Persistence\Event\LifecycleEventArgs;

class ExchangeNew
{
    public function prePersist(Exchange $exchange, LifecycleEventArgs $event): void
    {
        $em = $event->getEntityManager();
        $conf = $em->getRepository(Conf::class)->find(1);

        $gxb = $exchange->getGxb();
        $equity = $exchange->getEquity();
        $user = $exchange->getUser();

        $user->setEquity($user->getEquity() + $equity);
        $user->setGxb($user->getGxb() - $gxb);

        $conf->setExchanged($conf->getExchanged() + $equity);
    }
}
