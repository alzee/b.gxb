<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use App\Entity\User;
use App\Entity\Level;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;

class vipTimeoutCommand extends Command
{
    protected static $defaultName = 'vipTimeout';

    private $userRepo;

    private $em;

    public function __construct(UserRepository $userRepo, EntityManagerInterface $em)
    {
        $this->userRepo = $userRepo;
        $this->em = $em;
        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setDescription('Add a short description for your command')
            ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $arg1 = $input->getArgument('arg1');

        $now = new \DateTime();
        $vips= $this->userRepo->findVips();
        $noneVip = $this->em->getRepository(Level::class)->find(9);

        foreach ($vips as $u) {
            if ($now > $u->getVipUntil()) {
                $io->success($u->getUsername() . ', your vip over ');
                $u->setLevel($noneVip);
                $u->setVipUntil(null);
                $this->em->flush();
            }
        }



        return Command::SUCCESS;
    }
}
