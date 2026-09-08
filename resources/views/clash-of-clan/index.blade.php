@extends('users.layout.layout')

@section('title', 'Home')

@section('script')
    <link rel="stylesheet" href="{{ asset('css/reactions.css') }}">
    <link rel="stylesheet" href="{{ asset('css/comment.css') }}">
    <link rel="stylesheet" href="{{ asset('css/post.css') }}">
@endsection


@section('content')

<style>
    :root {
        --navbar-height: 70px;
        --left-sidebar-width: 220px;
        --right-sidebar-width: 360px;

        --primary: #06b6d4;
        --primary-blue: #2563eb;
        --purple: #7c3aed;

        --dark: #020617;
        --dark-secondary: #0f172a;

        --border: rgba(255, 255, 255, 0.08);
    }

    * {
        box-sizing: border-box;
    }

    html,
    body {
        margin: 0;
        padding: 0;
        width: 100%;
        min-height: 100%;
        overflow-x: hidden;

        background: var(--dark);

        font-family:
            Inter,
            system-ui,
            -apple-system,
            BlinkMacSystemFont,
            "Segoe UI",
            sans-serif;
    }


    /* =========================================
       APP BACKGROUND
    ========================================= */

    .app-layout {
        position: relative;

        width: 100%;
        min-height: 100vh;

        overflow-x: hidden;

        isolation: isolate;

        background:
            radial-gradient(
                circle at 15% 20%,
                rgba(6, 182, 212, 0.12),
                transparent 28%
            ),
            radial-gradient(
                circle at 85% 15%,
                rgba(124, 58, 237, 0.12),
                transparent 30%
            ),
            radial-gradient(
                circle at 50% 90%,
                rgba(37, 99, 235, 0.10),
                transparent 35%
            ),
            linear-gradient(
                135deg,
                #020617 0%,
                #0f172a 50%,
                #111827 100%
            );
    }


    /* =========================================
       AMBIENT GLOW
    ========================================= */

    .app-layout::before,
    .app-layout::after {
        content: "";

        position: fixed;

        width: 420px;
        height: 420px;

        border-radius: 50%;

        filter: blur(120px);

        pointer-events: none;

        z-index: -1;

        opacity: 0.55;
    }

    .app-layout::before {
        top: 120px;
        left: -180px;

        background: rgba(6, 182, 212, 0.22);
    }

    .app-layout::after {
        right: -180px;
        bottom: 50px;

        background: rgba(124, 58, 237, 0.20);
    }


    /* =========================================
       LEFT SIDEBAR
    ========================================= */

    .left-sidebar {
        position: fixed;

        top: var(--navbar-height);
        left: 0;

        width: var(--left-sidebar-width);

        height: calc(100vh - var(--navbar-height));

        z-index: 1000;

        overflow-y: auto;
        overflow-x: hidden;

        border-right: 1px solid var(--border);

        background:
            linear-gradient(
                180deg,
                rgba(15, 23, 42, 0.88),
                rgba(2, 6, 23, 0.94)
            );

        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);

        box-shadow:
            12px 0 40px rgba(0, 0, 0, 0.22);
    }


/* =========================================
   MAIN CONTENT - WIDER
========================================= */

.main-content {
    position: relative;

    min-height:
        calc(100vh - var(--navbar-height));

    /*
       No left sidebar space
       Main content starts from the left
    */
    margin-left: 0;

    /*
       Keep space for right sidebar
    */
    margin-right:
        var(--right-sidebar-width);

    /*
       Smaller padding = more usable space
    */
    padding:
        24px 30px 40px;

    width: auto;

    z-index: 1;

    transition:
        margin 0.35s ease,
        padding 0.35s ease;
}


/* =========================================
   WIDER POST CONTENT
========================================= */

.main-content > * {
    width: 100%;

    /*
       Increased from 850px
    */
    max-width: 1200px;

    margin-left: auto;
    margin-right: auto;
}

    /* =========================================
       RIGHT SIDEBAR
    ========================================= */

    .right-sidebar {
        position: fixed;

        top: var(--navbar-height);
        right: 0;

        width: var(--right-sidebar-width);

        height:
            calc(100vh - var(--navbar-height));

        z-index: 2000;

        padding: 16px 14px;

        overflow-y: auto;
        overflow-x: hidden;

        border-left:
            1px solid var(--border);

        background:
            linear-gradient(
                180deg,
                rgba(15, 23, 42, 0.92),
                rgba(2, 6, 23, 0.96)
            );

        backdrop-filter: blur(22px);
        -webkit-backdrop-filter: blur(22px);

        box-shadow:
            -12px 0 45px rgba(0, 0, 0, 0.28);

        transition:
            width 0.35s ease,
            transform 0.35s ease;
    }


    .right-sidebar::before {
        content: "";

        position: absolute;

        top: -120px;
        right: -100px;

        width: 280px;
        height: 280px;

        border-radius: 50%;

        background:
            rgba(6, 182, 212, 0.12);

        filter: blur(90px);

        pointer-events: none;
    }

    .right-sidebar > * {
        position: relative;
        z-index: 1;
    }


    /* =========================================
       COLLAPSED RIGHT SIDEBAR
    ========================================= */

    .right-sidebar.collapsed {
        width: 82px;
    }

    .app-layout.right-collapsed .main-content {
        margin-right: 82px;
    }


    /* =========================================
       SCROLLBAR
    ========================================= */

    .left-sidebar::-webkit-scrollbar,
    .right-sidebar::-webkit-scrollbar {
        width: 5px;
    }

    .left-sidebar::-webkit-scrollbar-thumb,
    .right-sidebar::-webkit-scrollbar-thumb {
        background:
            rgba(148, 163, 184, 0.30);

        border-radius: 20px;
    }


    /* =========================================
       OVERLAY
    ========================================= */

    .sidebar-overlay {
        position: fixed;

        inset: 0;

        z-index: 2500;

        opacity: 0;
        visibility: hidden;

        pointer-events: none;

        background:
            rgba(2, 6, 23, 0.65);

        backdrop-filter: blur(3px);

        transition:
            opacity 0.3s ease,
            visibility 0.3s ease;
    }

    .sidebar-overlay.active {
        opacity: 1;
        visibility: visible;

        pointer-events: auto;
    }


    /* =========================================
       LARGE LAPTOP
    ========================================= */

    @media (max-width: 1400px) {

        :root {
            --left-sidebar-width: 240px;
            --right-sidebar-width: 310px;
        }

        .main-content {
            padding: 24px 20px 35px;
        }
    }


    /* =========================================
       LAPTOP / TABLET
    ========================================= */

    @media (max-width: 1200px) {

        :root {
            --left-sidebar-width: 220px;
            --right-sidebar-width: 280px;
        }

        .main-content {
            padding: 20px 18px 30px;
        }
    }


    /* =========================================
       TABLET
    ========================================= */

    @media (max-width: 992px) {

        .left-sidebar {
            display: none;
        }

        .main-content {
            margin-left: 0;

            padding: 22px 20px 35px;
        }
    }


    /* =========================================
       MOBILE
    ========================================= */

    @media (max-width: 768px) {

        :root {
            --navbar-height: 60px;
        }

        .app-layout {
            min-height: 100dvh;
        }

        .left-sidebar {
            display: none;
        }

        .main-content {
            width: 100%;

            min-height:
                calc(100dvh - var(--navbar-height));

            margin-left: 0;
            margin-right: 0;

            padding: 16px 12px 30px;
        }

        .main-content > * {
            max-width: 100%;
        }


        /* MOBILE DRAWER */

        .right-sidebar {
            top: 0;
            right: 0;

            width:
                min(88vw, 360px);

            height: 100dvh;

            padding: 16px 12px;

            z-index: 3000;

            transform:
                translateX(105%);

            border-radius:
                24px 0 0 24px;

            transition:
                transform 0.35s cubic-bezier(
                    0.22,
                    1,
                    0.36,
                    1
                );
        }

        .right-sidebar.mobile-open {
            transform:
                translateX(0);
        }

        .right-sidebar.collapsed {
            width:
                min(88vw, 360px);
        }
    }


    /* =========================================
       SMALL MOBILE
    ========================================= */

    @media (max-width: 480px) {

        .main-content {
            padding: 12px 8px 25px;
        }

        .right-sidebar {
            width: 100%;

            border-radius: 0;

            padding: 12px 10px;
        }

        .app-layout::before,
        .app-layout::after {
            width: 250px;
            height: 250px;

            filter: blur(90px);
        }
    }

</style>


<div class="app-layout">

    {{-- NAVBAR --}}
    @include('users.partials.navbar')


    {{-- LEFT SIDEBAR --}}
    <aside class="left-sidebar">
        @include('users.partials.sidebar')
    </aside>


    {{-- MAIN CONTENT --}}
    <main class="main-content" id="mainContent">
        @include('clash-of-clan.main')
    </main>


    {{-- RIGHT SIDEBAR --}}
    <aside class="right-sidebar" id="rightSidebar">
        @include('users.partials.rightpane')
    </aside>


    {{-- MOBILE OVERLAY --}}
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

</div>


<script>
document.addEventListener('DOMContentLoaded', function () {

    const appLayout = document.querySelector('.app-layout');
    const sidebar = document.getElementById('rightSidebar');
    const toggle = document.getElementById('sidebarToggle');
    const overlay = document.getElementById('sidebarOverlay');
    const icon = document.getElementById('toggleIcon');

    if (!sidebar || !toggle) {
        return;
    }


    function updateIcon() {

        if (!icon) return;

        if (window.innerWidth <= 768) {

            icon.textContent =
                sidebar.classList.contains('mobile-open')
                    ? 'close'
                    : 'menu';

        } else {

            icon.textContent =
                sidebar.classList.contains('collapsed')
                    ? 'chevron_left'
                    : 'chevron_right';
        }
    }


    function closeMobileSidebar() {

        sidebar.classList.remove('mobile-open');

        if (overlay) {
            overlay.classList.remove('active');
        }

        updateIcon();
    }


    toggle.addEventListener('click', function () {

        /* MOBILE */

        if (window.innerWidth <= 768) {

            sidebar.classList.toggle('mobile-open');

            if (overlay) {
                overlay.classList.toggle(
                    'active',
                    sidebar.classList.contains('mobile-open')
                );
            }

        }

        /* DESKTOP */

        else {

            sidebar.classList.toggle('collapsed');

            if (appLayout) {
                appLayout.classList.toggle(
                    'right-collapsed',
                    sidebar.classList.contains('collapsed')
                );
            }
        }

        updateIcon();

    });


    /* CLOSE OVERLAY */

    if (overlay) {

        overlay.addEventListener('click', function () {
            closeMobileSidebar();
        });

    }


    /* RESET ON RESIZE */

    window.addEventListener('resize', function () {

        if (window.innerWidth > 768) {

            sidebar.classList.remove('mobile-open');

            if (overlay) {
                overlay.classList.remove('active');
            }
        }

        updateIcon();

    });


    updateIcon();

});
</script>

@endsection
