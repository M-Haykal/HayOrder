<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Bootstrap Css -->
    <link href="{{ asset('css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <title>Menu {{ $restaurant->name_restaurant }}</title>
</head>

<body>
    <div class="p-3 my-5 text-center"> <img class="d-block mx-auto mb-4" src="{{ asset('img/logo_hayorder.png') }}"
            alt="" width="72">
        <h1>Welcome in</h1>
        <h2 class=" fw-bold text-body-emphasis">{{ $restaurant->name_restaurant }}</h2>
        <p class="lead">{{ $restaurant->address }}</p>
    </div>

    <div class="d-flex gap-2 justify-content-center">
        <span
            class="badge d-flex align-items-center p-1 pe-2 text-secondary-emphasis bg-secondary-subtle border border-secondary-subtle rounded-pill">
            <img class="rounded-circle me-1" width="24" height="24" src="https://github.com/mdo.png"
                alt="">All Menu
        </span>
        @foreach ($categories as $category)
            <span
                class="badge d-flex align-items-center p-1 pe-2 text-secondary-emphasis bg-secondary-subtle border border-secondary-subtle rounded-pill">
                <img class="rounded-circle me-1" width="24" height="24"
                    src="{{ asset('storage/' . $category->image_category) }}" alt="">{{ $category->name }}
            </span>
        @endforeach
    </div>
    <div class="container list-menu">
        <h1>List Menu</h1>
        <div class="row row-cols-1 row-cols-md-3 g-4">
            @foreach ($menus as $menu)
                <div class="col">
                    <a data-bs-toggle="modal" data-bs-target="#detailMenu{{ $menu->id }}" style="cursor: pointer;">
                        <div class="card">
                            @if ($menu->image_menu)
                                <img src="{{ asset('storage/' . json_decode($menu->image_menu)[0]) }}"
                                    alt="{{ $menu->name }}" width="80" class="card-img-top">
                            @else
                                <span class="text-muted">No Image</span>
                            @endif
                            <div class="card-body">
                                <h5 class="card-title">{{ $menu->name }}</h5>
                                <p class="card-text">{{ $menu->description }}</p><span
                                    class="badge d-flex align-items-center p-1 pe-2 text-secondary-emphasis bg-secondary-subtle border border-secondary-subtle rounded-pill">
                                    <img class="rounded-circle me-1" width="24" height="24"
                                        src="{{ asset('storage/' . $menu->category->image_category) }}"
                                        alt="">{{ $menu->category->name }}
                                </span>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>

    <button class="btn btn-primary position-fixed bottom-0 end-0 m-3" data-bs-toggle="modal"
        data-bs-target="#orderMenu">
        <i class="bi bi-plus"></i>
    </button>

    @include('user.modals.order')
    @foreach ($menus as $menu)
        @include('user.modals.detail-menu', ['menu' => $menu])
    @endforeach
    <script src="{{ asset('libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
