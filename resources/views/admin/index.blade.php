@extends('admin.layout.layout')

@section('title', 'Admin Dashboard')

@section('script')

@endsection

@section('content')

@include('admin.partials.navbar')

<div style="
        display: flex;
        width: 100%;
        min-height: calc(100vh - 64px);
        margin: 0;
        padding: 0;
        background: #f5f7fb;
        position: relative;
    ">

    <!-- SIDEBAR -->
    <aside style="
            width: 250px;
            min-width: 250px;
            height: calc(100vh - 64px);
            background: #111827;
            flex-shrink: 0;
            position: fixed;
            top: 64px;
            left: 0;
            z-index: 100;
            overflow-y: auto;
            overflow-x: hidden;
            box-sizing: border-box;
        ">
        @include('admin.partials.sidebar')
    </aside>


    <!-- MAIN CONTENT -->
    <main style="
            width: calc(100% - 250px);
            min-height: calc(100vh - 64px);
            margin-left: 250px;
            padding: 30px;
            box-sizing: border-box;
            overflow-x: hidden;
        ">

        @include('admin.layout.all_notif')

        <div style="
                background: #ffffff;
                border-radius: 16px;
                padding: 25px 30px;
                margin-top: 20px;
                border: 1px solid #e5e7eb;
                box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            ">
            <h1 style="
                    margin: 0;
                    color: #111827;
                    font-size: 28px;
                    font-weight: 700;
                ">
                Welcome!!
            </h1>
        </div>

        @if (auth()->user()->is_new == true)

        <div style="
                    width: 100%;
                    max-width: 800px;
                    margin: 30px auto 0;
                ">
            <div style="
                        background: #ffffff;
                        border-radius: 16px;
                        padding: 30px;
                        border: 1px solid #e5e7eb;
                        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
                    ">
                <livewire:settings.change-password>
            </div>
        </div>

        @endif

    </main>

</div>


@endsection
