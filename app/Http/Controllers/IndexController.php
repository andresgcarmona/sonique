<?php

    namespace App\Http\Controllers;

    use Illuminate\Contracts\Foundation\Application;
    use Illuminate\Contracts\View\Factory;
    use Illuminate\Http\Request;
    use Illuminate\Http\Response;
    use Illuminate\Support\Facades\Cookie;
    use Illuminate\View\View;
    use JavaScript;

    class IndexController extends Controller
    {
        public function __construct()
        {
            $this->middleware('auth');
        }

        /**
         * Handle the incoming request.
         *
         * @param  Request  $request
         * @return Application|Factory|Response|View
         */
        public function __invoke(Request $request)
        {
            $apiToken = Cookie::get('api_token');
            $user     = user();

            JavaScript::put([
                'api_token'    => $apiToken,
                'access_token' => $user->access_token,
            ]);

            return view('index', compact('apiToken'));
        }
    }
