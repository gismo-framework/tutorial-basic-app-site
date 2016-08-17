<?php
/**
 * Created by PhpStorm.
 * User: matthes
 * Date: 05.08.16
 * Time: 23:31
 */

    require __DIR__ . "/../vendor/autoload.php";
    require __DIR__ . "/../../gismo/vendor/autoload.php";

    ini_set("display_errors", 1);

    // Aktivieren der Html-Sauberen Exception Darstellung
    \Gismo\Component\PhpFoundation\Helper\ErrorHandler::UseHttpErrorHandler();

    // Request aus Environment bauen
    $request = \Gismo\Component\HttpFoundation\Request\RequestFactory::BuildFromEnv();

    // App Laden und ausführen.
    $app = new \Gismo\TutorialBasic1\App\HomepageApp();
    $app->run($request);
