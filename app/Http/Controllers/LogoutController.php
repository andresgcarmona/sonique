<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\RedirectResponse;

    class LogoutController extends Controller
    {
        /**
         * LogoutController constructor.
         */
        public function __construct()
        {
            $this->middleware('auth');
        }

        /**
         * Handle the incoming request.
         *
         * @return RedirectResponse
         */
        public function __invoke()
        {
            auth()->logout();

            return redirect()->route('login');
        }
    }
