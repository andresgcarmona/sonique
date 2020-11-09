<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use Polaris\Entities\Album;
    use Polaris\SpotifyApi;

    class GetAlbumController extends Controller
    {
        /**
         * @var SpotifyApi
         */
        protected $client;

        /**
         * ListAlbumsControllers constructor.
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
         * @return Album
         */
        public function __invoke($id, Request $request): Album
        {
            return $this->client->album($id);
        }
    }
