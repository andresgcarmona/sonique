<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use Illuminate\Support\Collection;
    use Polaris\SpotifyApi;

    class ListUserDevicesController extends Controller
    {
        /**
         * ListPlaylistsController constructor.
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
         * @return Collection
         */
        public function __invoke(Request $request)
        {
            return $this->client->devices();
        }
    }
