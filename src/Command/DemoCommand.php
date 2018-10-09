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
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

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
        //$this->testPdoStatement($output);
        $this->testQueryBuilder();
        $output->writeln('ccc');
    }

    private function testQueryBuilder(){

        $isDevMode = true;
        $config = Setup::createAnnotationMetadataConfiguration(array(ROOT_PATH."/src/Entity"), $isDevMode);
        $entityManager = EntityManager::create($this->config['database'], $config);



        /*
        $queryBuilder = $this->conn->createQueryBuilder();
        $id=2;
        $q=$queryBuilder
            ->select('name', 'age')
            ->from('demo')
            ->where('id = ?')
            ->setParameter(0, $id)
            ->getQuery();

        $s=$queryBuilder->getSQL();
        //$r=$queryBuilder->execute();
        $r=$q->getResult();
        var_dump($r);
        */
    }


    private function testPdoStatement($output){
        //$this->conn->fetchColumn("SELECT count(*) FROM demo");
        /*
        $s=$this->conn->prepare(
            "INSERT INTO demo
                (
                    name,
                    age
                ) VALUES (
                    :name,
                    :age
                )"
        );
        $name='Kate';
        $age=16;
        $s->bindParam(":name", $name, \PDO::PARAM_STR);
        $s->bindParam(":age", $age, \PDO::PARAM_INT);
        $s->execute();
        $lastId=$this->conn->lastInsertId();
        */

    }





}