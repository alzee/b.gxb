<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use App\Repository\ApplyRepository;
use Doctrine\ORM\EntityManagerInterface;

class delSubmitTimeoutCommand extends Command
{
    protected static $defaultName = 'delSubmitTimeout';

    private $applyRepo;

    private $em;

    public function __construct(ApplyRepository $applyRepo, EntityManagerInterface $em)
    {
        $this->applyRepo = $applyRepo;
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

        $applies = $this->applyRepo->findBy(['status' => 11]);

        foreach ($applies as $apply) {
            $applyDate = $apply->getDate();
            $hours = $apply->getTask()->getWorkHours();
            if (is_null($hours)) {
                $hours = 0;
                // $io->success('this task has no workhours');
            }
            $deadline = $applyDate->add(new \DateInterval('PT' . $hours . 'H'));
            $now = new \DateTime();
            // if (true) {
            if ($now > $deadline) {
                // $io->success('youre dead');
                $this->em->remove($apply);
                $this->em->flush();
            }
        }

        return Command::SUCCESS;
    }
}
