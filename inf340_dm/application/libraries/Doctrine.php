<?php
use Doctrine\Common\Cache\ApcCache;

use Doctrine\Common\ClassLoader,
Doctrine\ORM\Configuration,
Doctrine\ORM\EntityManager,
Doctrine\Common\Cache\ArrayCache,
Doctrine\DBAL\Logging\EchoSQLLogger;

class Doctrine {

	public $em = null;

	public function __construct()
	{
		// load database configuration from CodeIgniter
		require_once APPPATH.'config/database.php';

		// Set up class loading. You could use different autoloaders, provided by your favorite framework,
		// if you want to.
		require_once APPPATH.'libraries/Doctrine/Common/ClassLoader.php';

		$doctrineClassLoader = new ClassLoader('Doctrine',  APPPATH.'libraries');
		$doctrineClassLoader->register();
		$entitiesClassLoader = new ClassLoader('models', rtrim(APPPATH, "/" ));
		$entitiesClassLoader->register();
		$proxiesClassLoader = new ClassLoader('Proxies', APPPATH.'models/proxies');
		$proxiesClassLoader->register();

		// Set up caches
		$config = new Configuration;
		if (ENVIRONMENT == 'development')
				$cache = new ArrayCache;
		else
			$cache = new ApcCache();
		
		$config->setMetadataCacheImpl($cache);
		$driverImpl = $config->newDefaultAnnotationDriver(array(APPPATH.'models/Entities'));
		$config->setMetadataDriverImpl($driverImpl);
		$config->setQueryCacheImpl($cache);

		$config->setQueryCacheImpl($cache);

		// Proxy configuration
		$config->setProxyDir(APPPATH.'/models/proxies');
		$config->setProxyNamespace('Proxies');

		if (DEBUGGING){
		// Set up logger
		$logger = new EchoSQLLogger;
		$config->setSQLLogger($logger);
		}
		
		if (ENVIRONMENT == 'development')
			$config->setAutoGenerateProxyClasses( TRUE );
		else
			$config->setAutoGenerateProxyClasses( FALSE );

		// Database connection information
		$connectionOptions = array(
				'driver' => 'pdo_mysql',
				'user' =>     $db['default']['username'],
				'password' => $db['default']['password'],
				'host' =>     $db['default']['hostname'],
				'dbname' =>   $db['default']['database']
		);

		// Create EntityManager
		$this->em = EntityManager::create($connectionOptions, $config);
	}
}
