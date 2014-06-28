<?php
function __($key, $params=array()) {
	return \Asgard\Container\Container::singleton()->get('translator')->trans($key, $params);
}

function d() {
	call_user_func_array(array('Asgard\Debug\Debug', 'dWithTrace'), array_merge([debug_backtrace()], func_get_args()));
}

require_once 'vendor/autoload.php';
foreach(spl_autoload_functions() as $function) {
	if(is_array($function) && $function[0] instanceof \Composer\Autoload\ClassLoader)
		$function[0]->setUseIncludePath(true);
}
set_include_path(get_include_path() . PATH_SEPARATOR . __DIR__.'/app');

#Bundles
$kernel = new \Asgard\Core\Kernel(__DIR__);
$kernel->addBundles(array(
	new \Asgard\Core\Bundle,
	new \Asgard\Data\Bundle,
	new \Asgard\Imagecache\Bundle,
	new \Admin\Bundle
));
$app = $kernel->getContainer();
$app['cache'] = new \Asgard\Cache\NullCache();
$kernel->load();

#DB
$app['config']->set('database', array(
	'host' => 'localhost',
	'user' => 'root',
	'password' => '',
	'database' => 'asgard'
));

#Translator
$app['translator'] = new \Symfony\Component\Translation\Translator('en', new \Symfony\Component\Translation\MessageSelector());

#Database
$app['schema']->dropAll();
$mm = new \Asgard\Migration\MigrationsManager(__DIR__.'/Migrations', $app);
$mm->migrateFile(__DIR__.'/Migrations/Admin.php');
$mm->migrateFile('vendor/asgard/data/Migrations/Data.php');