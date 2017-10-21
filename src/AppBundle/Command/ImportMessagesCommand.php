<?php

namespace AppBundle\Command;

use \AppBundle\Services\MessagesImportService;
use Doctrine\DBAL\Exception\InvalidArgumentException;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ImportMessagesCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('app:import:messages')
            ->setDescription('Import messages from a JSON file.')
            ->addArgument('file', InputArgument::REQUIRED, 'JSON file with messages.')
        ;
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|null|void
     *
     * @throws InvalidArgumentException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $filename = $input->getArgument('file');

        if (strpos($filename, '.json') === false) {
            throw new InvalidArgumentException('Invalid file. Please provide valid json file only.');
        }

        /** @var MessagesImportService $importer */
        $importer = $this->getContainer()->get('messages.importer');

        $total = $importer->import($filename);

        $output->writeln("Successfully imported ${total} messages.");
    }

}
