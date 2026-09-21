<div
    class="sidebar"
    style="
        width: 250px;
        min-width: 250px;
        min-height: 100vh;
        background: #111827;
        padding: 20px 14px;
        border-right: 1px solid #1f2937;
        box-shadow: 4px 0 20px rgba(0, 0, 0, 0.15);
        overflow: visible;
        box-sizing: border-box;
    "
>
    <!-- Sidebar Header -->
    <div
        style="
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 12px 24px;
            margin-bottom: 10px;
            border-bottom: 1px solid #1f2937;
            white-space: nowrap;
            overflow: visible;
        "
    >
        <div
            style="
                width: 42px;
                min-width: 42px;
                height: 42px;
                border-radius: 12px;
                background: linear-gradient(135deg, #6366f1, #8b5cf6);
                display: flex;
                align-items: center;
                justify-content: center;
                color: #fff;
                font-size: 18px;
                box-shadow: 0 6px 15px rgba(99, 102, 241, 0.35);
            "
        >
            <i class="fas fa-user-shield"></i>
        </div>

        <div
            style="
                line-height: 1.2;
                white-space: nowrap;
                overflow: visible;
                display: block;
                visibility: visible;
                opacity: 1;
            "
        >
            <div
                style="
                    color: #ffffff;
                    font-size: 15px;
                    font-weight: 700;
                    white-space: nowrap;
                    display: block;
                    visibility: visible;
                    opacity: 1;
                "
            >
                Admin Panel
            </div>

            <small
                style="
                    color: #9ca3af;
                    font-size: 11px;
                    white-space: nowrap;
                    display: block;
                    visibility: visible;
                    opacity: 1;
                "
            >
                Management System
            </small>
        </div>
    </div>


    <!-- Navigation -->
    <ul
        class="nav flex-column"
        style="
            display: flex;
            flex-direction: column;
            gap: 6px;
            width: 100%;
            padding: 0;
            margin: 0;
            list-style: none;
        "
    >

        <!-- Dashboard -->
        <li class="nav-item" style="width: 100%;">
            <a
                href="{{ route('admin.dashboard') }}"
                class="nav-link"
                style="
                    display: flex;
                    align-items: center;
                    width: 100%;
                    box-sizing: border-box;
                    gap: 13px;
                    padding: 12px 14px;
                    border-radius: 10px;
                    color: #ffffff;
                    background: rgba(99, 102, 241, 0.18);
                    text-decoration: none;
                    font-size: 14px;
                    font-weight: 600;
                    white-space: nowrap;
                    overflow: visible;
                    transition: background 0.2s ease, color 0.2s ease;
                "
                onmouseover="
                    this.style.background='rgba(99,102,241,0.28)';
                "
                onmouseout="
                    this.style.background='rgba(99,102,241,0.18)';
                "
            >
                <i
                    class="fas fa-home"
                    style="
                        width: 20px;
                        min-width: 20px;
                        text-align: center;
                        font-size: 15px;
                        color: #a5b4fc;
                    "
                ></i>

                <span
                    style="
                        display: inline-block;
                        visibility: visible;
                        opacity: 1;
                        white-space: nowrap;
                    "
                >
                    Dashboard
                </span>
            </a>
        </li>


        <!-- Users -->
        <li class="nav-item" style="width: 100%;">
            <a
                href="{{ route('add-user') }}"
                class="nav-link"
                style="
                    display: flex;
                    align-items: center;
                    width: 100%;
                    box-sizing: border-box;
                    gap: 13px;
                    padding: 12px 14px;
                    border-radius: 10px;
                    color: #d1d5db;
                    background: transparent;
                    text-decoration: none;
                    font-size: 14px;
                    font-weight: 500;
                    white-space: nowrap;
                    overflow: visible;
                    transition: background 0.2s ease, color 0.2s ease;
                "
                onmouseover="
                    this.style.background='#1f2937';
                    this.style.color='#ffffff';
                "
                onmouseout="
                    this.style.background='transparent';
                    this.style.color='#d1d5db';
                "
            >
                <i
                    class="fas fa-users"
                    style="
                        width: 20px;
                        min-width: 20px;
                        text-align: center;
                        font-size: 15px;
                        color: #60a5fa;
                    "
                ></i>

                <span
                    style="
                        display: inline-block;
                        visibility: visible;
                        opacity: 1;
                        white-space: nowrap;
                    "
                >
                    Users
                </span>
            </a>
        </li>


        <!-- Profile -->
        <li class="nav-item" style="width: 100%;">
            <a
                href="#"
                class="nav-link"
                style="
                    display: flex;
                    align-items: center;
                    width: 100%;
                    box-sizing: border-box;
                    gap: 13px;
                    padding: 12px 14px;
                    border-radius: 10px;
                    color: #d1d5db;
                    background: transparent;
                    text-decoration: none;
                    font-size: 14px;
                    font-weight: 500;
                    white-space: nowrap;
                    overflow: visible;
                    transition: background 0.2s ease, color 0.2s ease;
                "
                onmouseover="
                    this.style.background='#1f2937';
                    this.style.color='#ffffff';
                "
                onmouseout="
                    this.style.background='transparent';
                    this.style.color='#d1d5db';
                "
            >
                <i
                    class="fas fa-user"
                    style="
                        width: 20px;
                        min-width: 20px;
                        text-align: center;
                        font-size: 15px;
                        color: #34d399;
                    "
                ></i>

                <span
                    style="
                        display: inline-block;
                        visibility: visible;
                        opacity: 1;
                        white-space: nowrap;
                    "
                >
                    Profile
                </span>
            </a>
        </li>


        <!-- Settings -->
        <li class="nav-item" style="width: 100%;">
            <a
                href="{{ route('admin.settings') }}"
                class="nav-link"
                style="
                    display: flex;
                    align-items: center;
                    width: 100%;
                    box-sizing: border-box;
                    gap: 13px;
                    padding: 12px 14px;
                    border-radius: 10px;
                    color: #d1d5db;
                    background: transparent;
                    text-decoration: none;
                    font-size: 14px;
                    font-weight: 500;
                    white-space: nowrap;
                    overflow: visible;
                    transition: background 0.2s ease, color 0.2s ease;
                "
                onmouseover="
                    this.style.background='#1f2937';
                    this.style.color='#ffffff';
                "
                onmouseout="
                    this.style.background='transparent';
                    this.style.color='#d1d5db';
                "
            >
                <i
                    class="fas fa-cog"
                    style="
                        width: 20px;
                        min-width: 20px;
                        text-align: center;
                        font-size: 15px;
                        color: #fbbf24;
                    "
                ></i>

                <span
                    style="
                        display: inline-block;
                        visibility: visible;
                        opacity: 1;
                        white-space: nowrap;
                    "
                >
                    Settings
                </span>
            </a>
        </li>


        <!-- Divider -->
        <li
            style="
                width: calc(100% - 16px);
                height: 1px;
                background: #1f2937;
                margin: 12px 8px;
            "
        ></li>


        <!-- Disabled -->
        <li class="nav-item" style="width: 100%;">
            <a
                href="#"
                aria-disabled="true"
                onclick="return false;"
                style="
                    display: flex;
                    align-items: center;
                    width: 100%;
                    box-sizing: border-box;
                    gap: 13px;
                    padding: 12px 14px;
                    border-radius: 10px;
                    color: #4b5563;
                    background: transparent;
                    text-decoration: none;
                    font-size: 14px;
                    font-weight: 500;
                    cursor: not-allowed;
                    opacity: 0.7;
                    white-space: nowrap;
                    overflow: visible;
                "
            >
                <i
                    class="fas fa-ban"
                    style="
                        width: 20px;
                        min-width: 20px;
                        text-align: center;
                        font-size: 15px;
                    "
                ></i>

                <span
                    style="
                        display: inline-block;
                        visibility: visible;
                        opacity: 1;
                        white-space: nowrap;
                    "
                >
                    Disabled
                </span>
            </a>
        </li>

    </ul>
</div>
