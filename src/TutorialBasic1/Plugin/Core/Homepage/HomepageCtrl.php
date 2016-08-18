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
    use Gismo\Component\Application\Builder\Annotation\App\Filter;
    use Gismo\Component\Application\Builder\Annotation\App\Parameter;
    use Gismo\Component\Application\Builder\Annotation\App\Parameters;
    use Gismo\Component\Application\Builder\Annotation\App\Route;
    use Gismo\Component\Application\Context;
    use Gismo\Component\Route\GoAction;

    class HomepageCtrl {

        /**
         * @Filter("some.action")
         * @param $§§input
         */
        public function filterMainAction ($§§input) {
            echo "Filter!";
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
            echo "Hallo '{$di["api.bestFriend.getName"](["id"=>"Uncle Bob"])}' some<br>";
        }

    }