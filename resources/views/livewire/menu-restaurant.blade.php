    <div>
        <div class="title-menu d-flex justify-content-between align-items-center">
            <div class="name-restaurant">
                <h1 class="text-xl font-bold">{{ $restaurant->name_restaurant }}</h1>
                <p>{{ $restaurant->address }}</p>
            </div>
            <h2>Table: {{ $tables->table_number }}</h2>
        </div>

        <div class="row row-cols-1 row-cols-md-3 g-4">
            @foreach ($menus as $menu)
                <div class="col">
                    <div class="card" data-aos="fade-right">
                        @if ($menu->image_menu)
                            <div id="carouselExampleInterval{{ $menu->id }}" class="carousel slide"
                                data-bs-ride="carousel">
                                <div class="carousel-inner">
                                    @foreach (json_decode($menu->image_menu) as $index => $img)
                                        <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                            <img src="{{ asset('storage/' . $img) }}" class="d-block w-100 card-img-top"
                                                alt="{{ $menu->name }}" width="80" loading="lazy">
                                        </div>
                                    @endforeach
                                </div>
                                <button class="carousel-control-prev" type="button"
                                    data-bs-target="#carouselExampleInterval{{ $menu->id }}" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button"
                                    data-bs-target="#carouselExampleInterval{{ $menu->id }}" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                        @else
                            <span class="text-muted">No Image</span>
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $menu->name }}</h5>
                            <p class="card-text">{{ $menu->description }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
