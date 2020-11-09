<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\RedirectResponse;
    use Illuminate\Http\Request;
    use Illuminate\Support\Str;
    use Polaris\Exceptions\SpotifyAuthException;
    use Polaris\SpotifyApi;

    class LoginUserController extends Controller
    {
        protected const STATE_COOKIE_NAME     = 'state_cookie';
        protected const STATE_COOKIE_DURATION = 5; // Minutes.

        /**
         * @var SpotifyApi
         */
        private $client;

        /**
         * LoginController constructor.
         *
         * @param  SpotifyApi  $client
         */
        public function __construct(SpotifyApi $client)
        {
            $this->middleware('guest');

            $this->client = $client;
        }

        /**
         * Handle the incoming request.
         *
         * @param  Request  $request
         * @return RedirectResponse
         * @throws SpotifyAuthException
         */
        public function __invoke(Request $request)
        {
            $state = Str::random();

            cookie(self::STATE_COOKIE_NAME, $state, self::STATE_COOKIE_DURATION);

            return $this->client->requestAccessCode($state);
        }
    }
