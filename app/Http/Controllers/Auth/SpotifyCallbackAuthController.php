<?php

    namespace App\Http\Controllers\Auth;

    use App\Actions\CreateUserAction;
    use App\Actions\UpdateUserAction;
    use App\Http\Controllers\Controller;
    use App\Models\User;
    use Exception;
    use Illuminate\Http\RedirectResponse;
    use Illuminate\Http\Request;
    use Polaris\Exceptions\SpotifyAuthException;
    use Polaris\SpotifyApi;
    use Throwable;

    class SpotifyCallbackAuthController extends Controller
    {
        protected const STATE_COOKIE_NAME = 'state_cookie';

        /**
         * @var SpotifyApi
         */
        private $client;

        /**
         * SpotifyCallbackAuthController constructor.
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
         * @param  CreateUserAction  $createUserAction
         * @param  UpdateUserAction  $updateUserAction
         * @return RedirectResponse
         * @throws Throwable
         */
        public function __invoke(
            Request $request,
            CreateUserAction $createUserAction,
            UpdateUserAction $updateUserAction
        ) {
            $error = $request->get('error');
            $code  = $request->get('code');
            $state = $request->get('state');

            $user = null;

            $cookieState = $request->cookie(self::STATE_COOKIE_NAME);

            try {
                if ($cookieState && $cookieState !== $state) {
                    throw new SpotifyAuthException('Invalid state parameter.');
                }

                // The user rejected the permissions or something went wrong.
                if ($error) {
                    return redirect()->route('login')
                                     ->withErrors(['error' => $error]);
                }

                // Get access token.
                $this->client->requestAccessToken($code);

                // Request Spotify's user information.
                $me = $this->client->me();

                // Verify if user has being created before.
                if (isset($me->email)) {
                    $user = User::whereEmail($me->email)->first();
                }

                // Create user.
                if (!$user) {
                    $user = $createUserAction->execute($me);
                } else {
                    $updateUserAction->execute($user, $me);
                }

                $user->fresh();

                // Finally log in and remember user.
                auth()->login($user, true);

                // Attach api token to redirect.
                return redirect()->route('index')
                                 ->withCookie('api_token', $user->api_token, config('session.lifetime'), '/');
            } catch (SpotifyAuthException $exception) {
                throw_if(config('app.debug'), $exception);
            } catch (Exception $exception) {
                throw_if(config('app.debug'), $exception);
            }
        }
    }
