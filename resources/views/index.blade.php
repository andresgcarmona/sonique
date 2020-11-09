@extends('layouts.main')

@section('title', __('Sonique'))

@section('main')
    <div class="page" id="app">
        <div class="page-inner mx-auto py-0">
            <div class="page-section">
                <div class="section-block">
                    <router-view></router-view>
                </div>
            </div>
        </div>
        <player ref="player"></player>
    </div>
@endsection

@section('scripts')
    @parent
    @mix('/js/app.js')
@endsection
