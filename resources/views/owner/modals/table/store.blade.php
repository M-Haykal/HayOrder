<div class="modal fade" id="createTable" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Modal Create Table Number</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('owner.dashboard.tables.store', $restaurant->slug) }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="table_number" class="form-label">Table Number</label>
                        <input type="number" class="form-control" id="table_number" name="table_number" required
                            placeholder="Input Table Number">
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
