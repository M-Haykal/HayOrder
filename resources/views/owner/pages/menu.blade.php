@extends('owner.layout.index')

@section('title', 'Menu | ' . auth()->user()->restaurants->first()->name_restaurant)
@section('content')

    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Menu</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                        <li class="breadcrumb-item active">Menu</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div class="text-header">
                <h4 class="card-title">Data Menu {{ $restaurant->name_restaurant }}</h4>
                <p class="card-title-desc">Create and manage your menu for the restaurant.</p>
            </div>
            <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#createMenu">
                Create New menu
            </button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table mb-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Price</th>
                            <th>Image Menu</th>
                            <th>Category</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($menus as $index => $menu)
                            <tr>
                                <th scope="row">{{ $index + 1 }}</th>
                                <td>{{ $menu->name }}</td>
                                <td>{{ $menu->description }}</td>
                                <td>Rp. {{ number_format($menu->price) }}</td>
                                <td>
                                    @if ($menu->image_menu)
                                        @foreach (json_decode($menu->image_menu) as $img)
                                            <img src="{{ asset('storage/' . $img) }}" alt="{{ $menu->name }}"
                                                width="80" class="img-thumbnail mb-1">
                                        @endforeach
                                    @else
                                        <span class="text-muted">No Image</span>
                                    @endif
                                </td>


                                <td>{{ $menu->category->name }}</td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                        data-bs-target="#editMenu{{ $menu->id }}">Edit</button>
                                    <form
                                        action="{{ route('owner.dashboard.menu.destroy', [$restaurant->slug, $menu->id]) }}"
                                        method="post" class="d-inline">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted">No menus found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <nav aria-label="...">
                    <ul class="pagination mb-0 d-flex justify-content-center mt-3">
                        <li class="page-item disabled">
                            <span class="page-link"><i class="mdi mdi-chevron-left"></i></span>
                        </li>
                        @for ($i = 1; $i <= $menus->lastPage(); $i++)
                            <li class="page-item {{ $i == $menus->currentPage() ? 'active' : '' }}">
                                <a class="page-link" href="{{ $menus->url($i) }}">{{ $i }}</a>
                            </li>
                        @endfor
                        <li class="page-item">
                            <a class="page-link" href="#"><i class="mdi mdi-chevron-right"></i></a>
                        </li>
                    </ul>
                </nav>
            </div>

        </div>
        <!-- end card body -->
    </div>
    @include('owner.modals.menu.store')
    @include('owner.modals.menu.edit', ['restaurant' => $restaurant, 'menus' => $menus, 'categories' => $categories])
    <script>
        let selectedFiles = [];

        function updatePreview() {
            const previewContainer = document.getElementById('preview-image-menu');
            previewContainer.innerHTML = '';

            selectedFiles.forEach((file, index) => {
                if (file.type.startsWith('image/')) {
                    const imgWrapper = document.createElement('div');
                    imgWrapper.classList.add('d-inline-block', 'position-relative', 'me-2', 'mb-2');

                    const img = document.createElement('img');
                    img.src = URL.createObjectURL(file);
                    img.alt = 'Preview Image Menu';
                    img.width = 100;
                    img.classList.add('img-thumbnail');

                    const removeBtn = document.createElement('button');
                    removeBtn.type = 'button';
                    removeBtn.classList.add('btn', 'btn-danger', 'btn-sm', 'position-absolute', 'top-0', 'end-0');
                    removeBtn.innerHTML = 'x';
                    removeBtn.onclick = () => {
                        selectedFiles.splice(index, 1);
                        updatePreview();
                        updateInputFiles();
                    };

                    imgWrapper.appendChild(img);
                    imgWrapper.appendChild(removeBtn);
                    previewContainer.appendChild(imgWrapper);
                }
            });
        }

        function updateInputFiles() {
            const input = document.getElementById('image_menu');
            const dataTransfer = new DataTransfer();
            selectedFiles.forEach(file => dataTransfer.items.add(file));
            input.files = dataTransfer.files;
        }

        document.getElementById('image_menu').addEventListener('change', function(event) {
            const newFiles = Array.from(event.target.files);

            newFiles.forEach(file => {
                if (selectedFiles.length >= 3) {
                    alert('Maksimal 3 gambar yang diizinkan!');
                    return;
                }
                if (file.type.startsWith('image/')) {
                    selectedFiles.push(file);
                } else {
                    alert('File harus berupa gambar!');
                }
            });
            event.target.value = '';

            updatePreview(); 
            updateInputFiles();
        });
    </script>
@endsection
