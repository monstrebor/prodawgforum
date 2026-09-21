<div>
    {{-- Stop trying to control. --}}
    @include('layout.all_notif')
    <form class="p-4 border rounded shadow-sm bg-light" wire:submit.prevent="change_password">
        <h1 class="mb-4 text-center flex justify-center">
            <span class="material-symbols-outlined">
                lock
            </span>
            <p class="font-bold">Change Password</p>
        </h1>

        <!-- Old Password -->
        <div class="mb-3 row align-items-center"> <label for="oldPassword" class="col-sm-3 col-form-label text-end">
                <span class="material-symbols-outlined"> vpn_key </span> Old Password </label>
            <div class="col-sm-9">
                <div class="position-relative"> <input wire:model="old_password" type="password"
                        class="form-control pe-5" id="oldPassword" placeholder="Enter your old password"> <button
                        type="button" onclick="togglePassword('oldPassword', this)" aria-label="Show old password"
                        style=" position: absolute; top: 50%; right: 10px; transform: translateY(-50%); border: none; background: transparent; padding: 5px; color: #6c757d; cursor: pointer; display: flex; align-items: center; justify-content: center; z-index: 5; outline: none; box-shadow: none; ">
                        <span class="material-symbols-outlined" style="font-size: 21px;">visibility</span> </button>
                </div> @error('old_password') <span class="text-danger small">{{ $message }}</span> @enderror
            </div>
        </div> <!-- New Password -->
        <div class="mb-3 row align-items-center"> <label for="newPassword" class="col-sm-3 col-form-label text-end">
                <span class="material-icons text-muted" style="font-size: 20px;"> password </span> New Password </label>
            <div class="col-sm-9">
                <div class="position-relative"> <input wire:model="new_password" type="password"
                        class="form-control pe-5" id="newPassword" placeholder="Enter your new password"> <button
                        type="button" onclick="togglePassword('newPassword', this)" aria-label="Show new password"
                        style=" position: absolute; top: 50%; right: 10px; transform: translateY(-50%); border: none; background: transparent; padding: 5px; color: #6c757d; cursor: pointer; display: flex; align-items: center; justify-content: center; z-index: 5; outline: none; box-shadow: none; ">
                        <span class="material-symbols-outlined" style="font-size: 21px;">visibility</span> </button>
                </div> @error('new_password') <span class="text-danger small">{{ $message }}</span> @enderror
            </div>
        </div>

        <!-- Submit Button -->
        <div class="text-center mt-4">
            <button type="submit" class="btn btn-primary btn-lg d-flex align-items-center gap-2 mx-auto">
                <span class="material-icons">send</span> Submit
            </button>
        </div>
    </form>
</div>

<script>
    function togglePassword(inputId, button) {
        const input = document.getElementById(inputId);
        
            const icon = button.querySelector('.material-symbols-outlined');

            if (input.type === 'password') { input.type = 'text';
                icon.textContent = 'visibility_off'; button.setAttribute('aria-label', 'Hide password');
            } else { input.type = 'password';
                icon.textContent = 'visibility';
                button.setAttribute('aria-label', 'Show password');
            }
        }
</script>
