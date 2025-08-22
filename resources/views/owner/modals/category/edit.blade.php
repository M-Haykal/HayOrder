<div class="modal fade" id="editCategory{{ $category->id }}" tabindex="-1" aria-labelledby="editCategoryLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="editCategoryLabel">Modal Edit Category {{ $category->name }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('owner.dashboard.category.update', [$restaurant->slug, $category->id]) }}" method="post">
                    @csrf
                    @method('put')
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $category->name) }}" required placeholder="Input Category Name">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="image_category" class="form-label">Image Category (optional)</label>
                        <input type="file" class="form-control @error('image_category') is-invalid @enderror" id="image_category" name="image_category">
                        @error('image_category')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="mt-2">
                            <small>Icon now</small>
                            <img src="{{ asset('storage/' . $category->image_category) }}" alt="{{ $category->name }}" width="80" class="img-thumbnail">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-warning">Save changes</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
