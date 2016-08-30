<?php
    /**
     * Created by PhpStorm.
     * User: alina
     * Date: 23.08.16
     * Time: 15:36
     */

    namespace Gismo\TutorialBasic1\Plugin\Core\Contact;

    use Gismo\Component\Application\Container\GoTemplate;
    use Gismo\Component\Application\Partial\GoListPartial;
    use Gismo\TutorialBasic1\Context\Homepage\HomepageContext;
    use Gismo\Component\Application\Context;
    use Gismo\Component\Application\Builder\Annotation\App\ContextInit;
    use Gismo\Component\Application\Builder\Annotation\App\Filter;
    use Gismo\Component\Application\Builder\Annotation\App\Action;
    use Gismo\Component\Application\Builder\Annotation\App\Route;



    class ContactCtrl {

        /**
         * @ContextInit()
         */
        public function init(HomepageContext $context) {
            $context->defineTemplate("template.contact.content", __DIR__ . "/tpl/template.contact.content.html");
        }


        /**
         * @Filter("template.mainLayout.navBarTop")
         * @param $§§input
         */
        public function filterNavBarTop(GoTemplate $§§input) {
            $§§input[1] = function ($§§parameters, Context $context) {
                $§§parameters["left"][$context["action.contact"]->link()] = "Contact";
                return $§§parameters;
            };
        }

        /**
         * @Action(bind="action.contact")
         * @Route("/contact", method="GET")
         */
        public function showContact(Context $context) {
            echo $context["template.mainLayout"](["content" => $context["template.contact.content"]()]);
        }

        /**
         * @Filter("action.home.content")
         */
        public function addHomeHeaderSection (GoListPartial $§§input) {
            $§§input[-2] = "template.contact.content";
        }

    }