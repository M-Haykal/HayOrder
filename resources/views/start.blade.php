<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/bootstrapcss') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <title>Welcome | HayOrder</title>
</head>

<body class="bg-light d-flex align-items-center" style="min-height: 100vh;">

    <div class="container">
        <div class="row align-items-center">

            <!-- Kolom Gambar -->
            <div class="col-lg-6 text-center mb-4 mb-lg-0">
                <img src="{{ asset('img/order-food.png') }}" alt="Order Food" class="img-fluid"
                    style="max-width: 350px;">
            </div>

            <!-- Kolom Teks -->
            <div class="col-lg-6 text-center text-lg-start">
                <h1 class="fw-bold mb-3">Welcome to <span class="text-success">HayOrder</span></h1>
                <p class="lead text-muted">Restaurant menu ordering system.</p>
                @guest
                    <p class="mb-4">Please log in first to register your restaurant.</p>
                    <a href="{{ route('login') }}" class="btn btn-danger btn-lg px-4">Login</a>
                @else
                    @php
                        $restaurant = auth()->user()->restaurants()->latest()->first();
                    @endphp
                    @if (!$restaurant)
                        <p class="mb-4">Hello {{ auth()->user()->name }}! entrust your restaurant's ordering system to us.
                        </p>
                        <button type="button" class="btn btn-primary btn-lg" data-bs-toggle="modal"
                            data-bs-target="#createRestaurant">Create Restaurant</button>
                    @elseif ($restaurant->restaurantDocuments->count() == 0)
                        <p class="mb-4">Hello {{ auth()->user()->name }}! please upload your restaurant documents.</p>
                        <a href="{{ route('owner.dashboard.documents', ['restaurant' => $restaurant->slug]) }}"
                            class="btn btn-success btn-lg">Go to Document</a>
                    @else
                        <p class="mb-4">Hello {{ auth()->user()->name }}! here's how to access your restaurant dashboard.
                        </p>
                        <a href="{{ route('owner.dashboard.home', ['restaurant' => $restaurant->slug]) }}"
                            class="btn btn-success btn-lg">Go to Dashboard</a>
                    @endif
                @endguest
            </div>

        </div>
    </div>

    <div class="modal fade" id="createRestaurant" tabindex="-1" aria-labelledby="createRestaurantLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="createRestaurantLabel">Create Restaurant</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('restaurant.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name_restaurant" class="form-label">Restaurant Name</label>
                            <input type="text" class="form-control @error('name_restaurant') is-invalid @enderror"
                                id="name_restaurant" name="name_restaurant" value="{{ old('name_restaurant') }}"
                                required>
                            @error('name_restaurant')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Restaurant Address</label>
                            <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address" rows="3">{{ old('address') }}</textarea>
                            @error('address')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- <script src="{{ asset('js/bootstrap.js') }}"></script> --}}
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
</body>

</html>
