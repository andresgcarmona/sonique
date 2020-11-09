<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use Polaris\Entities\Track;
    use Polaris\Exceptions\SpotifyAuthException;
    use Polaris\SpotifyApi;

    class GetTrackController extends Controller
    {
        /**
         * @var SpotifyApi
         */
        protected $client;

        /**
         * GetTrackController constructor.
         *
         * @param  SpotifyApi  $client
         */
        public function __construct(SpotifyApi $client)
        {
            $this->client = $client;
        }

        /**
         * Handle the incoming request.
         *
         * @param  Request  $request
         * @return Track
         * @throws SpotifyAuthException
         */
        public function __invoke($id, Request $request)
        {
            return $this->client->track($id);
        }
    }
