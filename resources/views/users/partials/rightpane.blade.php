<style>
    /* =========================================
       RIGHT SIDEBAR
    ========================================= */

    .right-sidebar {
        position: fixed;
        top: 0;
        right: 0;

        width: 390px;
        height: 100vh;

        z-index: 9999;

        padding: 16px;

        box-sizing: border-box;

        background:
            linear-gradient(180deg,
                rgba(15, 23, 42, 0.98),
                rgba(2, 6, 23, 0.99));

        border-left: 1px solid rgba(255, 255, 255, 0.1);

        box-shadow:
            -10px 0 40px rgba(0, 0, 0, 0.35);

        overflow-y: auto;
        overflow-x: hidden;

        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
    }


    /* =========================================
       BACKGROUND GLOW
    ========================================= */

    .right-sidebar::before {
        content: "";

        position: absolute;

        top: -100px;
        right: -100px;

        width: 250px;
        height: 250px;

        background: rgba(6, 182, 212, 0.12);

        border-radius: 50%;

        filter: blur(80px);

        pointer-events: none;
    }


    /* =========================================
       MENU
    ========================================= */

    .right-sidebar ul {
        position: relative;

        width: 100%;

        margin: 0;
        padding: 0;

        list-style: none;
    }


    .right-sidebar li {
        width: 100%;

        margin-bottom: 8px;

        list-style: none;
    }


    /* =========================================
       HEADER
    ========================================= */

    .sidebar-header {
        display: flex;

        align-items: center;

        gap: 12px;

        padding: 18px 16px;

        margin-bottom: 20px;

        border-radius: 18px;

        background:
            linear-gradient(135deg,
                rgba(6, 182, 212, 0.15),
                rgba(124, 58, 237, 0.12));

        border:
            1px solid rgba(255, 255, 255, 0.1);
    }


    .sidebar-header i {
        display: flex;

        align-items: center;
        justify-content: center;

        min-width: 42px;
        width: 42px;
        height: 42px;

        border-radius: 14px;

        color: #67e8f9;

        background:
            rgba(6, 182, 212, 0.15);

        font-size: 24px;
    }


    .sidebar-header-text {
        display: flex;

        flex-direction: column;

        min-width: 0;
    }


    .sidebar-header-text strong {
        color: white;

        font-size: 16px;

        letter-spacing: 0.5px;

        white-space: nowrap;
    }


    .sidebar-header-text small {
        margin-top: 3px;

        color: rgba(191, 219, 254, 0.55);

        font-size: 11px;

        letter-spacing: 1px;

        white-space: nowrap;
    }


    /* =========================================
       SECTION LABEL
    ========================================= */

    .sidebar-label {
        display: block;

        padding: 10px 16px;

        color: rgba(148, 163, 184, 0.6);

        font-size: 11px;

        font-weight: bold;

        letter-spacing: 1.5px;
    }


    /* =========================================
       NAVIGATION LINKS
    ========================================= */

    .right-sidebar .nav-link {
        width: 100%;

        display: flex;

        align-items: center;

        gap: 15px;

        padding: 14px 16px;

        box-sizing: border-box;

        border-radius: 14px;

        text-decoration: none !important;

        color: #94a3b8 !important;

        font-size: 15px;

        font-weight: 500;

        white-space: nowrap;

        background:
            rgba(255, 255, 255, 0.02);

        border:
            1px solid transparent;
    }


    /* =========================================
       ICON
    ========================================= */

    .right-sidebar .nav-link i {
        display: flex;

        align-items: center;
        justify-content: center;

        min-width: 38px;
        width: 38px;
        height: 38px;

        flex-shrink: 0;

        border-radius: 12px;

        color: #67e8f9;

        background:
            rgba(6, 182, 212, 0.1);

        font-size: 21px;
    }


    /* =========================================
       TEXT
    ========================================= */

    .right-sidebar .nav-link span {
        display: block !important;

        opacity: 1 !important;

        visibility: visible !important;

        color: inherit;

        white-space: nowrap;

        overflow: hidden;

        text-overflow: ellipsis;
    }


    /* =========================================
       ACTIVE LINK
    ========================================= */

    .right-sidebar .nav-link.active {
        color: white !important;

        background:
            linear-gradient(135deg,
                rgba(6, 182, 212, 0.2),
                rgba(37, 99, 235, 0.2),
                rgba(124, 58, 237, 0.15));

        border:
            1px solid rgba(34, 211, 238, 0.25);
    }


    .right-sidebar .nav-link.active i {
        color: white;

        background:
            linear-gradient(135deg,
                #06b6d4,
                #2563eb);
    }


    /* =========================================
       DIVIDER
    ========================================= */

    .sidebar-divider {
        height: 1px;

        margin: 18px 8px;

        background:
            rgba(255, 255, 255, 0.08);
    }


    /* =========================================
       MAIN CONTENT
    ========================================= */

    .main-content {
        margin-right: 390px;

        width: calc(100% - 390px);

        min-height: 100vh;

        box-sizing: border-box;
    }


    /* =========================================
       SCROLLBAR
    ========================================= */

    .right-sidebar::-webkit-scrollbar {
        width: 5px;
    }


    .right-sidebar::-webkit-scrollbar-thumb {
        background:
            rgba(148, 163, 184, 0.3);

        border-radius: 10px;
    }


    /* =========================================
       LARGE TABLET
    ========================================= */

    @media (max-width: 1200px) {

        .right-sidebar {
            width: 320px;
        }

        .main-content {
            margin-right: 320px;

            width: calc(100% - 320px);
        }

    }


    /* =========================================
       TABLET
    ========================================= */

    @media (max-width: 992px) {

        .right-sidebar {
            width: 280px;
        }

        .main-content {
            margin-right: 280px;

            width: calc(100% - 280px);
        }

        .right-sidebar {
            padding: 12px;
        }

    }


    /* =========================================
       MOBILE
       SIDEBAR BECOMES BOTTOM PANEL
    ========================================= */

    @media (max-width: 768px) {

        .right-sidebar {
            position: relative;

            width: 100%;

            height: auto;

            min-height: auto;

            right: auto;
            top: auto;

            padding: 14px;

            border-left: none;

            border-top:
                1px solid rgba(255, 255, 255, 0.1);

            box-shadow:
                0 -10px 40px rgba(0, 0, 0, 0.25);

            overflow: visible;
        }


        .right-sidebar::before {
            display: none;
        }


        .main-content {
            width: 100%;

            margin-right: 0;
        }


        .right-sidebar ul {
            display: grid;

            grid-template-columns:
                repeat(2, minmax(0, 1fr));

            gap: 8px;
        }


        .right-sidebar li {
            margin-bottom: 0;
        }


        /* Header takes full width */

        .right-sidebar li:first-child {
            grid-column: 1 / -1;
        }


        /* Labels take full width */

        .sidebar-label {
            padding: 8px;
        }


        .right-sidebar .nav-link {
            padding: 12px;

            gap: 10px;

            font-size: 14px;
        }


        .right-sidebar .nav-link i {
            min-width: 36px;

            width: 36px;
            height: 36px;

            font-size: 19px;
        }


        /* Divider */

        .sidebar-divider {
            margin: 5px 0;
        }

    }


    /* =========================================
       SMALL MOBILE
    ========================================= */

    @media (max-width: 480px) {

        .right-sidebar {
            padding: 10px;
        }


        .right-sidebar ul {
            grid-template-columns: 1fr;
        }


        .right-sidebar .nav-link {
            padding: 13px 14px;
        }


        .sidebar-header {
            padding: 14px;
        }

    }
</style>


<div class="right-sidebar">

    <ul>

        {{-- HEADER --}}
        <li>
            <div class="sidebar-header">

                <i class="material-icons">hub</i>

                <div class="sidebar-header-text">
                    <strong>PRO DAWG</strong>

                    <small>SOCIAL WORLD</small>
                </div>

            </div>
        </li>


        {{-- NAVIGATION LABEL --}}
        <li style="grid-column: 1 / -1;">
            <span class="sidebar-label">
                NAVIGATION
            </span>
        </li>


        {{-- DASHBOARD --}}
        <li>
            <a href="#" class="nav-link active">

                <i class="material-icons">dashboard</i>

                <span>Dashboard</span>

            </a>
        </li>


        {{-- CHATS --}}
        <li>
            <a href="#" class="nav-link">

                <i class="material-icons">chat</i>

                <span>Chats</span>

            </a>
        </li>


        {{-- COMMUNITY --}}
        <li>
            <a href="#" class="nav-link">

                <i class="material-icons">groups</i>

                <span>Community</span>

            </a>
        </li>


        {{-- DIVIDER --}}
        <li style="grid-column: 1 / -1;">
            <div class="sidebar-divider"></div>
        </li>


        {{-- ACCOUNT LABEL --}}
        <li style="grid-column: 1 / -1;">
            <span class="sidebar-label">
                YOUR ACCOUNT
            </span>
        </li>


        {{-- PROFILE --}}
        <li>
            <a href="#" class="nav-link">

                <i class="material-icons">person</i>

                <span>Profile</span>

            </a>
        </li>


        {{-- SETTINGS --}}
        <li>
            <a href="#" class="nav-link">

                <i class="material-icons">settings</i>

                <span>Settings</span>

            </a>
        </li>

    </ul>

</div>
