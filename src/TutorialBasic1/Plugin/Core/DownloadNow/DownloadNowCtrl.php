<?php
    /**
     * Created by PhpStorm.
     * User: matthes
     * Date: 17.08.16
     * Time: 14:58
     */

    namespace Gismo\TutorialBasic1\Plugin\Core\DownloadNow;


    use Gismo\Component\Application\Assets\Handler\GoCssAssetHandler;
    use Gismo\Component\Application\Assets\Renderer\GoCssAssetRenderer;
    use Gismo\Component\Application\Assets\Renderer\GoScssAssetRenderer;
    use Gismo\Component\Application\Builder\Annotation\App\Action;
    use Gismo\Component\Application\Builder\Annotation\App\Api;
    use Gismo\Component\Application\Builder\Annotation\App\ContextInit;
    use Gismo\Component\Application\Builder\Annotation\App\Filter;
    use Gismo\Component\Application\Builder\Annotation\App\Parameter;
    use Gismo\Component\Application\Builder\Annotation\App\Parameters;
    use Gismo\Component\Application\Builder\Annotation\App\Route;
    use Gismo\Component\Application\Assets\GoAssetSet;
    use Gismo\Component\Application\Assets\GoAssetSetList;
    use Gismo\Component\Application\Container\GoTemplate;
    use Gismo\Component\Application\Context;
    use Gismo\Component\Application\Partial\GoListPartial;
    use Gismo\Component\Route\GoAction;
    use Gismo\TutorialBasic1\Context\Homepage\HomepageContext;

    class DownloadNowCtrl {


        /**
         * @ContextInit()
         */
        public function init(HomepageContext $context) {
            $context->defineTemplate("template.downloadNow.header", __DIR__ . "/tpl/downloadNow.tpl.html");
            $context->defineTemplate("template.downloadNow.content", __DIR__ . "/tpl/downloadNow_content.tpl.html");
        }

        /**
         * @Filter("action.home.content")
         */
        public function addHomeHeaderSection (GoListPartial $§§input) {
            $§§input[999] = "template.downloadNow.header";
        }

        /**
         * @Filter("template.mainLayout.navBarTop")
         * @param $§§input
         */
        public function filterNavBarTop (GoTemplate $§§input) {
            $§§input[3] = function ($§§parameters, Context $context) {
                $§§parameters["left"][$context["action.downloadNow"]->link()] = "Download";
                return $§§parameters;

            };
        }


        /**
         * @Action(bind="action.downloadNow")
         * @Route("/download", method="GET")
         */
        public function showMainSite (Context $context) {
            //echo "Hallo <a href='{$di["api.bestFriend.getName"]->link(["id"=>"Uncle Bob"])}'>click here</a> some<br>";
            echo $context["template.mainLayout"](["content" => $context["template.downloadNow.content"]()]);
        }

    }