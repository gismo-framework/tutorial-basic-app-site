<?php
/**
 * Created by PhpStorm.
 * User: matthes
 * Date: 05.08.16
 * Time: 23:31
 */

    namespace App;

    use Gismo\Component\Config\AppConfig;
    use Gismo\Component\Config\ConfigLoader;
    use Gismo\Component\HttpFoundation\Request\RequestFactory;

    require __DIR__ . "/../vendor/autoload.php";
    require __DIR__ . "/../../gismo/vendor/autoload.php";

    ini_set("display_errors", 1);

    // Aktivieren der Html-Sauberen Exception Darstellung
    \Gismo\Component\PhpFoundation\Helper\ErrorHandler::UseHttpErrorHandler();



    ConfigLoader::FromFile(__DIR__ . "/../app.ini.dist", ConfigLoader::DEVELOPMENT, $config = new AppConfig());

    // Request aus Environment bauen
    $request = RequestFactory::BuildFromEnv($config);

    // App Laden und ausführen.
    $app = new \Gismo\TutorialBasic1\App\HomepageApp();
    $app->run($request);
