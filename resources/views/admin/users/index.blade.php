@extends('admin.layout.layout')

@section('title', 'Add User Page')

@section('script')

@endsection

@section('content')

    <!-- NAVBAR -->
    @include('admin.partials.navbar')

    <!-- SIDEBAR -->
    @include('admin.partials.sidebar')


    <!-- MAIN PAGE CONTENT -->
    <div
        style="
            margin-left: 250px;
            padding-top: 60px;
            width: calc(100% - 250px);
            min-height: 100vh;
            background: #f5f7fb;
            box-sizing: border-box;
        "
    >

        <div
            style="
                width: 100%;
                max-width: 1400px;
                margin: 0 auto;
                padding: 30px;
                box-sizing: border-box;
            "
        >

            <!-- CARD -->
            <div
                style="
                    background: #ffffff;
                    border: 1px solid #e5e7eb;
                    border-radius: 16px;
                    box-shadow: 0 5px 20px rgba(0,0,0,0.06);
                    padding: 25px;
                    overflow: hidden;
                "
            >

                <!-- NOTIFICATIONS -->
                <div style="margin-bottom: 20px;">
                    @include('layout.all_notif')
                </div>


                <!-- HEADER -->
                <div
                    style="
                        display: flex;
                        align-items: center;
                        justify-content: space-between;
                        gap: 15px;
                        margin-bottom: 25px;
                        flex-wrap: wrap;
                    "
                >

                    <div>
                        <h1
                            style="
                                margin: 0;
                                color: #111827;
                                font-size: 26px;
                                font-weight: 700;
                            "
                        >
                            User Table
                        </h1>

                        <p
                            style="
                                margin: 5px 0 0;
                                color: #6b7280;
                                font-size: 13px;
                            "
                        >
                            Manage registered users and their roles.
                        </p>
                    </div>


                    <!-- ADD USER -->
                    <button
                        type="button"
                        class="btn"
                        data-bs-toggle="modal"
                        data-bs-target="#registerModal"
                        style="
                            display: flex;
                            align-items: center;
                            gap: 7px;
                            background: #6366f1;
                            border: none;
                            color: #ffffff;
                            padding: 10px 16px;
                            border-radius: 9px;
                            font-size: 14px;
                            font-weight: 600;
                            box-shadow: 0 4px 10px rgba(99,102,241,0.25);
                            transition: all 0.2s ease;
                        "
                        onmouseover="
                            this.style.background='#4f46e5';
                            this.style.transform='translateY(-1px)';
                        "
                        onmouseout="
                            this.style.background='#6366f1';
                            this.style.transform='translateY(0)';
                        "
                    >
                        <i class="fas fa-plus"></i>
                        Add User
                    </button>

                </div>


                <!-- TABLE WRAPPER -->
                <div
                    style="
                        width: 100%;
                        overflow-x: auto;
                        border: 1px solid #e5e7eb;
                        border-radius: 10px;
                    "
                >

                    <table
                        style="
                            width: 100%;
                            min-width: 750px;
                            border-collapse: collapse;
                            font-size: 14px;
                            color: #374151;
                        "
                    >

                        <thead>
                            <tr
                                style="
                                    background: #111827;
                                    color: #ffffff;
                                "
                            >
                                <th
                                    style="
                                        padding: 13px 15px;
                                        border-bottom: 1px solid #374151;
                                        text-align: center;
                                        font-weight: 600;
                                    "
                                >
                                    #
                                </th>

                                <th
                                    style="
                                        padding: 13px 15px;
                                        border-bottom: 1px solid #374151;
                                        text-align: left;
                                        font-weight: 600;
                                    "
                                >
                                    Name
                                </th>

                                <th
                                    style="
                                        padding: 13px 15px;
                                        border-bottom: 1px solid #374151;
                                        text-align: left;
                                        font-weight: 600;
                                    "
                                >
                                    Email
                                </th>

                                <th
                                    style="
                                        padding: 13px 15px;
                                        border-bottom: 1px solid #374151;
                                        text-align: center;
                                        font-weight: 600;
                                    "
                                >
                                    Role
                                </th>

                                <th
                                    style="
                                        padding: 13px 15px;
                                        border-bottom: 1px solid #374151;
                                        text-align: center;
                                        font-weight: 600;
                                    "
                                >
                                    Actions
                                </th>
                            </tr>
                        </thead>


                        <tbody>

                            @forelse($users as $user)

                                <tr
                                    style="
                                        background: #ffffff;
                                        border-bottom: 1px solid #e5e7eb;
                                    "
                                    onmouseover="this.style.background='#f9fafb'"
                                    onmouseout="this.style.background='#ffffff'"
                                >

                                    <td
                                        style="
                                            padding: 13px 15px;
                                            text-align: center;
                                        "
                                    >
                                        {{ $user->id }}
                                    </td>


                                    <td
                                        style="
                                            padding: 13px 15px;
                                            font-weight: 600;
                                            color: #111827;
                                        "
                                    >
                                        {{ $user->name }}
                                    </td>


                                    <td
                                        style="
                                            padding: 13px 15px;
                                            color: #6b7280;
                                        "
                                    >
                                        {{ $user->email }}
                                    </td>


                                    <td
                                        style="
                                            padding: 13px 15px;
                                            text-align: center;
                                        "
                                    >

                                        @foreach ($user->roles as $role)

                                            <span
                                                style="
                                                    display: inline-block;
                                                    background: #eef2ff;
                                                    color: #4f46e5;
                                                    padding: 5px 10px;
                                                    border-radius: 999px;
                                                    font-size: 12px;
                                                    font-weight: 600;
                                                    margin: 2px;
                                                "
                                            >
                                                {{ $role->name }}
                                            </span>

                                        @endforeach

                                    </td>


                                    <td
                                        style="
                                            padding: 13px 15px;
                                            text-align: center;
                                        "
                                    >

                                        <div
                                            style="
                                                display: flex;
                                                align-items: center;
                                                justify-content: center;
                                                gap: 7px;
                                            "
                                        >

                                            <!-- EDIT -->
                                            <button
                                                type="button"
                                                class="editBtn"
                                                data-id="{{ $user->id }}"
                                                data-name="{{ $user->name }}"
                                                data-email="{{ $user->email }}"
                                                data-bs-toggle="modal"
                                                data-bs-target="#editModal"
                                                style="
                                                    display: inline-flex;
                                                    align-items: center;
                                                    gap: 5px;
                                                    border: none;
                                                    background: #e0e7ff;
                                                    color: #4338ca;
                                                    padding: 7px 11px;
                                                    border-radius: 7px;
                                                    font-size: 12px;
                                                    font-weight: 600;
                                                    cursor: pointer;
                                                "
                                            >
                                                <i class="fas fa-edit"></i>
                                                Edit
                                            </button>


                                            <!-- DELETE -->
                                            <form
                                                action=""
                                                method="POST"
                                                style="margin: 0;"
                                            >
                                                @csrf

                                                @method('DELETE')

                                                <button
                                                    type="submit"
                                                    style="
                                                        display: inline-flex;
                                                        align-items: center;
                                                        gap: 5px;
                                                        border: none;
                                                        background: #fee2e2;
                                                        color: #dc2626;
                                                        padding: 7px 11px;
                                                        border-radius: 7px;
                                                        font-size: 12px;
                                                        font-weight: 600;
                                                        cursor: pointer;
                                                    "
                                                >
                                                    <i class="fas fa-trash"></i>
                                                    Delete
                                                </button>
                                            </form>

                                        </div>

                                    </td>

                                </tr>

                            @empty

                                <tr>
                                    <td
                                        colspan="5"
                                        style="
                                            padding: 40px;
                                            text-align: center;
                                            color: #9ca3af;
                                        "
                                    >
                                        <i
                                            class="fas fa-users"
                                            style="
                                                font-size: 30px;
                                                display: block;
                                                margin-bottom: 10px;
                                            "
                                        ></i>

                                        No users found.
                                    </td>
                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>


    <!-- ===================================================== -->
    <!-- REGISTER USER MODAL -->
    <!-- ===================================================== -->

    <div
        class="modal fade"
        id="registerModal"
        tabindex="-1"
        aria-labelledby="registerModalLabel"
        aria-hidden="true"
    >
        <div class="modal-dialog modal-dialog-centered modal-md">

            <div
                class="modal-content"
                style="
                    border: none;
                    border-radius: 16px;
                    overflow: hidden;
                    background: linear-gradient(135deg, #4338ca, #dbeafe);
                    box-shadow: 0 20px 50px rgba(0,0,0,0.25);
                "
            >

                <div
                    class="modal-header"
                    style="
                        border: none;
                        padding: 20px 24px;
                    "
                >

                    <h5
                        class="modal-title"
                        id="registerModalLabel"
                        style="
                            color: #ffffff;
                            font-weight: 700;
                        "
                    >
                        <i class="fas fa-user-plus"></i>
                        Register User
                    </h5>

                    <button
                        type="button"
                        class="btn-close btn-close-white"
                        data-bs-dismiss="modal"
                        aria-label="Close"
                    ></button>

                </div>


                <div
                    class="modal-body"
                    style="padding: 24px;"
                >

                    @include('layout.all_notif')

                    @include('admin.users.partials._create')

                </div>

            </div>

        </div>
    </div>

    @include('admin.users.partials._edit')

    <script src="{{ asset('js/adminIndex.js') }}"></script>

@endsection
