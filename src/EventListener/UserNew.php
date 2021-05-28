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
use App\Entity\Coupon;
use App\Entity\Level;
use App\Entity\Gxb;
use App\Entity\Conf;
use App\Entity\Node;
use App\Entity\NodeType;
use Doctrine\Persistence\Event\LifecycleEventArgs;

class UserNew extends AbstractController
{
    public function prePersist(User $user, LifecycleEventArgs $event): void
    {
        $em = $event->getEntityManager();
        $coupons = $em->getRepository(Coupon::class)->findAll();
        $level = $em->getRepository(Level::class)->find(9);
        $conf = $em->getRepository(Conf::class)->find(1);
        $referer = $user->getReferrer();
        if (!is_null($referer)) {
            $gxb = new Gxb();
            $gxb->setUser($referer);
            $gxb->setAmount($conf->getReferGXB());
            $gxb->setType(2);
            $em->persist($gxb);

            $ror = $referer->getReferrer();
            if (!is_null($ror)) {
                $user->setRor($ror);
            }
        }

        foreach ($coupons as $i) {
            $user->addCoupon($i);
        }
        $user->setLevel($level);

        $text = $user->getRefcode();

        $posters = [
            'refer_poster0.jpg',
            'refer_poster1.jpg',
            'refer_poster2.jpg'
        ];

        foreach ($posters as $k => $v) {
            //Set the Content Type
            header('Content-type: image/jpeg');

            // Create Image From Existing File
            $jpg_image = imagecreatefromjpeg(__DIR__ . '/../../public/img/' . $v);

            // Allocate A Color For The Text
            if ($k == 1) {
                $color = imagecolorallocate($jpg_image, 218, 22, 22);
            }
            else {
                $color = imagecolorallocate($jpg_image, 255, 255, 255);
            }

            // Set Path to Font File
            $font_path = '/usr/share/fonts/dejavu-serif-fonts/DejaVuSerif.ttf';

            // Set Text to Be Printed On Image

            // Print Text On Image
            switch($k){
            case 0:
                imagettftext($jpg_image, 20, 0, 610, 1288, $color, $font_path, $text);
                break;
            case 1:
                imagettftext($jpg_image, 25, 0, 280, 645, $color, $font_path, $text);
                break;
            case 2:
                imagettftext($jpg_image, 18, 0, 242, 422, $color, $font_path, $text);
                break;
            }

            imagejpeg($jpg_image, __DIR__ .  '/../../public/img/poster/' . $user->getUsername() . '_' . $v, 100);
            imagedestroy($jpg_image);
        }
    }

    public function postPersist(User $user, LifecycleEventArgs $event): void
    {
        if ($user->getId() >= 100) {
            $em = $event->getEntityManager();
            $conf = $em->getRepository(Conf::class)->find(1);
            $typeNews = $em->getRepository(NodeType::class)->find(3);
            $admin = $em->getRepository(User::class)->find(2);
            $body = $conf->getWelcome();
            $body = preg_replace('/{{\s*username\s*}}/i', $user->getUsername(), $body);
            $body = preg_replace('/{{\s*id\s*}}/i', $user->getId(), $body);
            $node = new Node();
            $node->setTitle('恭喜第' . $user->getId() . '位股东加入共享宝');
            $node->setBody($body);
            $node->setAuthor($admin);
            $node->setType($typeNews);
            $em->persist($node);
            $em->flush();
        }
    }
}
