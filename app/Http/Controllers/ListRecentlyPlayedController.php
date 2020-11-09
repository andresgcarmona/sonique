<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Storage;
    use Polaris\Entities\RecentlyPlayed;
    use Polaris\Exceptions\SpotifyAuthException;
    use Polaris\SpotifyApi;

    class ListRecentlyPlayedController extends Controller
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
         * @return RecentlyPlayed|null
         * @throws SpotifyAuthException
         */
        public function __invoke(Request $request): ?RecentlyPlayed
        {
            $recentlyPlayed         = $this->client->recentlyPlayed();
            $recentlyPlayedFilename = sprintf('recently_played_%s.json', date('Y-m-d'));

            // Save recently played response.
            Storage::disk('public')->put($recentlyPlayedFilename, $recentlyPlayed->toJson());

            return $recentlyPlayed;
        }
    }
