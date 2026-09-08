<style>
    /* =========================================
       SIDEBAR - PRO DAWG DESIGN
    ========================================= */

    .sidebar {
        position: fixed;
        top: 0;
        left: 0;

        width: 82px;
        height: 100vh;

        padding: 16px 10px;

        z-index: 9999;

        box-sizing: border-box;
        overflow: hidden;

        background:
            linear-gradient(180deg,
                rgba(15, 23, 42, 0.98),
                rgba(2, 6, 23, 0.99));

        border-right:
            1px solid rgba(255, 255, 255, 0.08);

        box-shadow:
            8px 0 35px rgba(0, 0, 0, 0.3);

        backdrop-filter: blur(20px);

        transition:
            width 0.35s ease;
    }


    /* =========================================
       BACKGROUND GLOW
    ========================================= */

    .sidebar::before {
        content: "";

        position: absolute;

        top: -100px;
        left: -100px;

        width: 250px;
        height: 250px;

        border-radius: 50%;

        background:
            rgba(6, 182, 212, 0.12);

        filter: blur(80px);

        pointer-events: none;
    }


    /* =========================================
       EXPAND ON HOVER
    ========================================= */

    .sidebar:hover {
        width: 280px;
    }


    /* =========================================
       HEADER
    ========================================= */

    .sidebar-header {
        position: relative;

        display: flex;
        align-items: center;

        gap: 15px;

        height: 58px;

        padding: 0 14px;

        margin-bottom: 20px;

        border-radius: 16px;

        white-space: nowrap;

        background:
            linear-gradient(135deg,
                rgba(6, 182, 212, 0.12),
                rgba(124, 58, 237, 0.08));

        border:
            1px solid rgba(255, 255, 255, 0.08);
    }


    .sidebar-header i {
        display: flex;

        align-items: center;
        justify-content: center;

        min-width: 42px;
        width: 42px;
        height: 42px;

        border-radius: 13px;

        color: #67e8f9;

        font-size: 23px;

        background:
            rgba(6, 182, 212, 0.15);

        box-shadow:
            0 0 20px rgba(6, 182, 212, 0.1);
    }


    /* =========================================
       HEADER TEXT
    ========================================= */

    .sidebar-header span {
        opacity: 0;

        transform:
            translateX(-12px);

        transition:
            opacity 0.25s ease,
            transform 0.25s ease;

        color: white;

        font-size: 14px;
        font-weight: bold;

        letter-spacing: 2px;
    }


    .sidebar:hover .sidebar-header span {
        opacity: 1;

        transform:
            translateX(0);
    }


    /* =========================================
       MENU
    ========================================= */

    .sidebar-menu {
        position: relative;

        list-style: none;

        padding: 0;
        margin: 0;

        width: 100%;
    }


    .sidebar-menu li {
        list-style: none;

        width: 100%;

        margin-bottom: 8px;
    }


    /* =========================================
       SIDEBAR LINKS
    ========================================= */

    .sidebar-link {
        display: flex !important;

        align-items: center;

        gap: 16px;

        width: 100%;
        height: 56px;

        padding: 0 14px;

        box-sizing: border-box;

        border-radius: 14px;

        color: #94a3b8 !important;

        text-decoration: none !important;

        white-space: nowrap;

        overflow: hidden;

        background:
            rgba(255, 255, 255, 0.02);

        border:
            1px solid transparent;

        transition:
            background 0.25s ease,
            color 0.25s ease,
            border 0.25s ease;
    }


    /* =========================================
       ICON CONTAINER
    ========================================= */

    .sidebar-link i {
        display: flex;

        align-items: center;
        justify-content: center;

        min-width: 42px;
        width: 42px;
        height: 42px;

        border-radius: 12px;

        font-size: 21px;

        color: #67e8f9;

        background:
            rgba(6, 182, 212, 0.08);

        transition:
            background 0.25s ease,
            color 0.25s ease;
    }


    /* =========================================
       BUTTON TEXT
    ========================================= */

    .sidebar-link span {
        opacity: 0;

        transform:
            translateX(-15px);

        transition:
            opacity 0.25s ease,
            transform 0.25s ease;

        pointer-events: none;

        font-size: 15px;
        font-weight: 500;
    }


    .sidebar:hover .sidebar-link span {
        opacity: 1;

        transform:
            translateX(0);
    }


    /* =========================================
       NORMAL LINK HOVER
    ========================================= */

    .sidebar-link:hover {
        color: white !important;

        background:
            rgba(255, 255, 255, 0.06);

        border:
            1px solid rgba(6, 182, 212, 0.15);
    }


    .sidebar-link:hover i {
        background:
            rgba(6, 182, 212, 0.18);
    }


    /* =========================================
       ACTIVE LINK
    ========================================= */

    .sidebar-link.active {
        color: white !important;

        background:
            linear-gradient(135deg,
                rgba(6, 182, 212, 0.3),
                rgba(37, 99, 235, 0.3),
                rgba(124, 58, 237, 0.25));

        border:
            1px solid rgba(34, 211, 238, 0.3);

        box-shadow:
            0 8px 25px rgba(6, 182, 212, 0.12);
    }


    .sidebar-link.active i {
        color: white;

        background:
            linear-gradient(135deg,
                #06b6d4,
                #2563eb);

        box-shadow:
            0 5px 18px rgba(6, 182, 212, 0.3);
    }


    /* =========================================
       DIVIDER
    ========================================= */

    .sidebar-divider {
        height: 1px;

        margin: 16px 8px !important;

        background:
            linear-gradient(90deg,
                transparent,
                rgba(255, 255, 255, 0.15),
                transparent);
    }


    /* =========================================
       LOGOUT
    ========================================= */

    .sidebar-menu form {
        margin: 0;

        width: 100%;
    }


    .sidebar-logout {
        display: flex;

        align-items: center;

        gap: 16px;

        width: 100%;
        height: 56px;

        padding: 0 14px;

        border: none;

        border-radius: 14px;

        background:
            rgba(239, 68, 68, 0.03);

        color: #f87171;

        white-space: nowrap;

        overflow: hidden;

        cursor: pointer;

        box-sizing: border-box;

        transition:
            background 0.25s ease,
            color 0.25s ease;
    }


    .sidebar-logout i {
        display: flex;

        align-items: center;
        justify-content: center;

        min-width: 42px;
        width: 42px;
        height: 42px;

        border-radius: 12px;

        font-size: 21px;

        color: #f87171;

        background:
            rgba(239, 68, 68, 0.1);
    }


    .sidebar-logout span {
        opacity: 0;

        transform:
            translateX(-15px);

        transition:
            opacity 0.25s ease,
            transform 0.25s ease;

        font-size: 15px;
        font-weight: 500;
    }


    .sidebar:hover .sidebar-logout span {
        opacity: 1;

        transform:
            translateX(0);
    }


    .sidebar-logout:hover {
        background:
            rgba(239, 68, 68, 0.12);

        color: #fca5a5;
    }


    /* =========================================
       MAIN CONTENT
    ========================================= */

    .main-content {
        margin-left: 82px;

        min-height: 100vh;

        padding: 25px;

        box-sizing: border-box;

        transition:
            margin-left 0.35s ease;
    }


    /* IMPORTANT:
       Keep content positioned correctly when
       sidebar expands.
    */

    .sidebar:hover~.main-content {
        margin-left: 280px;
    }


    /* =========================================
       MOBILE
    ========================================= */

    @media (max-width: 768px) {

        .sidebar {
            width: 72px;
        }


        .sidebar:hover {
            width: 250px;
        }


        .main-content {
            margin-left: 72px;

            padding: 15px;
        }


        .sidebar:hover~.main-content {
            margin-left: 72px;
        }

    }
</style>


<div class="sidebar">

    {{-- HEADER --}}
    <div class="sidebar-header">

        <i class="material-icons">
            dashboard
        </i>

        <span>
            PRO DAWG
        </span>

    </div>


    <ul class="sidebar-menu">

        {{-- DASHBOARD --}}
        <li>

            <a href="#" class="sidebar-link active">

                <i class="material-icons">
                    home
                </i>

                <span>
                    Dashboard
                </span>

            </a>

        </li>


        {{-- USERS --}}
        <li>

            <a href="#" class="sidebar-link">

                <i class="material-icons">
                    group
                </i>

                <span>
                    Users
                </span>

            </a>

        </li>


        {{-- PROFILE --}}
        <li>

            <a href="#" class="sidebar-link">

                <i class="material-icons">
                    person
                </i>

                <span>
                    Profile
                </span>

            </a>

        </li>


        {{-- SETTINGS --}}
        <li>

            <a href="#" class="sidebar-link">

                <i class="material-icons">
                    settings
                </i>

                <span>
                    Settings
                </span>

            </a>

        </li>

        <li>
            <a href="{{ route('user.clash-of-clan') }}" class="sidebar-link">
                <i class="material-icons">
                    sports_esports
                </i>
                <span>
                    Clash of Clans
                </span>
            </a>
        </li>



        {{-- DIVIDER --}}
        <li class="sidebar-divider"></li>


        {{-- LOGOUT --}}
        <li>

            <form method="POST" action="{{ route('logout') }}">

                @csrf

                <button type="submit" class="sidebar-logout">

                    <i class="material-icons">
                        logout
                    </i>

                    <span>
                        Logout
                    </span>

                </button>

            </form>

        </li>

    </ul>

</div>
