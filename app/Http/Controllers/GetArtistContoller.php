<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use Polaris\Entities\Artist;
    use Polaris\Exceptions\SpotifyAuthException;
    use Polaris\SpotifyApi;

    class GetArtistContoller extends Controller
    {
        /**
         * @var SpotifyApi
         */
        protected $client;

        /**
         * GetArtistContoller constructor.
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
         * @param $id
         * @param  Request  $request
         * @return Artist
         * @throws SpotifyAuthException
         */
        public function __invoke($id, Request $request)
        {
            return $this->client->artist($id);
        }
    }
