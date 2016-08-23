<?php
    /**
     * Created by PhpStorm.
     * User: matthes
     * Date: 16.08.16
     * Time: 09:52
     */


    namespace Gismo\TutorialBasic1\Layout\HomepageLayout;

    use Gismo\Component\Application\Assets\GoAssetSetList;
    use Gismo\Component\Application\Assets\Handler\GoCssAssetHandler;
    use Gismo\Component\Application\Assets\Renderer\GoCssAssetRenderer;
    use Gismo\Component\Application\Assets\Renderer\GoScssAssetRenderer;
    use Gismo\Component\Application\Context;
    use Gismo\Component\Plugin\Plugin;
    use Gismo\TutorialBasic1\Context\Homepage\HomepageContext;

    class HomepageLayoutPlugin implements Plugin  {

        public function onContextInit(Context $context)
        {
            if ($context instanceof HomepageContext) {
                $context->defineTemplate("template.mainLayout", __DIR__ . "/tpl/MainLayout.tpl.html");
                $context->defineTemplate("template.mainLayout.navBarTop", __DIR__ . "/tpl/NavBarTop.partial.html");

                // Hier können sich alle Plugins mit CSS AssetSets registrieren
                $context->defineAssetSetList("assetSetList.css", new GoCssAssetHandler());

                // Der eigenltiche Asset-Satz, der für diesen Controller integriert werden soll
                $context->defineAssetSet("assetSet.mainStyle.css", __DIR__ . "/tpl/assets/css", "*.css", new GoCssAssetRenderer());
                $context->defineAssetSet("assetSet.mainStyle.scss", __DIR__ . "/tpl/assets/scss", "*.scss", new GoScssAssetRenderer());

                // Verknüfen der AssetSets mit der AssetSetList
                $context["assetSetList.css"] = $context->filter(function (GoAssetSetList $§§input) {
                    $§§input[2] = "assetSet.mainStyle.css";
                    $§§input[1] = "assetSet.mainStyle.scss";
                });
            }
        }
    }