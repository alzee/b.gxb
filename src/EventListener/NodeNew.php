<?php
/**
 * vim:ft=php et ts=4 sts=4
 * @author z14 <z@arcz.ee>
 * @version
 * @todo
 */

namespace App\EventListener;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Node;
use App\Entity\User;
use Doctrine\Persistence\Event\LifecycleEventArgs;

class NodeNew
{
    public function prePersist(Node $node, LifecycleEventArgs $event): void
    {
        if (is_null($node->getAuthor())) {
            $em = $event->getEntityManager();
            $author = $em->getRepository(User::class)->find(2);
            $node->setAuthor($author);
        }

        if ($node->getType()->getId() == 2) {
            $node->setApproved(false);
        }
    }
}
