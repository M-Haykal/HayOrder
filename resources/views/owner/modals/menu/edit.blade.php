<div class="modal fade" id="editMenu{{ $menu->id }}" tabindex="-1" aria-labelledby="editMenuLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="editMenuLabel">Edit Menu</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('owner.dashboard.menu.update', [$restaurant->slug, $menu->id]) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    {{-- Name --}}
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                            name="name" required value="{{ old('name', $menu->name) }}">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Description --}}
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" required>{{ old('description', $menu->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Price --}}
                    <div class="mb-3">
                        <label for="price" class="form-label">Price</label>
                        <input type="number" class="form-control @error('price') is-invalid @enderror" id="price"
                            name="price" required value="{{ old('price', $menu->price) }}">
                        @error('price')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Image Menu --}}
                    <div class="mb-3">
                        <label for="image_menu" class="form-label">Image Menu</label>
                        <input type="file" class="form-control @error('image_menu') is-invalid @enderror"
                            id="image_menu" name="image_menu[]" multiple>
                        @error('image_menu')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        {{-- Preview gambar lama --}}
                        <div class="mt-2" id="preview-image-menu">
                            @if ($menu->image_menu)
                                @foreach (json_decode($menu->image_menu) as $image)
                                    <img src="{{ asset('storage/' . $image) }}" alt="Image Menu" width="100"
                                        class="img-thumbnail mt-2 mb-2">
                                @endforeach
                            @endif
                        </div>
                    </div>

                    {{-- Category --}}
                    <div class="mb-3">
                        <label for="category_id" class="form-label">Category</label>
                        <select class="form-select @error('category_id') is-invalid @enderror" id="category_id"
                            name="category_id" required>
                            <option value="" disabled>Select Category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category_id', $menu->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Submit --}}
                    <button type="submit" class="btn btn-primary">Save Update</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
