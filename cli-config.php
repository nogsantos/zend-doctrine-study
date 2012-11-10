<?php
// Define path to application directory
defined('APPLICATION_PATH')
|| define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/application'));

// Ensure library/ is on include_path
set_include_path(implode(PATH_SEPARATOR, array(
			realpath(APPLICATION_PATH . '/../library'),
			get_include_path(),
		)
	)
);

require_once 'Zend/Loader/Autoloader.php';
Zend_Loader_Autoloader::getInstance();

require_once 'application/Bootstrap.php';
$bootstrap = new Bootstrap(new Zend_Application(null,null));
$bootstrap->_initDoctrine();
$helperSet = new \Symfony\Component\Console\Helper\HelperSet(
    array(
    'em' => new \Doctrine\ORM\Tools\Console\Helper\EntityManagerHelper($bootstrap->getEntityManager()
    )
));
