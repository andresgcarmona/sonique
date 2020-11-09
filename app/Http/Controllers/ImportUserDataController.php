<?php

    namespace App\Http\Controllers;

    use App\Actions\FetchAlbumsAction;
    use Illuminate\Http\Request;
    use Throwable;

    class ImportUserDataController extends Controller
    {

        public function __construct()
        {
            $this->middleware('auth');
        }

        /**
         * Handle the incoming request.
         *
         * @param  FetchAlbumsAction  $fetchAlbumsAction
         * @param  Request  $request
         * @return void
         * @throws Throwable
         */
        public function __invoke(FetchAlbumsAction $fetchAlbumsAction, Request $request)
        {
            // Fetch user's information.
            // Fetch albums.
            $fetchAlbumsAction->execute();
        }
    }
