<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use App\Entity\Apply;
use App\Entity\Report;
use App\Repository\ApplyRepository;
use Doctrine\ORM\EntityManagerInterface;

class ReportTimeoutCommand extends Command
{
    protected static $defaultName = 'reportTimeout';
    protected static $defaultDescription = 'Add a short description for your command';

    private $applyRepo;
    private $em;

    public function __construct(ApplyRepository $applyRepo, EntityManagerInterface $em)
    {
        $this->applyRepo = $applyRepo;
        $this->em = $em;
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->setDescription(self::$defaultDescription)
            ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $arg1 = $input->getArgument('arg1');

        $applies = $this->applyRepo->findBy(['status' => 13]);

        foreach ($applies as $apply) {
            $now = new \DateTime();
            $deadline = $apply->getApprovedAt()->add(new \DateInterval('PT' . 24 . 'H'));
            if ($now > $deadline) {
                $report = $this->em->getRepository(Report::class)->findOneBy(['apply' => $apply]);
                if (is_null($report)) {
                    $io->success('removing apply ' . $apply->getId());
                    $this->em->remove($apply);
                    $this->em->flush();
                }
            }
        }

        return Command::SUCCESS;
    }
}
