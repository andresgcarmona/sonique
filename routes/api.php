<?php

    use App\Http\Controllers\GetAlbumController;
    use App\Http\Controllers\GetArtistContoller;
    use App\Http\Controllers\GetPlayerInfoController;
    use App\Http\Controllers\GetTrackController;
    use App\Http\Controllers\ListAlbumsControllers;
    use App\Http\Controllers\ListAlbumTracks;
    use App\Http\Controllers\ListArtistAlbumsController;
    use App\Http\Controllers\ListPlaylistsController;
    use App\Http\Controllers\ListRecentlyPlayedController;
    use App\Http\Controllers\ListUserDevicesController;
    use App\Http\Controllers\PauseTrackController;
    use App\Http\Controllers\PlayTrackController;
    use Illuminate\Support\Facades\Route;

    Route::middleware('auth:sanctum')
         ->group(static function ()
         {
             /**
              * Recently played.
              */
             Route::get('recently-played', ListRecentlyPlayedController::class);

             /**
              * Albums.
              */
             Route::get('albums', ListAlbumsControllers::class);
             Route::get('album/{id}', GetAlbumController::class);
             Route::get('album/{id}/tracks', ListAlbumTracks::class);

             /**
              * Devices
              */
             Route::get('devices', ListUserDevicesController::class);

             /**
              * Playlists.
              */
             Route::get('playlists', ListPlaylistsController::class);

             /**
              * Tracks.
              */
             Route::get('track/{id}', GetTrackController::class);

             /**
              * Artists.
              */
             Route::get('artist/{id}', GetArtistContoller::class);
             Route::get('artist/{id}/albums', ListArtistAlbumsController::class);

             /**
              * Player
              */
             Route::get('player/info', GetPlayerInfoController::class);
             Route::put('play', PlayTrackController::class);
             Route::put('pause', PauseTrackController::class);
         });
