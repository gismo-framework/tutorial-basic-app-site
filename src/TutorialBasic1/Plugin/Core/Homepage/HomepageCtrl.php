<?php
    /**
     * Created by PhpStorm.
     * User: matthes
     * Date: 17.08.16
     * Time: 14:58
     */

    namespace Gismo\TutorialBasic1\Plugin\Core\Homepage;


    use Gismo\Component\Application\Builder\Annotation\App\Action;
    use Gismo\Component\Application\Builder\Annotation\App\Api;
    use Gismo\Component\Application\Builder\Annotation\App\ContextInit;
    use Gismo\Component\Application\Builder\Annotation\App\Filter;
    use Gismo\Component\Application\Builder\Annotation\App\Parameter;
    use Gismo\Component\Application\Builder\Annotation\App\Parameters;
    use Gismo\Component\Application\Builder\Annotation\App\Route;
    use Gismo\Component\Application\Container\GoAssetSet;
    use Gismo\Component\Application\Container\GoAssetSetList;
    use Gismo\Component\Application\Container\GoTemplate;
    use Gismo\Component\Application\Context;
    use Gismo\Component\Route\GoAction;
    use Gismo\TutorialBasic1\Context\Homepage\HomepageContext;

    class HomepageCtrl {


        /**
         * @ContextInit()
         */
        public function init(HomepageContext $context) {
            $context["template.mainLayout"] = $context->template(__DIR__ . "/Tpl/MainLayout.tpl.html", "template.mainLayout");
            $context["template.partial.navBarTop"] = $context->template(__DIR__ . "/Tpl/NavBarTop.partial.html", "template.partial.navBarTop");

            $context["assetSetList.css"] = $this->service(function () {
                return new GoAssetSetList("assetSetList.css", $this);
            });

            // Der eigenltiche Asset-Satz, der für diesen Controller integriert werden soll
            $context["assetSet.mainStyle.css"] = $this->service (function (){
                return (new GoAssetSet("assetSet.mainStyle.css", __DIR__ . "/assets"))->autoInclude("*.css");
            });


        }

        /**
         * @Filter("assetSetList.css")
         */
        public function addAssetSet (GoAssetSetList $list) {
            $list[1] = "assetSet.mainStyle.css"; // Nur als String anfügen
        }



        /**
         * @Filter("template.partial.navBarTop")
         * @param $§§input
         */
        public function filterNavBarTop (GoTemplate $§§input) {
            $§§input[1] = function ($§§parameters) {
                return ["left" => ["a"=>"b"]];
            };
        }

        /**
         * @Filter("some.action")
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
         * @Action(bind="some.action")
         * @Route("/", method="GET")
         */
        public function showMainSite (Context $di) {
            //echo "Hallo <a href='{$di["api.bestFriend.getName"]->link(["id"=>"Uncle Bob"])}'>click here</a> some<br>";
            echo $di["template.mainLayout"]();
        }

    }