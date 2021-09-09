<?php

namespace App\Command;

use App\Service\Mqtt\Mqtt;
use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class StartSubscribeCommand
 * @package App\Command
 */
class StartSubscribeCommand extends Command
{

    /**
     * @var Mqtt
     */
    private $mqtt;

    /**
     * @var LoggerInterface
     */
    public $logger;

    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * StartSubscribeCommand constructor.
     * @param Mqtt $mqtt
     * @param LoggerInterface $logger
     * @param ContainerInterface $container
     */
    public function __construct(Mqtt $mqtt, LoggerInterface $logger, ContainerInterface $container)
    {
        $this->mqtt = $mqtt;
        $this->logger = $logger;
        $this->container = $container;
        parent::__construct();
    }

    /**
     *
     */
    protected function configure()
    {
        $this->setName('app:startSubscribe')->setDescription('Inicia servicio MQTT subscribe');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln([
            'StartSubscribe',
            '==============',
            '',
        ]);

        $this->mqtt->subscribe();

        $output->writeln([
            'The End',
            '',
        ]);

        return 0;
    }
}
