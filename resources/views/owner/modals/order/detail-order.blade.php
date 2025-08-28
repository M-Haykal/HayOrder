<div class="modal fade" id="detailOrder{{ $order->id }}" tabindex="-1" aria-labelledby="detailOrderLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="editCategoryLabel">Modal Detail Order {{ $order->name }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><strong>Name:</strong> {{ $order->name }}</li>
                    <li class="list-group-item"><strong>Items:</strong>
                        <ul class="list-unstyled ms-3">
                            @foreach ($order->items as $item)
                                <li>{{ $item->menu->name }} (x{{ $item->quantity }})</li>
                            @endforeach
                        </ul>
                    </li>
                    <li class="list-group-item"><strong>Code Order:</strong> {{ $order->code_order }}</li>
                    <li class="list-group-item"><strong>Total Price:</strong> Rp. {{ number_format($order->total_price) }}</li>
                    <li class="list-group-item"><strong>Status:</strong> {{ $order->status }}</li>
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
