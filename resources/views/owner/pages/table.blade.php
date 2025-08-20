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
        <div class="card-header">
            <h4 class="card-title">Responsive table</h4>
            <p class="card-title-desc">
                Create responsive tables by wrapping any <code>.table</code> in
                <code>.table-responsive</code>
                to make them scroll horizontally on small devices (under 768px).
            </p>
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
                                        <img src="{{ asset('storage/' . $table->qr_code_path) }}" alt="{{ $table->table_number }}"
                                            width="80" class="img-thumbnail">
                                    @else
                                        <span class="text-muted">No QR Code</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-primary">Edit</a>
                                    <a href="#" class="btn btn-sm btn-danger">Delete</a>
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

    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createTable">
        Launch demo modal
    </button>

    @include('owner.modals.table.store')
@endsection
