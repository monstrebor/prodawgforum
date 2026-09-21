<div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">

        <form id="editForm" class="modal-content" method="POST" action="{{ route('admin.update-user') }}" style="
                    border: none;
                    border-radius: 15px;
                    overflow: hidden;
                ">

            @csrf

            <div class="modal-header" style="
                        background: #111827;
                        color: #ffffff;
                        border: none;
                    ">

                <h5 class="modal-title">
                    <i class="fas fa-user-edit"></i>
                    Edit User
                </h5>

                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>

            </div>


            <div class="modal-body">

                <input type="hidden" name="id" id="editUserId">


                <div class="mb-3">

                    <label for="editName" class="form-label">
                        Name
                    </label>

                    <input type="text" id="editName" name="name" class="form-control">

                </div>


                <div class="mb-3">

                    <label for="editEmail" class="form-label">
                        Email
                    </label>

                    <input type="email" id="editEmail" name="email" class="form-control">

                </div>

            </div>


            <div class="modal-footer" style="
                        border-top: 1px solid #e5e7eb;
                    ">

                <button type="submit" class="btn btn-success">
                    <i class="fas fa-save"></i>
                    Save Changes
                </button>

                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    Cancel
                </button>

            </div>

        </form>

    </div>

</div>
