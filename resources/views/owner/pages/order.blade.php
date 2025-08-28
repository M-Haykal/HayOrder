@extends('owner.layout.index')

@section('title', 'Order | ' . auth()->user()->restaurants->first()->name_restaurant)
@section('content')

    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Order</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                        <li class="breadcrumb-item active">Order</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Data Order {{ $restaurant->name_restaurant }}</h4>
            <p class="card-title-desc">Data your order for the restaurant.</p>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table mb-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name Customer</th>
                            <th>Code Order</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($orders as $index => $order)
                            <tr>
                                <th scope="row">{{ $index + 1 }}</th>
                                <th>{{ $order->name }}</th>
                                <th>{{ $order->code_order }}</th>
                                <td>{{ $order->status }}</td>   
                                <td>
                                    <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal"
                                        data-bs-target="#detailOrder{{ $order->id }}">Detail</button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted">No orders found.</td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>

        </div>
        <!-- end card body -->
    </div>

    @foreach ($orders as $order)
        @include('owner.modals.order.detail-order', ['restauran' => $restaurant, 'order' => $order])
    @endforeach
@endsection
