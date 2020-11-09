<?php

    namespace App\Http\Controllers;

    use Illuminate\Contracts\Foundation\Application;
    use Illuminate\Contracts\View\Factory;
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
         * @return Application|Factory|View
         */
        public function __invoke()
        {
            return view('auth.login');
        }
    }
