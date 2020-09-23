<?php

    namespace App\Http\Controllers\Auth;

    use App\Http\Controllers\Controller;
    use Illuminate\Contracts\Foundation\Application;
    use Illuminate\Contracts\View\Factory;
    use Illuminate\Http\Request;
    use Illuminate\Http\Response;
    use Illuminate\View\View;

    class LoginController extends Controller
    {
        public function __construct()
        {
            $this->middleware('guest');
        }

        /**
         * Handle the incoming request.
         *
         * @param  Request  $request
         * @return Application|Factory|Response|View
         */
        public function __invoke(Request $request)
        {
            return view('auth.login');
        }
    }
