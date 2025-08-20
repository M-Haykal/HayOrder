@extends('owner.layout.index')

@section('title', 'Dashboard | ' . auth()->user()->restaurants->first()->name_restaurant)
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Dashboard</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Category</h5>
                    <p class="card-text">Total {{ $restaurant->categories_count ?? 0 }}</p>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Menu</h5>
                    <p class="card-text">Total {{ $restaurant->menus_count ?? 0 }}</p>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Table</h5>
                    <p class="card-text">Total {{ $restaurant->tables_count ?? 0 }}</p>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Order</h5>
                    <p class="card-text">Total {{ $restaurant->orders_count ?? 0 }}</p>
                </div>
            </div>
        </div>
    </div>

@endsection
