<div class="modal fade" id="detailMenu{{ $menu->id }}" tabindex="-1" aria-labelledby="detailMenuLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="detailMenuLabel">Detail Menu {{ $menu->name }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>Description:</strong> {{ $menu->description }}</p>
                <p><strong>Price:</strong> Rp. {{ number_format($menu->price) }}</p>
                <p><strong>Category:</strong> {{ $menu->category->name }}</p>
                <div>
                    <strong>Images:</strong>
                    <div class="d-flex flex-wrap gap-2 mt-2">
                        @if ($menu->image_menu)
                            @foreach (json_decode($menu->image_menu) as $img)
                                <img src="{{ asset('storage/' . $img) }}" alt="{{ $menu->name }}"
                                    width="100" class="img-thumbnail">
                            @endforeach
                        @else
                            <span class="text-muted">No Image</span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Order</button>
            </div>
        </div>
    </div>
</div>
