<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Storage;
    use Polaris\Entities\Albums;
    use Polaris\Exceptions\SpotifyAuthException;
    use Polaris\SpotifyApi;

    class ListAlbumsControllers extends Controller
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
         * @param  Request  $request
         * @return Albums|null
         * @throws SpotifyAuthException
         */
        public function __invoke(Request $request): ?Albums
        {
            // $albums = json_decode(Storage::disk('public')->get('albums_2019-08-29.json'));

            $albums         = $this->client->albums($request->get('url'));
            $albumsFilename = sprintf('albums_%s.json', date('Y-m-d'));

            // Save albums response.
            Storage::disk('public')->put($albumsFilename, $albums->toJson());

            return $albums;
        }
    }
