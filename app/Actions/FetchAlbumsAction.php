<?php

    namespace App\Actions;

    use Exception;
    use Polaris\SpotifyApi;
    use Spatie\QueueableAction\QueueableAction;
    use Throwable;

    class FetchAlbumsAction
    {
        use QueueableAction;

        /**
         * @var SpotifyApi
         */
        private $client;

        /**
         * FetchAlbumsAction constructor.
         *
         * @param  SpotifyApi  $client
         */
        public function __construct(SpotifyApi $client)
        {
            $this->client = $client;
        }

        /**
         * Execute the action.
         *
         * @return mixed
         * @throws Throwable
         */
        public function execute()
        {
            $user = user();

            try {
                $albums = $this->client->albums();

                dump($albums->toArray());

                $albums->items->each(function ($album)
                {
                    dump($album->toArray());
                });
            } catch (Exception $exception) {
                throw_if(config('app.debug'), $exception);
            }
        }
    }
