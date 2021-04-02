<?php
/**
 * vim:ft=php et ts=4 sts=4
 * @author z14 <z@alz.ee>
 * @version
 * @todo
 */

namespace App\DataPersister;

use App\Entity\User;
use ApiPlatform\Core\DataPersister\DataPersisterInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserDataPersister implements DataPersisterInterface
{
    private $entityManager;
    private $userPasswordEncoder;
    public function __construct(EntityManagerInterface $entityManager, UserPasswordEncoderInterface $userPasswordEncoder)
    {
        $this->entityManager = $entityManager;
        $this->userPasswordEncoder = $userPasswordEncoder;
    }
    public function supports($data): bool
    {
        return $data instanceof User;
    }

    /**
     * @param User $data
     */
    public function persist($data)
    {
        if(is_null($data->getId())){
            $data->setPassword($this->userPasswordEncoder->encodePassword($data, $data->getPassword()));
            $data->eraseCredentials();
        };
        $this->entityManager->persist($data);
        $this->entityManager->flush();
    }
    public function remove($data)
    {
        $this->entityManager->remove($data);
        $this->entityManager->flush();
    }
}
