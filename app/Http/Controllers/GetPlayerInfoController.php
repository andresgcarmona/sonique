<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use Polaris\SpotifyApi;

    class GetPlayerInfoController extends Controller
    {
        /**
         * @var SpotifyApi
         */
        protected $client;

        /**
         * ListArtistAlbumsController constructor.
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
         * @param  \Illuminate\Http\Request  $request
         * @return \Illuminate\Http\Response
         */
        public function __invoke(Request $request)
        {
            return $this->client->player();
        }
    }
