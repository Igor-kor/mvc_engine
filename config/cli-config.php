<?php
/**
 * Created by PhpStorm.
 * User: игорь
 * Date: 30.06.2018
 * Time: 14:46
 *
 * http://doctrine-orm.readthedocs.io/en/latest/reference/configuration.html#setting-up-the-commandline-tool
 */

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Console\ConsoleRunner;

require_once 'bootstrap.php';
//why false -> https://stackoverflow.com/questions/17473225/doctrine2-no-metadata-classes-to-process
$config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode, null, null, false);
$entityManager = EntityManager::create($dbParams, $config);
$helperSet = ConsoleRunner::createHelperSet($entityManager);
return $helperSet;