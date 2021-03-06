<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;
use App\Entity\User;

class CheckPassCommand extends Command
{
    protected static $defaultName = 'checkPass';
    protected static $defaultDescription = 'Add a short description for your command';

    private $em;
    private $encoder;
    private $fac;

    public function __construct(EntityManagerInterface $em, UserPasswordEncoderInterface $encoder, EncoderFactoryInterface $fac)
    {
        $this->em = $em;
        $this->encoder = $encoder;
        $this->fac = $fac;
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

        if ($arg1) {
            $io->note(sprintf('You passed an argument: %s', $arg1));
            $passwd = $arg1;
        }

        if ($input->getOption('option1')) {
            // ...
        }

        $user = $this->em->getRepository(User::class)->find(76);


        if ($this->encoder->isPasswordValid($user, $passwd)) {
            $io->success('yes');
        }
        else {
            $io->success('no');
        }

        $pass = '$argon2id$v=19$m=65536,t=4,p=1$XGi/6fIzAaIa3c5xCn7pgw$KI30RjzwlyWJTz7hFiP8a/hfC1wBdQQt5T+oh5IUMGA';
        if ($this->fac->getEncoder(new User())->isPasswordValid($pass, $passwd, null)) {
            $io->success('yes');
        }
        else {
            $io->success('no');
        }

        return Command::SUCCESS;
    }
}
