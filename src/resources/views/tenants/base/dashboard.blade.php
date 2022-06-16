@extends('layouts.themes.tabler.tabler')

@section('head_js')

@endsection


@section('body_content_main')

    @include('modules-lms-base::navigation',['type' => 'tenant'])
    <div class="container p-5">
       Dashboard
    </div>

@endsection

@section('body_js')

    {{--    <script src="{{ asset('js/app.js') }}"></script>--}}
@endsection


