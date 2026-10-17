@extends('users.layout.layout')

@section('title', 'Home')

@section('script')

@endsection

@section('content')
    <div class="w-full h-full">
        @include('users.partials.users.navbar')
        @include('users.partials.users.sidebar')
        @include('users.friends.main')
        @include('users.partials.users.rightpane')
    </div>
@endsection
