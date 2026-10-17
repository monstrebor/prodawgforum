
<style>
    :root {
        --sidebar-width: 260px;
        --sidebar-mobile-width: 280px;
        --sidebar-bg: #020617;
        --sidebar-border: rgba(255, 255, 255, 0.08);
        --sidebar-text: #94a3b8;
        --sidebar-accent: #67e8f9;
    }

    /* =========================
       SIDEBAR
    ========================= */
    #appSidebar.sidebar {
        position: fixed !important;
        top: 0;
        left: 0;
        bottom: 0;
        width: var(--sidebar-width);
        height: 100vh;
        height: 100dvh;
        padding: 16px 10px;
        box-sizing: border-box;
        z-index: 10000;
        overflow-x: hidden;
        overflow-y: auto;

        background: linear-gradient(180deg, #0f172a, #020617);
        border-right: 1px solid var(--sidebar-border);
        box-shadow: 8px 0 35px rgba(0, 0, 0, 0.3);
        backdrop-filter: blur(20px);
        scrollbar-width: thin;
        scrollbar-color: #334155 transparent;

        transform: translateX(0);
        visibility: visible;
        pointer-events: auto;

        transition:
            width 0.3s ease,
            padding 0.3s ease,
            transform 0.3s ease,
            visibility 0.3s ease;
    }

    #appSidebar::before {
        content: "";
        position: absolute;
        top: -100px;
        left: -100px;
        width: 250px;
        height: 250px;
        border-radius: 50%;
        background: rgba(6, 182, 212, 0.12);
        filter: blur(80px);
        pointer-events: none;
    }

    #appSidebar > * {
        position: relative;
    }

    /* =========================
       SIDEBAR HEADER
    ========================= */
    .sidebar-header {
        display: flex;
        align-items: center;
        gap: 12px;
        height: 58px;
        padding: 0 10px;
        margin-bottom: 22px;
        border-radius: 16px;
        white-space: nowrap;

        background: linear-gradient(
            135deg,
            rgba(6, 182, 212, 0.12),
            rgba(124, 58, 237, 0.08)
        );
        border: 1px solid var(--sidebar-border);
    }

    .sidebar-header > i {
        display: flex;
        align-items: center;
        justify-content: center;
        flex: 0 0 42px;
        width: 42px;
        height: 42px;
        border-radius: 13px;
        color: var(--sidebar-accent);
        font-size: 23px;
        background: rgba(6, 182, 212, 0.15);
    }

    .sidebar-header > span {
        min-width: 0;
        overflow: hidden;
        text-overflow: ellipsis;
        color: #fff;
        font-size: 14px;
        font-weight: 700;
        letter-spacing: 2px;
    }

    /* =========================
       DESKTOP COLLAPSE BUTTON
    ========================= */
    .sidebar-collapse {
        display: flex;
        align-items: center;
        justify-content: center;
        flex: 0 0 34px;
        width: 34px;
        height: 34px;
        margin-left: auto;
        padding: 0;
        border: 1px solid var(--sidebar-border);
        border-radius: 10px;
        color: var(--sidebar-text);
        background: rgba(255, 255, 255, 0.04);
        cursor: pointer;
        transition: background 0.2s ease, color 0.2s ease;
    }

    .sidebar-collapse:hover,
    .sidebar-expand:hover,
    .sidebar-toggle:hover {
        color: #fff;
        background: rgba(6, 182, 212, 0.2);
    }

    /* =========================
       MENU
    ========================= */
    .sidebar-menu {
        position: relative;
        list-style: none;
        width: 100%;
        padding: 0;
        margin: 0;
    }

    .sidebar-menu li {
        list-style: none;
        width: 100%;
        margin-bottom: 8px;
    }

    .sidebar-link,
    .sidebar-logout {
        display: flex;
        align-items: center;
        gap: 14px;
        width: 100%;
        min-width: 0;
        min-height: 52px;
        padding: 5px 10px;
        box-sizing: border-box;
        border-radius: 12px;
        white-space: nowrap;
        text-decoration: none;
        font-family: inherit;
        transition:
            background 0.2s ease,
            color 0.2s ease,
            border-color 0.2s ease;
    }

    .sidebar-link {
        color: var(--sidebar-text);
        background: rgba(255, 255, 255, 0.02);
        border: 1px solid transparent;
    }

    .sidebar-link:hover {
        color: #fff;
        background: rgba(6, 182, 212, 0.1);
        border-color: rgba(34, 211, 238, 0.15);
    }

    .sidebar-link > i,
    .sidebar-logout > i {
        display: flex;
        align-items: center;
        justify-content: center;
        flex: 0 0 40px;
        width: 40px;
        height: 40px;
        border-radius: 11px;
        font-size: 21px;
    }

    .sidebar-link > i {
        color: var(--sidebar-accent);
        background: rgba(6, 182, 212, 0.08);
    }

    .sidebar-link > span,
    .sidebar-logout > span {
        min-width: 0;
        overflow: hidden;
        text-overflow: ellipsis;
        font-size: 14px;
        font-weight: 500;
    }

    .sidebar-link.active {
        color: #fff;
        background: linear-gradient(
            135deg,
            rgba(6, 182, 212, 0.3),
            rgba(37, 99, 235, 0.3),
            rgba(124, 58, 237, 0.25)
        );
        border-color: rgba(34, 211, 238, 0.3);
        box-shadow: 0 8px 25px rgba(6, 182, 212, 0.12);
    }

    .sidebar-link.active > i {
        color: #fff;
        background: linear-gradient(135deg, #06b6d4, #2563eb);
        box-shadow: 0 5px 18px rgba(6, 182, 212, 0.25);
    }

    .sidebar-divider {
        height: 1px;
        width: calc(100% - 16px) !important;
        margin: 18px 8px 16px !important;
        background: linear-gradient(
            90deg,
            transparent,
            rgba(255, 255, 255, 0.15),
            transparent
        );
    }

    /* =========================
       LOGOUT
    ========================= */
    .sidebar-menu form {
        width: 100%;
        margin: 0;
    }

    .sidebar-logout {
        color: #f87171;
        cursor: pointer;
        background: rgba(239, 68, 68, 0.04);
        border: 1px solid transparent;
        text-align: left;
    }

    .sidebar-logout:hover {
        color: #fecaca;
        background: rgba(239, 68, 68, 0.12);
        border-color: rgba(248, 113, 113, 0.2);
    }

    .sidebar-logout > i {
        color: #f87171;
        background: rgba(239, 68, 68, 0.1);
    }

    /* =========================
       MAIN CONTENT
    ========================= */
    .main-content {
        width: auto;
        min-width: 0;
        min-height: 100vh;
        margin-left: var(--sidebar-width);
        padding: 25px;
        box-sizing: border-box;
        overflow-wrap: anywhere;
        transition: margin-left 0.3s ease;
    }

    .main-content img,
    .main-content video,
    .main-content iframe {
        max-width: 100%;
    }

    .main-content table {
        max-width: 100%;
    }

    /* =========================
       FIXED DESKTOP EXPAND BUTTON
    ========================= */
    #sidebarExpand {
        display: flex;
        align-items: center;
        justify-content: center;
        position: fixed !important;
        top: 16px;
        left: 16px;
        width: 44px;
        height: 44px;
        padding: 0;
        box-sizing: border-box;
        z-index: 10003;

        border: 1px solid var(--sidebar-border);
        border-radius: 12px;
        color: #fff;
        background: #0f172a;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.3);
        cursor: pointer;

        opacity: 0;
        visibility: hidden;
        pointer-events: none;
    }

    #sidebarExpand > i {
        font-size: 23px;
    }

    /* =========================
       FIXED MOBILE MENU BUTTON
    ========================= */
    #sidebarToggle {
        display: none;
        align-items: center;
        justify-content: center;
        position: fixed !important;
        top: 14px;
        left: 14px;
        width: 44px;
        height: 44px;
        padding: 0;
        box-sizing: border-box;
        z-index: 10003;

        border: 1px solid rgba(255, 255, 255, 0.12);
        border-radius: 12px;
        color: #fff;
        background: #0f172a;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.3);
        cursor: pointer;
    }

    #sidebarToggle > i {
        font-size: 24px;
    }

    /* =========================
       OVERLAY
       Hidden by default
    ========================= */
    #sidebarOverlay {
        display: none !important;
        position: fixed !important;
        inset: 0;
        width: 100%;
        height: 100%;
        z-index: 9998;
        background: rgba(0, 0, 0, 0.65);
        backdrop-filter: blur(3px);
        -webkit-backdrop-filter: blur(3px);
    }

    /* =========================
       DESKTOP COLLAPSED STATE
    ========================= */
    @media (min-width: 769px) {
        #appSidebar.sidebar.is-collapsed {
            width: 0 !important;
            padding-left: 0 !important;
            padding-right: 0 !important;
            border-right-width: 0 !important;
            box-shadow: none !important;
            visibility: hidden !important;
            pointer-events: none !important;
            overflow: hidden !important;
        }

        #appSidebar.sidebar.is-collapsed > * {
            opacity: 0;
        }

        body.sidebar-collapsed .main-content {
            margin-left: 0 !important;
        }

        body.sidebar-collapsed #sidebarExpand {
            opacity: 1;
            visibility: visible;
            pointer-events: auto;
        }
    }

    /* =========================
       MOBILE AND TABLET
    ========================= */
    @media (max-width: 768px) {
        #appSidebar.sidebar {
            width: min(var(--sidebar-mobile-width), 85vw);
            max-width: 320px;
            height: 100vh;
            height: 100dvh;
            padding: 16px 10px;

            transform: translateX(-105%);
            visibility: hidden;
            pointer-events: none;
            box-shadow: none;

            transition:
                transform 0.3s ease,
                visibility 0.3s ease;
        }

        #appSidebar.sidebar.is-open {
            transform: translateX(0);
            visibility: visible;
            pointer-events: auto;
            box-shadow: 8px 0 35px rgba(0, 0, 0, 0.3);
        }

        #sidebarToggle {
            display: flex;
        }

        #sidebarExpand,
        #sidebarCollapse {
            display: none !important;
        }

        #sidebarOverlay.is-visible {
            display: block !important;
        }

        .main-content {
            width: 100%;
            margin-left: 0 !important;
            padding: 76px 16px 20px;
        }

        body.sidebar-open {
            overflow: hidden;
        }
    }

    /* SMALL PHONES */
    @media (max-width: 380px) {
        .main-content {
            padding: 72px 12px 16px;
        }

        #appSidebar.sidebar {
            padding: 12px 8px;
        }

        .sidebar-header {
            gap: 8px;
            padding: 0 8px;
        }
    }

    @media (prefers-reduced-motion: reduce) {
        #appSidebar,
        .sidebar-link,
        .sidebar-logout,
        .main-content,
        #sidebarExpand {
            transition: none !important;
        }
    }
</style>

{{-- MOBILE MENU BUTTON --}}
<button
    type="button"
    id="sidebarToggle"
    aria-label="Open navigation menu"
    aria-controls="appSidebar"
    aria-expanded="false"
>
    <i class="material-icons" id="sidebarToggleIcon">menu</i>
</button>

{{-- DESKTOP EXPAND BUTTON --}}
<button
    type="button"
    id="sidebarExpand"
    aria-label="Expand sidebar"
    title="Expand sidebar"
    aria-expanded="false"
>
    <i class="material-icons">dock_to_right</i>
</button>

{{-- MOBILE OVERLAY --}}
<div
    id="sidebarOverlay"
    aria-hidden="true"
></div>

{{-- SIDEBAR --}}
<aside class="sidebar" id="appSidebar">
    <div class="sidebar-header">
        <i class="material-icons">dashboard</i>
        <span>PRO DAWG</span>

        <button
            type="button"
            class="sidebar-collapse"
            id="sidebarCollapse"
            aria-label="Collapse sidebar"
            title="Collapse sidebar"
            aria-expanded="true"
        >
            <i class="material-icons">dock_to_left</i>
        </button>
    </div>

    <ul class="sidebar-menu">
        <li>
            <a
                href="#"
                class="sidebar-link {{ request()->routeIs('user.dashboard') ? 'active' : '' }}"
            >
                <i class="material-icons">home</i>
                <span>Dashboard</span>
            </a>
        </li>

        <li>
            <a href="#" class="sidebar-link">
                <i class="material-icons">group</i>
                <span>Users</span>
            </a>
        </li>

        <li>
            <a href="#" class="sidebar-link">
                <i class="material-icons">person</i>
                <span>Profile</span>
            </a>
        </li>

        <li>
            <a href="#" class="sidebar-link">
                <i class="material-icons">settings</i>
                <span>Settings</span>
            </a>
        </li>

        <li>
            <a
                href="{{ route('user.clash-of-clan') }}"
                class="sidebar-link {{ request()->routeIs('user.clash-of-clan') ? 'active' : '' }}"
            >
                <i class="material-icons">sports_esports</i>
                <span>Clash of Clans</span>
            </a>
        </li>

        <li>
            <a
                href="{{ route('user.chess.index') }}"
                class="sidebar-link {{ request()->routeIs('user.chess.*') ? 'active' : '' }}"
            >
                <i class="material-icons">extension</i>
                <span>Chess</span>
            </a>
        </li>

        <li class="sidebar-divider" aria-hidden="true"></li>

        <li>
            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button type="submit" class="sidebar-logout">
                    <i class="material-icons">logout</i>
                    <span>Logout</span>
                </button>
            </form>
        </li>
    </ul>
</aside>

<script>
    (() => {
        function initSidebar() {
            const sidebar = document.getElementById('appSidebar');
            const mobileToggle = document.getElementById('sidebarToggle');
            const mobileIcon = document.getElementById('sidebarToggleIcon');
            const overlay = document.getElementById('sidebarOverlay');
            const collapseButton = document.getElementById('sidebarCollapse');
            const expandButton = document.getElementById('sidebarExpand');

            if (!sidebar || !mobileToggle || !mobileIcon || !overlay) {
                return;
            }

            if (sidebar.dataset.initialized === 'true') {
                return;
            }

            sidebar.dataset.initialized = 'true';

            const mobileQuery = window.matchMedia('(max-width: 768px)');

            function closeMobileSidebar() {
                sidebar.classList.remove('is-open');
                overlay.classList.remove('is-visible');

                // Remove any previous inline display setting.
                overlay.style.removeProperty('display');
                overlay.setAttribute('aria-hidden', 'true');

                document.body.classList.remove('sidebar-open');

                mobileToggle.setAttribute('aria-expanded', 'false');
                mobileToggle.setAttribute(
                    'aria-label',
                    'Open navigation menu'
                );
                mobileIcon.textContent = 'menu';
            }

            function openMobileSidebar() {
                sidebar.classList.add('is-open');
                overlay.classList.add('is-visible');
                overlay.setAttribute('aria-hidden', 'false');

                document.body.classList.add('sidebar-open');

                mobileToggle.setAttribute('aria-expanded', 'true');
                mobileToggle.setAttribute(
                    'aria-label',
                    'Close navigation menu'
                );
                mobileIcon.textContent = 'close';
            }

            function setDesktopSidebar(open) {
                if (mobileQuery.matches) {
                    return;
                }

                sidebar.classList.toggle('is-collapsed', !open);
                document.body.classList.toggle(
                    'sidebar-collapsed',
                    !open
                );

                collapseButton?.setAttribute(
                    'aria-expanded',
                    String(open)
                );

                expandButton?.setAttribute(
                    'aria-expanded',
                    String(open)
                );
            }

            mobileToggle.addEventListener('click', () => {
                if (!mobileQuery.matches) {
                    return;
                }

                if (sidebar.classList.contains('is-open')) {
                    closeMobileSidebar();
                } else {
                    openMobileSidebar();
                }
            });

            overlay.addEventListener('click', closeMobileSidebar);

            collapseButton?.addEventListener('click', () => {
                setDesktopSidebar(false);
            });

            expandButton?.addEventListener('click', () => {
                setDesktopSidebar(true);
            });

            sidebar.querySelectorAll('a').forEach(link => {
                link.addEventListener('click', () => {
                    if (mobileQuery.matches) {
                        closeMobileSidebar();
                    }
                });
            });

            document.addEventListener('keydown', event => {
                if (event.key === 'Escape' && mobileQuery.matches) {
                    closeMobileSidebar();
                }
            });

            mobileQuery.addEventListener('change', event => {
                closeMobileSidebar();

                if (event.matches) {
                    sidebar.classList.remove('is-collapsed');
                    document.body.classList.remove('sidebar-collapsed');
                } else {
                    sidebar.classList.remove('is-open');
                    setDesktopSidebar(
                        !sidebar.classList.contains('is-collapsed')
                    );
                }
            });

            // Start with the mobile overlay closed.
            closeMobileSidebar();

            if (mobileQuery.matches) {
                sidebar.classList.remove('is-collapsed');
                document.body.classList.remove('sidebar-collapsed');
            } else {
                setDesktopSidebar(
                    !sidebar.classList.contains('is-collapsed')
                );
            }
        }

        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', initSidebar, {
                once: true
            });
        } else {
            initSidebar();
        }
    })();
</script>
