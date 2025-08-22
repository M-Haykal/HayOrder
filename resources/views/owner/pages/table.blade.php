@extends('owner.layout.index')

@section('title', 'Table | ' . auth()->user()->restaurants->first()->name_restaurant)
@section('content')

    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Table</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                        <li class="breadcrumb-item active">Table</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div class="text-header">
                <h4 class="card-title">Data Table {{ $restaurant->name_restaurant }}</h4>
                <p>Create and manage your table for the restaurant.</p>
            </div>
            <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#createTable">
                Create New Table
            </button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table mb-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Table Number</th>
                            <th>Qr Code</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($tables as $index => $table)
                            <tr>
                                <th scope="row">{{ $index + 1 }}</th>
                                <td>{{ $table->table_number }}</td>
                                <td>
                                    @if ($table->qr_code_path)
                                        <img src="{{ asset('storage/' . $table->qr_code_path) }}"
                                            alt="{{ $table->table_number }}" width="80" class="">
                                    @else
                                        <span class="text-muted">No QR Code</span>
                                    @endif
                                </td>
                                <td>
                                    <form
                                        action="{{ route('owner.dashboard.tables.destroy', ['restaurant' => $restaurant->slug, 'table' => $table]) }}"
                                        method="post">
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

    @include('owner.modals.table.store')
@endsection
