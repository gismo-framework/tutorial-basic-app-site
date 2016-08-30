<?php
    /**
     * Created by PhpStorm.
     * User: alina
     * Date: 25.08.16
     * Time: 10:44
     */

    namespace Gismo\TutorialBasic1\Plugin\Core\ProdList;

    use Gismo\Component\Application\Builder\Annotation\App\Action;
    use Gismo\Component\Application\Builder\Annotation\App\ContextInit;
    use Gismo\Component\Application\Builder\Annotation\App\Filter;
    use Gismo\Component\Application\Builder\Annotation\App\Route;
    use Gismo\Component\Application\Container\GoTemplate;
    use Gismo\Component\Application\Context;
    use Gismo\Component\Application\Partial\GoListPartial;
    use Gismo\TutorialBasic1\Context\Homepage\HomepageContext;

    class ProdListCtrl {

        /**
         * @ContextInit()
         * @param HomepageContext $context
         */
        public function init(HomepageContext $context) {
            $context->definePartial("action.prodList.content");
            $context->defineTemplate("template.prodList.content", __DIR__ . "/tpl/template.prodList.content.html");
        }

        /**
         * @Filter("template.mainLayout.navBarTop")
         * @param GoTemplate $§§input
         */
        public function filterNavBarTop(GoTemplate $§§input) {
            $§§input[2] = function ($§§parameters, Context $context) {
                $§§parameters["left"][$context["action.prodList"]->link()] = "Product List";
                return $§§parameters;
            };
        }

        /**
         * @Filter("action.prodList.content")
         * @param GoListPartial $§§input
         */
        public function filterHeaderToProdList(GoListPartial $§§input) {
            $§§input[999] = "template.prodList.content";
        }


        /**
         * @Action(bind="action.prodList")
         * @Route("/prodList", method="GET")
         * @param Context $context
         */
        public function showPartial(Context $context) {
            $prods = [
                    ["artNr" => "123",
                     "bez"   => "Stift",
                     "preis" => "1,79"],
                    ["artNr" => "456",
                     "bez"   => "Lineal",
                     "preis" => "2,50"],
                    ["artNr" => "789",
                     "bez"   => "Radiergummi",
                     "preis" => "0,89"]
            ];
            foreach ($prods as $prod) {

            }
            echo $context["template.mainLayout"](["content" => $context["action.prodList.content"]()]);
        }


    }