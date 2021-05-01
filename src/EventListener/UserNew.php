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
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;

class UserNew extends AbstractController
{
    public function preUpdate(User $user, PreUpdateEventArgs $event): void
    {
    }

    public function prePersist(User $user, LifecycleEventArgs $event): void
    {
        $em = $this->getDoctrine()->getManager();
        $coupons = $this->getDoctrine()->getRepository(Coupon::class)->findAll();
        $level = $this->getDoctrine()->getRepository(Level::class)->find(9);
        $referer = $user->getReferrer();
        if (!is_null($referer)) {
            $referer->setGxb($referer->getGxb() + 100);

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
}

