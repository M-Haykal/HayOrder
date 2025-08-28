<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Menu {{ $restaurant->name_restaurant }}</title>
</head>

<body>
    <div class="hero-section text-center">
        <div class="container">
            <img class="d-block mx-auto mb-4 bg-white p-2" src="{{ asset('img/logo_hayorder.png') }}"
                alt="" width="80">
            <h1 class="display-5 fw-bold">Welcome to</h1>
            <h2 class="fw-bold">{{ $restaurant->name_restaurant }}</h2>
            <p class="lead">
                <i class="fas fa-map-marker-alt me-2"></i> {{ $restaurant->address }}
            </p>
        </div>
    </div>

    <div class="container mb-4">
        <div class="d-flex flex-wrap justify-content-center gap-2 mb-4" id="categoryFilters">
            <span
                class="badge category-badge active d-flex align-items-center p-2 pe-3 text-secondary-emphasis bg-secondary-subtle border border-secondary-subtle rounded-pill"
                data-category="all">
                <i class="fas fa-utensils rounded-circle me-2 bg-white p-1"></i>All Menu
            </span>
            @foreach ($categories as $category)
                <span
                    class="badge category-badge d-flex align-items-center p-2 pe-3 text-secondary-emphasis bg-secondary-subtle border border-secondary-subtle rounded-pill"
                    data-category="{{ $category->id }}">
                    <img class="rounded-circle me-2" width="24" height="24"
                        src="{{ asset('storage/' . $category->image_category) }}" alt="">{{ $category->name }}
                </span>
            @endforeach
        </div>

        <div class="row">
            <div class="col-lg-8 col-md-7 list-menu">
                <h3 class="section-title">Our Delicious Menu</h3>
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4" id="menuContainer">
                    @foreach ($menus as $menu)
                        <div class="col menu-item" data-category="{{ $menu->category_id }}">
                            <a data-bs-toggle="modal" data-bs-target="#detailMenu{{ $menu->id }}"
                                style="cursor: pointer; text-decoration: none;">
                                <div class="card menu-card h-100">
                                    @if ($menu->image_menu)
                                        <img src="{{ asset('storage/' . json_decode($menu->image_menu)[0]) }}"
                                            alt="{{ $menu->name }}" class="card-img-top">
                                    @else
                                        <div class="card-img-top d-flex align-items-center justify-content-center bg-light"
                                            style="height: 180px;">
                                            <span class="text-muted"><i class="fas fa-image fa-3x"></i></span>
                                        </div>
                                    @endif
                                    <div class="card-body d-flex flex-column">
                                        <div class="d-flex justify-content-between align-items-start mb-2">
                                            <h5 class="card-title mb-0">{{ $menu->name }}</h5>
                                            <span
                                                class="badge bg-primary menu-category-badge">{{ $menu->category->name }}</span>
                                        </div>
                                        <p class="card-text text-muted small flex-grow-1">
                                            {{ Str::limit($menu->description, 80) }}</p>
                                        <div class="d-flex justify-content-between align-items-center mt-2">
                                            <span class="fw-bold text-primary">Rp.
                                                {{ number_format($menu->price, 0, ',', '.') }}</span>
                                            <button class="btn btn-sm btn-outline-primary add-to-order"
                                                data-menu-id="{{ $menu->id }}"
                                                data-menu-price="{{ $menu->price }}">
                                                <i class="fas fa-plus"></i> Add
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
                <nav aria-label="...">
                    <ul class="pagination mb-0 d-flex justify-content-center mt-3">
                        <li class="page-item disabled">
                            <span class="page-link"><i class="fa-solid fa-arrow-left"></i></span>
                        </li>
                        @for ($i = 1; $i <= $menus->lastPage(); $i++)
                            <li class="page-item {{ $i == $menus->currentPage() ? 'active' : '' }}">
                                <a class="page-link" href="{{ $menus->url($i) }}">{{ $i }}</a>
                            </li>
                        @endfor
                        <li class="page-item">
                            <a class="page-link" href="#"><i class="fa-solid fa-arrow-right"></i></a>
                        </li>
                    </ul>
                </nav>
            </div>

            <div class="col-lg-4 col-md-5 list-order">
                <h3 class="section-title">Your Order</h3>
                <div class="card order-card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="card-title mb-0">Order Summary</h5>
                            <span class="badge bg-primary" id="itemCount">0 items</span>
                        </div>

                        <div class="order-items-container" style="max-height: 300px; overflow-y: auto;">
                            <ul class="order-items list-unstyled"></ul>
                        </div>

                        <div class="order-total fw-bold d-flex justify-content-between">
                            <span>Subtotal:</span>
                            <span id="subtotal">Rp. 0</span>
                        </div>

                        <div class="tax-order fw-bold d-flex justify-content-between">
                            <span>Tax (10%):</span>
                            <span id="tax">Rp. 0</span>
                        </div>

                        <div class="total-after-tax fw-bold d-flex justify-content-between">
                            <span>Total after Tax:</span>
                            <span id="totalAfterTax">Rp. 0</span>
                        </div>

                        <div class="mt-4">
                            <div class="mb-3">
                                <label for="NameCustomer" class="form-label">Your Name</label>
                                <input type="text" class="form-control" placeholder="Enter your name"
                                    id="NameCustomer" name="NameCustomer">
                            </div>

                            <div class="mb-3">
                                <label for="NoteOrder" class="form-label">Order Notes (Optional)</label>
                                <textarea class="form-control" name="NoteOrder" id="NoteOrder" rows="3"
                                    placeholder="Special requests, allergies, etc."></textarea>
                            </div>

                            <button type="button" class="btn btn-primary btn-place-order w-100">
                                <i class="fas fa-shopping-cart me-2"></i>Place Order
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @foreach ($menus as $menu)
        @include('user.modals.detail-menu', ['menu' => $menu])
    @endforeach

    <script src="{{ asset('libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready(function() {
            let orderItems = [];
            const TAX_RATE = 0.1;

            function renderOrderItems() {
                let orderItemsContainer = $('.order-items');
                orderItemsContainer.empty();

                let subtotal = 0;
                let itemCount = 0;

                if (orderItems.length === 0) {
                    orderItemsContainer.html('<li class="text-center text-muted py-3">Your order is empty</li>');
                } else {
                    orderItems.forEach(function(item, index) {
                        let itemTotal = item.price * item.quantity;
                        subtotal += itemTotal;
                        itemCount += item.quantity;

                        let orderItemHtml = `
                            <li class="order-item">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <div class="fw-bold">${item.name}</div>
                                        <small class="text-muted">Rp. ${item.price.toLocaleString('id-ID')} x ${item.quantity}</small>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <button class="btn btn-sm btn-outline-secondary decrease-qty" data-index="${index}">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                        <span class="mx-2 fw-bold">${item.quantity}</span>
                                        <button class="btn btn-sm btn-outline-secondary increase-qty" data-index="${index}">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-danger remove-item ms-2" data-index="${index}">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </li>
                        `;
                        orderItemsContainer.append(orderItemHtml);
                    });
                }

                let tax = subtotal * TAX_RATE;
                let totalAfterTax = subtotal + tax;

                $('#subtotal').text('Rp. ' + subtotal.toLocaleString('id-ID'));
                $('#tax').text('Rp. ' + tax.toLocaleString('id-ID'));
                $('#totalAfterTax').text('Rp. ' + totalAfterTax.toLocaleString('id-ID'));
                $('#itemCount').text(itemCount + ' item' + (itemCount !== 1 ? 's' : ''));
            }

            $('.btn-primary[data-menu-id]').on('click', function() {
                let menuId = $(this).data('menu-id');
                let menuPrice = parseFloat($(this).data('menu-price'));
                let menuName = $(this).closest('.modal-content').find('.modal-title').text().replace(
                    'Detail Menu ', '');

                let existingItemIndex = orderItems.findIndex(item => item.id === menuId);

                if (existingItemIndex !== -1) {
                    orderItems[existingItemIndex].quantity += 1;
                } else {
                    orderItems.push({
                        id: menuId,
                        name: menuName,
                        price: menuPrice,
                        quantity: 1
                    });
                }

                renderOrderItems();

                showNotification('Item added to order!', 'success');
            });

            $('.add-to-order').on('click', function(e) {
                e.preventDefault();

                let menuId = $(this).data('menu-id');
                let menuPrice = parseFloat($(this).data('menu-price'));
                let menuName = $(this).closest('.card').find('.card-title').text();

                let existingItemIndex = orderItems.findIndex(item => item.id === menuId);

                if (existingItemIndex !== -1) {
                    orderItems[existingItemIndex].quantity += 1;
                } else {
                    orderItems.push({
                        id: menuId,
                        name: menuName,
                        price: menuPrice,
                        quantity: 1
                    });
                }

                renderOrderItems();

                showNotification('Item added to order!', 'success');
            });

            $(document).on('click', '.decrease-qty', function() {
                let index = $(this).data('index');
                if (orderItems[index].quantity > 1) {
                    orderItems[index].quantity -= 1;
                    renderOrderItems();
                }
            });

            $(document).on('click', '.increase-qty', function() {
                let index = $(this).data('index');
                orderItems[index].quantity += 1;
                renderOrderItems();
            });

            $(document).on('click', '.remove-item', function() {
                let index = $(this).data('index');
                orderItems.splice(index, 1);
                renderOrderItems();
                showNotification('Item removed from order', 'info');
            });

            $('.btn-place-order').on('click', function() {
                let customerName = $('#NameCustomer').val().trim();
                let noteOrder = $('#NoteOrder').val().trim();

                if (orderItems.length === 0) {
                    showNotification('Please add at least one item to your order.', 'warning');
                    return;
                }

                if (!customerName) {
                    showNotification('Please enter your name.', 'warning');
                    $('#NameCustomer').focus();
                    return;
                }

                let subtotal = 0;
                orderItems.forEach(item => {
                    subtotal += item.price * item.quantity;
                });
                let tax = subtotal * TAX_RATE;
                let totalAfterTax = subtotal + tax;

                let orderData = {
                    name: customerName,
                    note_order: noteOrder,
                    subtotal: subtotal,
                    tax: tax,
                    total_after_tax: totalAfterTax,
                    items: orderItems.map(item => ({
                        menu_id: item.id,
                        quantity: item.quantity,
                        price: item.price
                    }))
                };

                let btnText = $(this).html();
                $(this).html('<span class="spinner-border spinner-border-sm me-2"></span>Processing...')
                    .prop('disabled', true);

                $.ajax({
                    url: '{{ route('user.menu.store', ['restaurant' => $restaurant->slug, 'table' => $table->id]) }}',
                    method: 'POST',
                    data: orderData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        showNotification('Order placed successfully!', 'success');
                        orderItems = [];
                        renderOrderItems();
                        $('#NameCustomer').val('');
                        $('#NoteOrder').val('');
                        $('.modal').modal('hide');

                        $('.btn-place-order').html(btnText).prop('disabled', false);
                    },
                    error: function(xhr) {
                        let errorMessage = 'Error placing order. Please try again.';

                        if (xhr.responseJSON && xhr.responseJSON.errors) {
                            let errors = xhr.responseJSON.errors;
                            errorMessage = Object.values(errors).flat().join('\n');
                        } else if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMessage = xhr.responseJSON.message;
                        }

                        showNotification(errorMessage, 'danger');
                        console.error(xhr.responseText);

                        $('.btn-place-order').html(btnText).prop('disabled', false);
                    }
                });
            });

            $('.category-badge').on('click', function() {
                $('.category-badge').removeClass('active');
                $(this).addClass('active');

                let selectedCategory = $(this).data('category');

                if (selectedCategory === 'all') {
                    $('.menu-item').fadeIn();
                } else {
                    $('.menu-item').hide();

                    $(`.menu-item[data-category="${selectedCategory}"]`).fadeIn();
                }
            });

            function showNotification(message, type) {
                let notification = $(`
                    <div class="alert alert-${type} alert-dismissible fade show position-fixed" style="top: 20px; right: 20px; z-index: 9999; min-width: 300px;" role="alert">
                        ${message}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                `);

                $('body').append(notification);

                setTimeout(function() {
                    notification.alert('close');
                }, 3000);
            }

            renderOrderItems();
        });

        document.addEventListener('contextmenu', event => event.preventDefault());

        // Disable F12, Ctrl+Shift+I, Ctrl+U dll.
        document.onkeydown = function(e) {
            if (e.keyCode == 123) { // F12
                return false;
            }
            if (e.ctrlKey && e.shiftKey && (e.keyCode == 'I'.charCodeAt(0) || e.keyCode == 'C'.charCodeAt(0) || e
                    .keyCode == 'J'.charCodeAt(0))) {
                return false;
            }
            if (e.ctrlKey && e.keyCode == 'U'.charCodeAt(0)) { // Ctrl+U
                return false;
            }
        };
    </script>
</body>

</html>
