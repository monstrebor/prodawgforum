<style>
    /* =========================================
       PRO DAWG RESPONSIVE NAVBAR
    ========================================= */

    .pro-navbar {
        position: sticky;
        top: 0;
        z-index: 9999;

        width: 100%;
        min-height: 72px;

        background:
            linear-gradient(
                135deg,
                rgba(15, 23, 42, 0.96),
                rgba(2, 6, 23, 0.98)
            );

        border-bottom: 1px solid rgba(255, 255, 255, 0.08);

        box-shadow:
            0 10px 35px rgba(0, 0, 0, 0.25);

        backdrop-filter: blur(20px);
    }


    /* =========================================
       NAVBAR CONTAINER
    ========================================= */

    .pro-navbar-container {
        width: 100%;
        min-height: 72px;

        display: flex;
        align-items: center;
        justify-content: space-between;

        gap: 20px;

        padding: 10px 24px;

        box-sizing: border-box;
    }


    /* =========================================
       LOGO
    ========================================= */

    .navbar-brand {
        display: flex;
        align-items: center;

        gap: 12px;

        min-width: max-content;

        text-decoration: none;
    }


    .navbar-logo {
        width: 48px;
        height: 48px;

        display: flex;
        align-items: center;
        justify-content: center;

        border-radius: 16px;

        overflow: hidden;

        background:
            linear-gradient(
                135deg,
                rgba(6, 182, 212, 0.2),
                rgba(37, 99, 235, 0.2),
                rgba(124, 58, 237, 0.2)
            );

        border: 1px solid rgba(255, 255, 255, 0.12);

        box-shadow:
            0 8px 25px rgba(6, 182, 212, 0.12);
    }


    .navbar-logo img {
        width: 100%;
        height: 100%;

        object-fit: contain;

        padding: 5px;
    }


    .navbar-brand-text {
        display: flex;
        flex-direction: column;
    }


    .navbar-brand-title {
        color: white;

        font-size: 17px;
        font-weight: 800;

        letter-spacing: 0.5px;
    }


    .navbar-brand-subtitle {
        margin-top: 2px;

        color: #67e8f9;

        font-size: 10px;

        font-weight: 600;

        letter-spacing: 2px;
    }


    /* =========================================
       CENTER NAVIGATION
    ========================================= */

    .navbar-navigation {
        display: flex;
        align-items: center;
        justify-content: center;

        gap: 8px;

        flex: 1;
    }


    .navbar-nav-link {
        position: relative;

        width: 54px;
        height: 48px;

        display: flex;
        align-items: center;
        justify-content: center;

        border-radius: 14px;

        text-decoration: none;

        color: #94a3b8;

        background:
            rgba(255, 255, 255, 0.03);

        border:
            1px solid transparent;

        transition:
            background 0.25s ease,
            color 0.25s ease,
            border 0.25s ease;
    }


    .navbar-nav-link i,
    .navbar-nav-link svg {
        width: 22px;
        height: 22px;
    }


    .navbar-nav-link:hover {
        color: #67e8f9;

        background:
            rgba(6, 182, 212, 0.1);

        border-color:
            rgba(34, 211, 238, 0.15);
    }


    /* ACTIVE */

    .navbar-nav-link.active {
        color: white;

        background:
            linear-gradient(
                135deg,
                #06b6d4,
                #2563eb,
                #7c3aed
            );

        box-shadow:
            0 8px 25px rgba(37, 99, 235, 0.25);
    }


    /* =========================================
       RIGHT ACTIONS
    ========================================= */

    .navbar-actions {
        display: flex;
        align-items: center;

        gap: 12px;

        min-width: max-content;
    }


    /* =========================================
       AVATAR
    ========================================= */

    .navbar-avatar {
        display: flex;
        align-items: center;
        justify-content: center;

        width: 46px;
        height: 46px;

        border-radius: 14px;

        overflow: hidden;

        background:
            rgba(255, 255, 255, 0.06);

        border:
            1px solid rgba(255, 255, 255, 0.1);
    }


    /* =========================================
       LOGOUT BUTTON
    ========================================= */

    .navbar-logout {
        height: 46px;

        display: flex;
        align-items: center;

        gap: 8px;

        padding: 0 16px;

        border: none;

        border-radius: 14px;

        cursor: pointer;

        color: white;

        font-size: 14px;
        font-weight: 600;

        background:
            linear-gradient(
                135deg,
                #ef4444,
                #dc2626
            );

        box-shadow:
            0 8px 20px rgba(239, 68, 68, 0.2);

        transition:
            transform 0.2s ease,
            box-shadow 0.2s ease;
    }


    .navbar-logout:hover {
        transform: translateY(-2px);

        box-shadow:
            0 12px 25px rgba(239, 68, 68, 0.3);
    }


    .navbar-logout i {
        font-size: 19px;
    }


    /* =========================================
       MOBILE MENU BUTTON
    ========================================= */

    .navbar-mobile-toggle {
        display: none;

        width: 46px;
        height: 46px;

        align-items: center;
        justify-content: center;

        border-radius: 14px;

        border:
            1px solid rgba(255, 255, 255, 0.1);

        background:
            rgba(255, 255, 255, 0.06);

        color: #67e8f9;

        cursor: pointer;
    }


    /* =========================================
       TABLET
    ========================================= */

    @media (max-width: 1024px) {

        .pro-navbar-container {
            padding: 10px 18px;
        }


        .navbar-navigation {
            gap: 5px;
        }


        .navbar-nav-link {
            width: 48px;
            height: 46px;
        }


        .navbar-brand-subtitle {
            display: none;
        }

    }


    /* =========================================
       MOBILE
    ========================================= */

    @media (max-width: 768px) {

        .pro-navbar-container {
            min-height: 65px;

            padding: 8px 15px;

            gap: 10px;
        }


        /* Hide desktop navigation */

        .navbar-navigation {
            display: none;
        }


        /* Hide logout text */

        .navbar-logout span {
            display: none;
        }


        .navbar-logout {
            width: 46px;

            justify-content: center;

            padding: 0;
        }


        .navbar-brand-title {
            font-size: 15px;
        }


        .navbar-logo {
            width: 43px;
            height: 43px;

            border-radius: 14px;
        }


        .navbar-mobile-toggle {
            display: flex;
        }

    }


    /* =========================================
       SMALL MOBILE
    ========================================= */

    @media (max-width: 480px) {

        .navbar-brand-text {
            display: none;
        }


        .navbar-actions {
            gap: 8px;
        }


        .navbar-avatar {
            width: 42px;
            height: 42px;
        }


        .navbar-logout {
            width: 42px;
            height: 42px;
        }


        .navbar-mobile-toggle {
            width: 42px;
            height: 42px;
        }

    }


    /* =========================================
       MOBILE DROPDOWN
    ========================================= */

    .mobile-navigation {
        display: none;

        padding: 12px 15px 18px;

        border-top:
            1px solid rgba(255, 255, 255, 0.08);

        background:
            rgba(2, 6, 23, 0.98);
    }


    .mobile-navigation.show {
        display: grid;

        grid-template-columns: repeat(5, 1fr);

        gap: 8px;
    }


    .mobile-nav-link {
        display: flex;

        flex-direction: column;

        align-items: center;
        justify-content: center;

        gap: 5px;

        padding: 12px 5px;

        border-radius: 14px;

        text-decoration: none;

        color: #94a3b8;

        font-size: 10px;

        background:
            rgba(255, 255, 255, 0.04);
    }


    .mobile-nav-link i,
    .mobile-nav-link svg {
        width: 21px;
        height: 21px;
    }


    .mobile-nav-link.active {
        color: white;

        background:
            linear-gradient(
                135deg,
                #06b6d4,
                #2563eb
            );
    }


    @media (min-width: 769px) {

        .mobile-navigation {
            display: none !important;
        }

    }
</style>


<!-- =========================================
     PRO DAWG NAVBAR
========================================= -->

<nav class="pro-navbar">

    <div class="pro-navbar-container">


        <!-- =====================================
             LEFT: BRAND
        ====================================== -->

        <a href="{{ route('user.dashboard') }}"
           class="navbar-brand">

            <div class="navbar-logo">

                <img src="{{ asset('storage/assets/logo.png') }}"
                     alt="Pro Dawg Logo">

            </div>


            <div class="navbar-brand-text">

                <span class="navbar-brand-title">
                    PRO DAWG
                </span>

                <span class="navbar-brand-subtitle">
                    SOCIAL WORLD
                </span>

            </div>

        </a>


        <!-- =====================================
             CENTER: NAVIGATION
        ====================================== -->

        <div class="navbar-navigation">


            <!-- HOME -->

            <a href="{{ route('user.dashboard') }}"
               class="navbar-nav-link active"
               title="Home">

                <i data-lucide="home"></i>

            </a>


            <!-- DASHBOARD -->

            <a href="#"
               class="navbar-nav-link"
               title="Dashboard">

                <i data-lucide="layout-dashboard"></i>

            </a>


            <!-- FRIENDS -->

            <a href="{{ route('user.view-friend') }}"
               class="navbar-nav-link"
               title="Friends">

                <i data-lucide="users"></i>

            </a>


            <!-- WATCH -->

            <a href="#"
               class="navbar-nav-link"
               title="Watch">

                <i data-lucide="tv"></i>

            </a>


            <!-- MENU -->

            <a href="#"
               class="navbar-nav-link"
               title="Menu">

                <i data-lucide="menu"></i>

            </a>

        </div>


        <!-- =====================================
             RIGHT ACTIONS
        ====================================== -->

        <div class="navbar-actions">


            <!-- AVATAR -->

            <div class="navbar-avatar">

                <x-user-avatar />

            </div>


            <!-- LOGOUT -->

            <form method="POST"
                  action="{{ route('logout') }}">

                @csrf

                <button type="submit"
                        class="navbar-logout">

                    <i class="material-icons">
                        logout
                    </i>

                    <span>
                        Logout
                    </span>

                </button>

            </form>


            <!-- MOBILE TOGGLE -->

            <button type="button"
                    class="navbar-mobile-toggle"
                    id="mobileNavToggle">

                <i class="material-icons">
                    menu
                </i>

            </button>

        </div>

    </div>


    <!-- =====================================
         MOBILE NAVIGATION
    ====================================== -->

    <div class="mobile-navigation"
         id="mobileNavigation">


        <a href="{{ route('user.dashboard') }}"
           class="mobile-nav-link active">

            <i data-lucide="home"></i>

            <span>Home</span>

        </a>


        <a href="#"
           class="mobile-nav-link">

            <i data-lucide="layout-dashboard"></i>

            <span>Dashboard</span>

        </a>


        <a href="{{ route('user.view-friend') }}"
           class="mobile-nav-link">

            <i data-lucide="users"></i>

            <span>Friends</span>

        </a>


        <a href="#"
           class="mobile-nav-link">

            <i data-lucide="tv"></i>

            <span>Watch</span>

        </a>


        <a href="#"
           class="mobile-nav-link">

            <i data-lucide="menu"></i>

            <span>Menu</span>

        </a>

    </div>

</nav>


<!-- =========================================
     JAVASCRIPT
========================================= -->

<script>
    document.addEventListener('DOMContentLoaded', function() {

        const toggle = document.getElementById('mobileNavToggle');
        const navigation = document.getElementById('mobileNavigation');

        if (toggle && navigation) {

            toggle.addEventListener('click', function() {

                navigation.classList.toggle('show');

            });

        }


        /* Initialize Lucide icons */

        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }

    });
</script>
