<?php

    namespace App\Actions;

    use App\Models\User;
    use Exception;
    use Illuminate\Support\Facades\DB;
    use Illuminate\Support\Str;
    use Polaris\SpotifyApi;
    use Spatie\QueueableAction\QueueableAction;
    use stdClass;
    use Throwable;

    class UpdateUserAction
    {
        use QueueableAction;

        /**
         * CreateUserAction constructor.
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
         * @param  User  $user
         * @param  stdClass  $data
         * @return mixed
         * @throws Throwable
         */
        public function execute(User $user, stdClass $data)
        {
            try {
                DB::beginTransaction();

                $token = Str::random(60);

                $user->update([
                    'display_name'     => $data->display_name ?? null,
                    'username'         => $data->id,
                    'email'            => $data->email ?? null,
                    'password'         => Str::random(16),
                    'avatar'           => $data->images ? $data->images[0]->url : null,
                    'country'          => $data->country ?? null,
                    'href'             => $data->href ?? null,
                    'uri'              => $data->uri ?? null,
                    'access_token'     => $this->client->getAccountClient()->getAccessToken(),
                    'refresh_token'    => $this->client->getAccountClient()->getRefreshToken(),
                    'api_token'        => hash('sha256', $token),
                    'token_expires_at' => now()->addSeconds($this->client->getAccountClient()->getExpiresAt()),
                ]);

                DB::commit();

                return $user;
            } catch (Exception $exception) {
                DB::rollBack();

                throw_if(config('app.debug'), $exception);
            }
        }
    }
