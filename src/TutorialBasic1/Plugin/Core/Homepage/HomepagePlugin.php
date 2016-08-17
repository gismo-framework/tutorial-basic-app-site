<?php
    /**
     * Created by PhpStorm.
     * User: matthes
     * Date: 16.08.16
     * Time: 09:54
     */

    namespace Gismo\TutorialBasic1\Plugin\Core\Homepage;


    use Gismo\Component\Application\Context;
    use Gismo\Component\Di\DiCallChain;
    use Gismo\Component\HttpFoundation\Request\Request;
    use Gismo\Component\Partial\Page;
    use Gismo\Component\Plugin\Plugin;
    use Gismo\TutorialBasic1\Context\Homepage\HomepageContext;

    class HomepagePlugin implements Plugin {


        public function onContextInit(Context $context) {
            if ($context instanceof HomepageContext) {

               $context->provideClass(HomepageCtrl::class);

            }
        }
    }