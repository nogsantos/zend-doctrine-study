<?php

use Doctrine\ORM\Tools\Setup,
	 Doctrine\ORM\EntityManager,
	 Doctrine\ORM\Configuration,
	 Doctrine\Common\Cache\ArrayCache as Cache,
	 Doctrine\Common\Annotations\AnnotationRegistry,
	 Doctrine\Common\ClassLoader;

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap{
  private $_entityManager = null;
  
  public function getEntityManager(){
    return $this->_entityManager;
  }
  
  public function _initDoctrine(){
    $conn = new Zend_Config_Ini(APPLICATION_PATH . '/configs/doctrine.ini');

    $config = new Configuration();
    $cache = new Cache();
    $config->setMetadataCacheImpl($cache);
    AnnotationRegistry::registerFile('Doctrine/ORM/Mapping/Driver/DoctrineAnnotations.php');
    $driver = new Doctrine\ORM\Mapping\Driver\AnnotationDriver(
        new Doctrine\Common\Annotations\AnnotationReader(),
        array(APPLICATION_PATH .  '/models/entities')
    );
    $config->setMetadataDriverImpl($driver);
    $config->setProxyDir(APPLICATION_PATH . '/models/entities/proxies');
    $config->setProxyNamespace('Application\Models\Proxies');
    $this->_entityManager = EntityManager::create($conn->toArray(), $config);
  }
  public function _initClassLoader(){
  	Zend_Loader_Autoloader::getInstance()->pushAutoloader(array($this, 'loadClass'),'Application\Models\Entities');
  }
  
  public function loadClass($className){
  	$className = str_replace('Application\\Models\\Entities\\', '', $className);
  	require APPLICATION_PATH . '/models/entities/' . $className . '.php';
  }
}