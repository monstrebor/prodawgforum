<form id="register-form" method="POST" action="{{ route('store-user') }}">
    @csrf

    <select name="user_type" class="form-control" style="
                                margin-bottom: 14px;
                                padding: 11px;
                            ">
        <option value="" selected>
            Choose role
        </option>

        <option value="admin">
            Admin
        </option>

        <option value="user">
            User
        </option>
    </select>


    <input type="text" name="name" placeholder="Think of anonymous name..." class="form-control"
        value="{{ old('name') }}" required style="
                                margin-bottom: 14px;
                                padding: 11px;
                            ">

    @error('name')
    <span class="text-danger small">
        {{ $message }}
    </span>
    @enderror


    <input type="email" name="email" placeholder="Email, to whom may I send your password?" class="form-control"
        value="{{ old('email') }}" required style="
                                margin-bottom: 14px;
                                padding: 11px;
                            ">

    @error('email')
    <span class="text-danger small">
        {{ $message }}
    </span>
    @enderror


    <button type="submit" style="
                                width: 100%;
                                border: none;
                                background: #2563eb;
                                color: #ffffff;
                                padding: 12px;
                                border-radius: 8px;
                                font-weight: 600;
                                cursor: pointer;
                            ">
        <i class="fas fa-user-plus"></i>
        Register User
    </button>

</form>
