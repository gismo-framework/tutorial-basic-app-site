<?php
/**
 * Created by PhpStorm.
 * User: matthes
 * Date: 05.08.16
 * Time: 23:31
 */

    namespace App;
    ini_set("display_errors", 1);

    use Gismo\Component\Config\AppConfig;
    use Gismo\Component\Config\ConfigLoader;
    use Gismo\Component\HttpFoundation\Request\RequestFactory;
    use Gismo\Component\PhpFoundation\Helper\ErrorHandler;

    require __DIR__ . "/../vendor/autoload.php";
    require __DIR__ . "/../../gismo/vendor/autoload.php";

    // Aktivieren der Html-Sauberen Exception Darstellung
    ErrorHandler::UseHttpErrorHandler();

    ConfigLoader::FromFile(
        __DIR__ . "/../app.ini.dist",
        ConfigLoader::DEVELOPMENT,
        $config = new AppConfig()
    );

    // Request aus Environment bauen
    $request = RequestFactory::BuildFromEnv($config);

    // App Laden und ausführen.
    $app = new \Gismo\TutorialBasic1\App\HomepageApp($config);
    $app->run($request);
