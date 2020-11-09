<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use Polaris\Entities\Collections\TracksCollection;
    use Polaris\SpotifyApi;

    class ListAlbumTracks extends Controller
    {
        /**
         * @var SpotifyApi
         */
        protected $client;

        /**
         * ListAlbumTracks constructor.
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
         * @return TracksCollection
         */
        public function __invoke($id, Request $request)
        {
            return $this->client->tracks($id);
        }
    }
