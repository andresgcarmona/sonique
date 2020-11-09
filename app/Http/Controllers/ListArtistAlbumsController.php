<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use Polaris\Entities\Albums;
    use Polaris\Exceptions\SpotifyAuthException;
    use Polaris\SpotifyApi;

    class ListArtistAlbumsController extends Controller
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
         * @param  Request  $request
         * @return Albums
         * @throws SpotifyAuthException
         */
        public function __invoke($id, Request $request)
        {
            return $this->client->artistAlbums($id);
        }
    }
