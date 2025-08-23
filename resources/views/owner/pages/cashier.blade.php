@extends('owner.layout.index')

@section('title', 'Cashier | ' . auth()->user()->restaurants->first()->name_restaurant)
@section('content')

    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Cashier</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                        <li class="breadcrumb-item active">Cashier</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div class="text-header">
                <h4 class="card-title">Data Cashier {{ $restaurant->name_restaurant }}</h4>
                <p class="card-title-desc">Create and manage your cashiers for the restaurant.</p>
            </div>
            <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#createCashier">
                Create New Cashier
            </button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table mb-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Image Cashier</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($cashiers as $index => $cashier)
                            <tr>
                                <th scope="row">{{ $index + 1 }}</th>
                                <td>{{ $cashier->username }}</td>
                                <td>
                                    @if ($cashier->image_staff)
                                        <img src="{{ asset('storage/' . $cashier->image_staff) }}"
                                            alt="{{ $cashier->username }}" width="80" class="img-thumbnail">
                                    @else
                                        <span class="text-muted">No Image</span>
                                    @endif
                                </td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                        data-bs-target="#editCashier{{ $cashier->id }}">Edit</button>
                                    <form
                                        action="{{ route('owner.dashboard.cashier.destroy', [$restaurant->slug, $cashier->id]) }}"
                                        method="post" class="d-inline">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted">No cashiers found.</td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>

        </div>
        <!-- end card body -->
    </div>

    @include('owner.modals.cashier.store')
    @include('owner.modals.cashier.edit', ['restaurant' => $restaurant, 'cashiers' => $cashiers])
@endsection
