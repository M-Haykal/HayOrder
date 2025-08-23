<div class="modal fade" id="editCashier{{ $cashier->id }}" tabindex="-1" aria-labelledby="editCashierLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="editCashierLabel">Modal Edit Cashier {{ $cashier->username }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('owner.dashboard.cashier.update', [$restaurant->slug, $cashier->id]) }}"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" name="username" id="username" class="form-control"
                            value="{{ old('username', $cashier->username) }}" required>
                        @error('username')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="nik" class="form-label">NIK (jika diubah, otomatis jadi password baru)</label>
                        <input type="text" name="nik" id="nik" class="form-control">
                        @error('nik')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="image_staff" class="form-label">Foto Staff</label><br>

                        @if ($cashier->image_staff)
                            <img src="{{ asset('storage/' . $cashier->image_staff) }}" alt="Staff Photo" width="100"
                                class="mb-2 rounded border"><br>
                        @endif

                        <input type="file" name="image_staff" id="image_staff" class="form-control">
                        @error('image_staff')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-success">Save Update</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
