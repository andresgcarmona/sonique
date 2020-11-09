<?php

    namespace App\Http\Controllers\Auth;

    use App\Http\Controllers\Controller;
    use Illuminate\Http\RedirectResponse;
    use Illuminate\Http\Request;

    class LogoutUserController extends Controller
    {
        public function __construct()
        {
            $this->middleware('auth');
        }

        /**
         * Handle the incoming request.
         *
         * @param  Request  $request
         * @return RedirectResponse
         */
        public function __invoke(Request $request)
        {
            auth()->logout();

            return redirect()->route('login');
        }
    }
