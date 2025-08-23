<div class="modal fade" id="createMenu" tabindex="-1" aria-labelledby="createMenuLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="createMenuLabel">Modal Create Menu</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('owner.dashboard.menu.store', $restaurant->slug) }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                            name="name" required placeholder="Input Menu Name" value="{{ old('name') }}">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" required
                            placeholder="Input Menu Description">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Price</label>
                        <input type="number" class="form-control @error('price') is-invalid @enderror" id="price"
                            name="price" required placeholder="Input Menu Price" value="{{ old('price') }}">
                        @error('price')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="image_menu" class="form-label">Image Menu</label>
                        <input type="file" class="form-control @error('image_menu') is-invalid @enderror"
                            id="image_menu" name="image_menu[]" multiple>
                        @error('image_menu')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="mt-2" id="preview-image-menu">
                            @if (old('image_menu'))
                                @foreach (old('image_menu') as $image)
                                    <img src="{{ asset('storage/' . $image) }}" alt="Image Menu" width="100"
                                        class="img-thumbnail mt-2 mb-2">
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="category_id" class="form-label">Category</label>
                        <select class="form-select @error('category_id') is-invalid @enderror" id="category_id"
                            name="category_id" required>
                            <option value="" disabled selected>Select Category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
