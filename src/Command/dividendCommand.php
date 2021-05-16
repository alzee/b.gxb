<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use App\Entity\User;
use App\Entity\Conf;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;

class dividendCommand extends Command
{
    protected static $defaultName = 'dividend';

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

        // get fund * 50%
        $conf = $this->em->getRepository(Conf::class)->find(1);
        $fund = $conf->getDividendFund() * 0.5;

        // get users with 10 or more coins
        $users = $this->em->getRepository(User::class)->findByCoin(10);

        foreach ($users as $u) {
            $io->success($u->getCoin());
        }
        
        // reset fund

        return Command::SUCCESS;
    }
}
