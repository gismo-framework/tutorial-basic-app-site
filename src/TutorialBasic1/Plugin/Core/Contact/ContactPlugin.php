<?php
    /**
     * Created by PhpStorm.
     * User: alina
     * Date: 23.08.16
     * Time: 15:36
     */
    namespace Gismo\TutorialBasic1\Plugin\Core\Contact;

    use Gismo\Component\Application\Context;
    use Gismo\Component\Plugin\Plugin;
    use Gismo\TutorialBasic1\Context\Homepage\HomepageContext;

    class ContactPlugin implements Plugin {


        public function onContextInit(Context $context) {
            if ($context instanceof HomepageContext) {
                $context->provideClass(ContactCtrl::class);
            }
        }

    }