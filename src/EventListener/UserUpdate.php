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
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserUpdate
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function preUpdate(User $user, PreUpdateEventArgs $event): void
    {
        if ($event->hasChangedField('password')) {
            $user->setPassword($this->encoder->encodePassword($user, $user->getPassword()));
        }
        if ($event->hasChangedField('plainPassword')) {
            $user->setPassword($this->encoder->encodePassword($user, $user->getPlainPassword()));
            $user->eraseCredentials();
        }
        if ($event->hasChangedField('payPasswd')) {
            $user->setPayPasswd($this->encoder->encodePassword($user, $user->getPayPasswd()));
        }
        if ($event->hasChangedField('level')) {
            $level = $event->getNewValue('level');
            $vipUntil = new \DateTime();
            $vipUntil = $vipUntil->add(new \DateInterval('P' . $level->getDays(). 'D'));
            $user->setVipUntil($vipUntil);
        }
    }
}
