<?php
/**
 * Created by WangQi.
 * All Rights Reserved
 * Time: 15:30
 */

ini_set('memory_limit', '1024M');
require __DIR__.'/vendor/autoload.php';

use Symfony\Component\Console\Application;
use Symfony\Component\Yaml\Yaml;

$arr = Yaml::parse(file_get_contents(__DIR__.DIRECTORY_SEPARATOR.'config.yml'));
$config = $arr['parameters'];

$application = new Application();
$application->add(new \Command\DemoCommand($config));

$application->run();





