<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use App\Repository\FinanceRepository;
use App\Repository\UserRepository;

class SumTypeByUserCommand extends Command
{
    protected static $defaultName = 'sumTypeByUser';
    protected static $defaultDescription = 'Add a short description for your command';

    private $financeRepo;
    private $userRepo;

    public function __construct(FinanceRepository $financeRepo, UserRepository $userRepo)
    {
        $this->financeRepo = $financeRepo;
        $this->userRepo = $userRepo;
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->setDescription(self::$defaultDescription)
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

        if ($arg1) {
            $io->note(sprintf('You passed an argument: %s', $arg1));
        }

        if ($input->getOption('option1')) {
            // ...
        }

        $user = $this->userRepo->find($arg2);
        $a = $this->financeRepo->sumTypeByUser($arg1, $user);

        // $io->success('You have a new command! Now make it your own! Pass --help to see your options.');
        $io->success($a);

        return Command::SUCCESS;
    }
}
