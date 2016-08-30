<?php
    /**
     * Created by PhpStorm.
     * User: alina
     * Date: 25.08.16
     * Time: 10:44
     */

    namespace Gismo\TutorialBasic1\Plugin\Core\ProdList;

    use Gismo\Component\Application\Context;
    use Gismo\Component\Plugin\Plugin;
    use Gismo\TutorialBasic1\Context\Homepage\HomepageContext;

    class ProdListPlugin implements Plugin {

        public function onContextInit(Context $context) {
            if ($context instanceof HomepageContext) {
                $context->provideClass(ProdListCtrl::class);
            }
        }
    }