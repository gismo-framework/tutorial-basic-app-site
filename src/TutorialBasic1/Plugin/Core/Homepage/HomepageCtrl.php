<?php
    /**
     * Created by PhpStorm.
     * User: matthes
     * Date: 17.08.16
     * Time: 14:58
     */

    namespace Gismo\TutorialBasic1\Plugin\Core\Homepage;


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

    class HomepageCtrl {


        /**
         * @ContextInit()
         */
        public function init(HomepageContext $context) {
            $context->definePartial("action.home.content");
            $context->defineTemplate("template.homepage.content", __DIR__ . "/tpl/template.homepage.content.html");

            $context->defineAssetSet("assetSet.homepage.scss", __DIR__ . "/tpl", "*.scss", new GoScssAssetRenderer());
        }

        /**
         * @Filter("action.home.content")
         */
        public function addPapstToHomepage (GoListPartial $§§input) {
            $§§input[0] = "template.homepage.content";
        }

        /**
         * @Filter("assetSetList.css")
         */
        public function addCss (GoAssetSetList $§§input) {
            $§§input[0] = "assetSet.homepage.scss";
        }



        /**
         * @Filter("template.mainLayout.navBarTop")
         * @param $§§input
         */
        public function filterNavBarTop (GoTemplate $§§input) {
            $§§input[999] = function ($§§parameters, Context $context) {
                $§§parameters["left"][$context["action.home"]->link() ] = "Home";
                return $§§parameters;
            };
        }

        /**
         * @Filter("action.home")
         * @param $§§input
         */
        public function filterMainAction ($§§input) {
            $§§input[-10] = function () {
                echo "Overwritten!";
            };
        }


        /**
         * @Api("api.bestFriend.getName")
         * @Route("@@/:id", method="GET")
         * @Parameter("id", source="GET")
         * @Parameter("id2", source="ROUTE")
         *
         * @return string
         */
        public function getBestFriend (Context $context, $id) {
            echo "Wurst: " . $id;
            // Die Action speichert, wenn sie eine Route gesetzt hat, diese und stellt Link-Funktionen zur Verfügung. Genauso wie die Api.
            return "Me $id mit link: {$context["some.action"]->link(["id"=>"some OhterId"], ["aGetParameter"=>"someVal"])}";
        }


        /**
         * @Action(bind="action.home")
         * @Route("/home", method="GET")
         */
        public function showMainSite (Context $context) {
            //echo "Hallo <a href='{$di["api.bestFriend.getName"]->link(["id"=>"Uncle Bob"])}'>click here</a> some<br>";
            echo $context["template.mainLayout"](["content" => $context["action.home.content"]()]);
        }

    }