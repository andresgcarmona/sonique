<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Storage;
    use Polaris\Entities\Playlist;
    use Polaris\Exceptions\SpotifyAuthException;
    use Polaris\SpotifyApi;

    class ListPlaylistsController extends Controller
    {
        /**
         * @var SpotifyApi
         */
        protected $client;

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
         * @return Playlist|null
         * @throws SpotifyAuthException
         */
        public function __invoke(Request $request): ?Playlist
        {
            // $playlists = json_decode(Storage::disk('public')->get('albums_2019-08-29.json'));

            $playlists         = $this->client->playlists();
            $playlistsFilename = sprintf('albums_%s.json', date('Y-m-d'));

            // Save playlists response.
            Storage::disk('public')->put($playlistsFilename, $playlists->toJson());

            return $playlists;
        }
    }
