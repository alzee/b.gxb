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
use App\Entity\Finance;
use Doctrine\ORM\EntityManagerInterface;

class dividendCommand extends Command
{
    protected static $defaultName = 'dividend';

    private $em;

    public function __construct(EntityManagerInterface $em)
    {
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

        $conf = $this->em->getRepository(Conf::class)->find(1);
        $fund = $conf->getDividendFund() * 0.5;

        $userRepo = $this->em->getRepository(User::class);
        $users = $userRepo->findByCoin(10);
        $sumCoin = $userRepo->sumCoin(10);

        foreach ($users as $u) {
            $dividend = (int)(($fund * $u->getCoin() / $sumCoin) * 100);

            $io->success($u->getUsername() . " " . $u->getCoin() . " " .  $dividend);
            $u->setTopup($u->getTopup() + $dividend);
            
            $f = new Finance();
            $f->setUser($u);
            $f->setAmount($dividend);
            $f->setType(59);
            $f->setStatus(5);
            $this->em->persist($f);
        }
        
        // $conf->setDividendFund(0);
        $this->em->flush();

        return Command::SUCCESS;
    }
}
