<div class="modal fade" id="createCashier" tabindex="-1" aria-labelledby="createCashierLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="createCashierLabel">Modal Create Cashier</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('owner.dashboard.cashier.store', $restaurant->slug) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label>Username</label>
                        <input type="text" name="username" class="form-control" value="{{ old('username') }}"
                            required>
                        @error('username')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label>NIK (akan dipakai sebagai password)</label>
                        <input type="text" name="nik" class="form-control" value="{{ old('nik') }}" required>
                        @error('nik')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label>Image Staff</label>
                        <input type="file" name="image_staff" class="form-control">
                        @error('image_staff')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Save create</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
