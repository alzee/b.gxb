<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use App\Entity\User;
use App\Entity\EquityFee;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;

class getFeeCommand extends Command
{
    protected static $defaultName = 'getFee';

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
            ->addArgument('arg2', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $arg1 = $input->getArgument('arg1');
        $arg2 = $input->getArgument('arg2');

        $count1 = $arg1;
        $count2 = $arg2;
        $feeRates = $this->em->getRepository(EquityFee::class)->findBy([], ['rate' => 'ASC']);

        foreach ($feeRates as $f) {
            if ($count1 >= $f->getL1() || $count2 >= $f->getL2()) {
                $feeRate = $f->getRate();
                break;
            }
        }
        $io->success($feeRate);

        return Command::SUCCESS;
    }
}
