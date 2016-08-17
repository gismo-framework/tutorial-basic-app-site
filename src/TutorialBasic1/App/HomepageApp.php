<?php
    /**
     * Created by PhpStorm.
     * User: matthes
     * Date: 16.08.16
     * Time: 10:27
     */



    namespace Gismo\TutorialBasic1\App;

    use Gismo\Component\HttpFoundation\Request\Request;
    use Gismo\Component\Plugin\App;
    use Gismo\Component\Route\Type\RouterRequest;
    use Gismo\TutorialBasic1\Context\Homepage\HomepageContext;
    use Gismo\TutorialBasic1\Plugin\Core\Homepage\HomepagePlugin;

    class HomepageApp implements App {


        /**
         * @var HomepageContext
         */
        private $mContext;

        public function __construct() {
            $this->mContext = $c = new HomepageContext();

            $p = new HomepagePlugin();
            $p->onContextInit($c);
        }


        public function run(Request $request) {
            $p = $this->mContext;
            $p[Request::class] = $p->constant($request);

            $routeRequest = RouterRequest::BuildFromRequest($request);
            $p->route->dispatch($routeRequest);
        }
    }