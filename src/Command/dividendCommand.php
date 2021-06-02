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
use App\Entity\Dividend;
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
        $fund = $conf->getDividendFund();
        $coinThreshold = $conf->getCoinThreshold();

        $userRepo = $this->em->getRepository(User::class);
        $users = $userRepo->findByCoin($coinThreshold);
        $sumCoin = $userRepo->sumCoin($coinThreshold);

        foreach ($users as $u) {
            $dividend = (int)($fund * 0.5 * $u->getCoin() / $sumCoin);

            $io->success($u->getUsername() . " " . $u->getCoin() . " " .  $dividend);
            $u->setTopup($u->getTopup() + $dividend);
            $u->setCoin(0);
            
            $f = new Finance();
            $f->setUser($u);
            $f->setAmount($dividend);
            $f->setType(59);

            $d = new Dividend();
            $d->setUser($u);
            $d->setAmount($dividend);
            $d->setCoin($u->getCoin());
            $d->setCoinTotal($sumCoin);
            $d->setFund($fund);
            $d->setCoinThreshold($coinThreshold);

            $this->em->persist($f);
            $this->em->persist($d);
        }
        
        $conf->setDividendFund(0);
        $this->em->flush();

        return Command::SUCCESS;
    }
}
