<?php
/**
 * Created by WangQi.
 * All Rights Reserved
 * Time: 15:30
 */
namespace Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Output\OutputInterface;

use Doctrine\DBAL\Configuration;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DriverManager;


/**
 * Class MigrateProCommand
 *
 * @package Command
 */
class DemoCommand extends Command
{
    
    private $config;
    private $conn;

    public function __construct($config)
    {
        $this->config=$config;
        parent::__construct();
    }

    /**
     * configure
     */
    protected function configure()
    {
        $this->setName(sprintf('%s:%s', 'demo', 'doctrine'))
            ->setDescription('PHP Doctrine test project');
    }

    protected function execute(InputInterface $input, OutputInterface $output){

        $t=$input->getArguments();
        $config = new Configuration();
        $this->conn = DriverManager::getConnection($this->config['database'], $config);
        $this->testDbal($output);
        $output->writeln('ccc');
    }

    private function testDbal($output){
        $t=$this->conn->fetchColumn("SELECT count(*) FROM demo");

        var_dump($t);
    }

}