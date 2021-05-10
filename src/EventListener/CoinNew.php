<?php
/**
 * vim:ft=php et ts=4 sts=4
 * @author z14 <z@arcz.ee>
 * @version
 * @todo
 */

namespace App\EventListener;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Coin;
use Doctrine\Persistence\Event\LifecycleEventArgs;

class CoinNew
{
    public function prePersist(Coin $coin, LifecycleEventArgs $event): void
    {
        $user = $coin->getUser();
        $amount = $coin->getAmount();
        $user->setCoin($user->getCoin() + $amount);
    }
}
