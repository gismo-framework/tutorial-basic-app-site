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

    \Gismo\Component\PhpFoundation\Helper\ErrorHandler::UseHttpErrorHandler();

    $request = \Gismo\Component\HttpFoundation\Request\RequestFactory::BuildFromEnv();

    $app = new \Gismo\TutorialBasic1\App\HomepageApp();
    $app->run($request);
