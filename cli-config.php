<?php

use Doctrine\ORM\Tools\Console\ConsoleRunner;

spl_autoload_register(static function ($class_name) {
    $dirs = array(
        __DIR__ . "\app\libraries",
    );
    foreach ($dirs as $dir) {
        $path = "$dir\\$class_name.php";
        if (!file_exists($path)) {
            continue;
        }
        require_once $path;
    }
});

require_once __DIR__. "/vendor/autoload.php";

require_once __DIR__ . '/app/config/config.php';

// replace with mechanism to retrieve EntityManager in your app
$entityManager = GetEntityManager();

return ConsoleRunner::createHelperSet($entityManager);