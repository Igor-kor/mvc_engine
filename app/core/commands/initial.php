<?php
/**
 * Created by PhpStorm.
 * User: игорь
 * Date: 02.07.2018
 * Time: 11:34
 */

namespace App\Core\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class Initial extends Command
{
    protected function configure()
    {
        $this->setName('init')
            ->setDescription('creating file settings')
            ->addArgument('owner-class', InputArgument::OPTIONAL, 'The owner entity name.')
            ->addArgument('association', InputArgument::OPTIONAL, 'The association collection name.')
            ->addArgument('owner-id', InputArgument::OPTIONAL, 'The owner identifier.')
            ->addOption('all', null, InputOption::VALUE_NONE, 'If defined, all entity regions will be deleted/invalidated.')
            ->addOption('flush', null, InputOption::VALUE_NONE, 'If defined, all cache entries will be flushed.')
            ->setHelp(<<<EOT
The <info>%command.name%</info> command is meant to clear a second-level cache collection regions for an associated Entity Manager.
It is possible to delete/invalidate all collection region, a specific collection region or flushes the cache provider.

The execution type differ on how you execute the command.
If you want to invalidate all entries for an collection region this command would do the work:

<info>%command.name% 'Entities\MyEntity' 'collectionName'</info>

To invalidate a specific entry you should use :

<info>%command.name% 'Entities\MyEntity' 'collectionName' 1</info>

If you want to invalidate all entries for the all collection regions:

<info>%command.name% --all</info>

Alternatively, if you want to flush the configured cache provider for an collection region use this command:

<info>%command.name% 'Entities\MyEntity' 'collectionName' --flush</info>

Finally, be aware that if <info>--flush</info> option is passed,
not all cache providers are able to flush entries, because of a limitation of its execution nature.
EOT
            );
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {

    }
}