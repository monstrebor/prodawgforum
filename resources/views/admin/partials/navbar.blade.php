<div
    style="
        position: fixed;
        top: 0;
        left: 250px;
        width: calc(100% - 250px);
        height: 60px;
        min-height: 60px;
        z-index: 9999;
        background: #111827;
        border-bottom: 1px solid #1f2937;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.25);
        box-sizing: border-box;
    "
>
    <div
        style="
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
            height: 60px;
            padding: 0 24px;
            box-sizing: border-box;
        "
    >

        <!-- LEFT: PAGE TITLE -->
        <div
            style="
                display: flex;
                align-items: center;
                gap: 12px;
                flex-shrink: 0;
            "
        >
            <div
                style="
                    width: 36px;
                    height: 36px;
                    min-width: 36px;
                    border-radius: 10px;
                    background: linear-gradient(135deg, #6366f1, #8b5cf6);
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    color: #ffffff;
                    box-shadow: 0 5px 12px rgba(99, 102, 241, 0.30);
                "
            >
                <i
                    class="fas fa-shield-alt"
                    style="font-size: 16px;"
                ></i>
            </div>

            <div
                style="
                    display: flex;
                    flex-direction: column;
                    line-height: 1.1;
                    white-space: nowrap;
                "
            >
                <span
                    style="
                        color: #ffffff;
                        font-size: 16px;
                        font-weight: 700;
                        letter-spacing: 0.3px;
                    "
                >
                    Admin Dashboard
                </span>

                <span
                    style="
                        color: #9ca3af;
                        font-size: 10px;
                        margin-top: 3px;
                    "
                >
                    Management System
                </span>
            </div>
        </div>


        <!-- CENTER NAVIGATION -->
        <div
            style="
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 8px;
                height: 100%;
                margin-left: auto;
                margin-right: auto;
            "
        >

            <a
                href="#"
                style="
                    display: flex;
                    align-items: center;
                    gap: 7px;
                    padding: 9px 13px;
                    border-radius: 9px;
                    color: #d1d5db;
                    background: transparent;
                    text-decoration: none;
                    font-size: 13px;
                    font-weight: 500;
                    transition: all 0.2s ease;
                "
                onmouseover="
                    this.style.background='rgba(99,102,241,0.15)';
                    this.style.color='#ffffff';
                "
                onmouseout="
                    this.style.background='transparent';
                    this.style.color='#d1d5db';
                "
            >
                <i
                    class="fas fa-info-circle"
                    style="
                        font-size: 13px;
                        color: #818cf8;
                    "
                ></i>
                Info
            </a>


            <a
                href="#"
                style="
                    display: flex;
                    align-items: center;
                    gap: 7px;
                    padding: 9px 13px;
                    border-radius: 9px;
                    color: #d1d5db;
                    background: transparent;
                    text-decoration: none;
                    font-size: 13px;
                    font-weight: 500;
                    transition: all 0.2s ease;
                "
                onmouseover="
                    this.style.background='rgba(99,102,241,0.15)';
                    this.style.color='#ffffff';
                "
                onmouseout="
                    this.style.background='transparent';
                    this.style.color='#d1d5db';
                "
            >
                <i
                    class="fas fa-building"
                    style="
                        font-size: 13px;
                        color: #a78bfa;
                    "
                ></i>
                About Us
            </a>


            <a
                href="#"
                style="
                    display: flex;
                    align-items: center;
                    gap: 7px;
                    padding: 9px 13px;
                    border-radius: 9px;
                    color: #d1d5db;
                    background: transparent;
                    text-decoration: none;
                    font-size: 13px;
                    font-weight: 500;
                    transition: all 0.2s ease;
                "
                onmouseover="
                    this.style.background='rgba(99,102,241,0.15)';
                    this.style.color='#ffffff';
                "
                onmouseout="
                    this.style.background='transparent';
                    this.style.color='#d1d5db';
                "
            >
                <i
                    class="fas fa-envelope"
                    style="
                        font-size: 13px;
                        color: #34d399;
                    "
                ></i>
                Contact
            </a>

        </div>


        <!-- RIGHT: USER + LOGOUT -->
        <div
            style="
                display: flex;
                align-items: center;
                gap: 12px;
                flex-shrink: 0;
            "
        >

            <!-- USER -->
            <div
                style="
                    display: flex;
                    align-items: center;
                    gap: 9px;
                    padding: 5px 9px 5px 5px;
                    border-radius: 10px;
                    background: #1f2937;
                    border: 1px solid #374151;
                "
            >

                <img
                    src="https://i.pravatar.cc/40?img=12"
                    alt="User Avatar"
                    style="
                        width: 32px;
                        height: 32px;
                        border-radius: 50%;
                        border: 2px solid #6366f1;
                        object-fit: cover;
                        box-shadow: 0 2px 7px rgba(0,0,0,0.25);
                    "
                >

                <div
                    style="
                        display: flex;
                        flex-direction: column;
                        line-height: 1.1;
                    "
                >
                    <span
                        style="
                            color: #ffffff;
                            font-size: 12px;
                            font-weight: 600;
                        "
                    >
                        Admin
                    </span>

                    <span
                        style="
                            color: #9ca3af;
                            font-size: 9px;
                            margin-top: 3px;
                        "
                    >
                        Administrator
                    </span>
                </div>

            </div>


            <!-- LOGOUT -->
            <form
                method="POST"
                action="{{ route('logout') }}"
                style="margin: 0;"
            >
                @csrf

                <button
                    type="submit"
                    style="
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        gap: 7px;
                        height: 36px;
                        padding: 0 13px;
                        border: 1px solid rgba(239,68,68,0.35);
                        border-radius: 9px;
                        background: rgba(239,68,68,0.12);
                        color: #fca5a5;
                        font-size: 12px;
                        font-weight: 600;
                        cursor: pointer;
                        box-shadow: none;
                        transition: all 0.2s ease;
                    "
                    onmouseover="
                        this.style.background='rgba(239,68,68,0.25)';
                        this.style.color='#ffffff';
                        this.style.borderColor='rgba(239,68,68,0.60)';
                    "
                    onmouseout="
                        this.style.background='rgba(239,68,68,0.12)';
                        this.style.color='#fca5a5';
                        this.style.borderColor='rgba(239,68,68,0.35)';
                    "
                >
                    <i
                        class="fas fa-sign-out-alt"
                        style="font-size: 13px;"
                    ></i>

                    Logout
                </button>

            </form>

        </div>

    </div>
</div>
