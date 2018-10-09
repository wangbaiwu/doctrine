<?php
/**
 * Created by WangQi.
 * All Rights Reserved
 * Time: 15:30
 */

ini_set('memory_limit', '1024M');
define('ROOT_PATH',__DIR__);

require ROOT_PATH . '/vendor/autoload.php';

use Symfony\Component\Console\Application;
use Symfony\Component\Yaml\Yaml;

//---doctrine start---
use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Doctrine\ORM\Tools\Setup;
//---doctrine end---

$arr = Yaml::parse(file_get_contents(__DIR__.DIRECTORY_SEPARATOR.'config.yml'));
$config = $arr['parameters'];
unset($srr);

//---doctrine start---
$commands = array();
$isDevMode = true;
$emConfig = Setup::createAnnotationMetadataConfiguration(array(ROOT_PATH."/src/Entity"), $isDevMode);
$entityManager = \Doctrine\ORM\EntityManager::create($config['database'], $emConfig);
$entityManager->getConnection()->getDatabasePlatform()->registerDoctrineTypeMapping('enum', 'string');
$helperSet=ConsoleRunner::createHelperSet($entityManager);
\Doctrine\ORM\Tools\Console\ConsoleRunner::run($helperSet, $commands);
uset($commands,$isDevMode,$emConfig,$entityManager,$helperSet);
//---doctrine end---

$application = new Application();
$application->add(new \Command\DemoCommand($config));
$application->run();
unset($config);