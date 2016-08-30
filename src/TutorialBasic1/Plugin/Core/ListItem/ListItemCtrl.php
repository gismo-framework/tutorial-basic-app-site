<?php
    /**
     * Created by PhpStorm.
     * User: alina
     * Date: 25.08.16
     * Time: 09:37
     */

    namespace Gismo\TutorialBasic1\Plugin\Core\ListItem;

    use Gismo\Component\Application\Builder\Annotation\App\Action;
    use Gismo\Component\Application\Builder\Annotation\App\ContextInit;
    use Gismo\Component\Application\Builder\Annotation\App\Filter;
    use Gismo\Component\Application\Builder\Annotation\App\Route;
    use Gismo\Component\Application\Context;
    use Gismo\Component\Application\Partial\GoListPartial;
    use Gismo\TutorialBasic1\Context\Homepage\HomepageContext;

    class ListItemCtrl {

        /**
         * @ContextInit()
         */
        public function init(HomepageContext $context) {
            $context->definePartial("action.listItem.content");
            $context->defineTemplate("template.listItem.content", __DIR__ . "/tpl/template.listItem.content.html");
        }

        /**
         * @Filter("action.prodList.content")
         * @param GoListPartial $§§input
         */
        public function addListItem(GoListPartial $§§input) {
            $§§input[5] = "template.listItem.content";
        }

        /**
         * @Action(bind="action.listItem")
         * @Route("/listItem", method="GET")
         * @param Context $context
         */
        public function showPartial(Context $context) {
            echo $context["template.mainLayout"](["content" => $context["action.listItem.content"]()]);
        }
    }