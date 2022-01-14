<?php

namespace App;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;

use App\WPCLI as WPCLI;
use App\DataSource as DataSource;

class WPBackupSource extends Command
{
    protected static $defaultName = 'backupsource';

    protected function configure(): void
    {
        //$this->addArgument('source', InputArgument::OPTIONAL, 'The source is required');
        $this->setDescription('Backup Source Files via CSV');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $datasource = new DataSource();
        $sources = $datasource->getSources();
    
        for($i=0; $i<count($sources); $i++){
            $output->writeln($sources[$i]);
            $wp = new WPCLI($sources[$i]);
            $wp->export();
            $output->writeln($sources[$i].' done');
            unset($wp);
        }
        return Command::SUCCESS;
    }
}
