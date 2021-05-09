<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use App\Entity\Apply;
use App\Entity\Status;
use App\Repository\ApplyRepository;
use Doctrine\ORM\EntityManagerInterface;

class approveTimeoutCommand extends Command
{
    protected static $defaultName = 'approveTimeout';

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
        $arg1 = $input->getArgument('arg1');

        $applies = $this->applyRepo->findBy(['status' => 12]);
        $statusDone = $this->em->getRepository(Status::class)->find(14);

        foreach ($applies as $apply) {
            $now = new \DateTime();
            $hours = $apply->getTask()->getReviewHours();
            if (is_null($hours)) {
                $hours = 0;
                // $io->success('this task has no workhours');
            }
            $deadline = $apply->getSubmitAt()->add(new \DateInterval('PT' . $hours . 'H'));
            if ($now > $deadline) {
                // $io->success('auto approve apply: ' . $apply->getId());
                $apply->setStatus($statusDone);
                $this->em->flush();
            }
        }

        return Command::SUCCESS;
    }
}
