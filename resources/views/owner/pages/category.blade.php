@extends('owner.layout.index')

@section('title', 'Category | ' . auth()->user()->restaurants->first()->name_restaurant)
@section('content')

    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Category</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                        <li class="breadcrumb-item active">Category</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div class="text-header">
                <h4 class="card-title">Data Category {{ $restaurant->name_restaurant }}</h4>
                <p class="card-title-desc">Create and manage your categories for the restaurant.</p>
            </div>
            <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#createCategory">
                Create New Category
            </button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table mb-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Image Category</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($categories as $index => $category)
                            <tr>
                                <th scope="row">{{ $index + 1 }}</th>
                                <td>{{ $category->name }}</td>
                                <td>
                                    @if ($category->image_category)
                                        <img src="{{ asset('storage/' . $category->image_category) }}" alt="{{ $category->name }}"
                                            width="80" class="img-thumbnail">
                                    @else
                                        <span class="text-muted">No Image</span>
                                    @endif
                                </td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                        data-bs-target="#editCategory{{ $category->id }}">Edit</button>
                                    <form action="{{ route('owner.dashboard.category.destroy', [$restaurant->slug, $category->id]) }}" method="post" class="d-inline">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted">No categories found.</td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>

        </div>
        <!-- end card body -->
    </div>
    @include('owner.modals.category.store')
    @include('owner.modals.category.edit', ['restaurant' => $restaurant, 'categories' => $categories])
@endsection
