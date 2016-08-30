<?php
    /**
     * Created by PhpStorm.
     * User: alina
     * Date: 24.08.16
     * Time: 14:45
     */

    use Gismo\Component\Di\DiContainer;

    require __DIR__ . "/../../../gismo/vendor/autoload.php";

    class Demo {

    }

    $di = new DiContainer();


    $di[Demo::class] = $di->filter(function ($§§input) {
        echo "\nFilter";
    });

    $di[Demo::class] = $di->factory(function () {
        echo "\nErzeuge Demo...";
        return new Demo();
    });

    $di(function (Demo $d){
       echo "\nDemo Parameter";
    });

    $di(function (Demo $d){
        echo "\nDemo Parameter";
    });