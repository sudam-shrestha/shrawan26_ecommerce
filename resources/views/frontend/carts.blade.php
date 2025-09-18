<x-frontend-layout>
    <div class="container py-12">
        <h1 class="text-4xl font-bold text-[var(--primary)] mb-8">Your Shopping Cart</h1>

        @if ($carts->isEmpty())
            <div class="text-center py-16 bg-white rounded-lg shadow-md">
                <p class="text-2xl text-[var(--text)] mb-4">Your cart is empty.</p>
                <a href="{{ route('home') }}"
                    class="inline-block bg-[var(--secondary)] text-white px-8 py-3 rounded-full hover:bg-opacity-80 transition duration-300 font-medium">
                    Shop Now
                </a>
            </div>
        @else
            @foreach ($carts->groupBy('product.shop_id') as $shopId => $shopCarts)
                <div class="mb-16 bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-2xl font-semibold text-[var(--primary)] mb-6">
                        {{ $shopCarts->first()->product->shop->name }}
                    </h2>
                    <div class="overflow-x-auto">
                        <table class="w-full border-collapse">
                            <thead>
                                <tr class="bg-[var(--light-primary)]">
                                    <th class="p-4 text-left text-[var(--primary)] font-semibold">Product</th>
                                    <th class="p-4 text-left text-[var(--primary)] font-semibold">Price</th>
                                    <th class="p-4 text-left text-[var(--primary)] font-semibold">Quantity</th>
                                    <th class="p-4 text-left text-[var(--primary)] font-semibold">Total</th>
                                    <th class="p-4 text-left text-[var(--primary)] font-semibold">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($shopCarts as $cart)
                                    <tr class="border-b border-[var(--light-primary)] hover:bg-gray-50 transition">
                                        <td class="p-4 flex items-center space-x-4">
                                            <img src="{{ asset(Storage::url($cart->product->images[0])) }}"
                                                alt="{{ $cart->product->name }}"
                                                class="w-20 h-20 object-cover rounded-lg shadow-sm">
                                            <div>
                                                <p class="font-semibold text-[var(--primary)] text-lg">{{ $cart->product->name }}</p>
                                                <p class="text-sm text-[var(--text)]">{{ Str::limit($cart->product->description, 60) }}</p>
                                            </div>
                                        </td>
                                        <td class="p-4">
                                            @if ($cart->product->discount_percentage > 0)
                                                <span class="text-[var(--primary)] font-semibold">
                                                    Rs. {{ number_format($cart->product->price * (1 - $cart->product->discount_percentage / 100), 2) }}
                                                </span>
                                                <span class="text-sm text-[var(--text)] line-through">
                                                    Rs. {{ number_format($cart->product->price, 2) }}
                                                </span>
                                            @else
                                                <span class="text-[var(--primary)] font-semibold">
                                                    Rs. {{ number_format($cart->product->price, 2) }}
                                                </span>
                                            @endif
                                        </td>
                                        <td class="p-4">
                                            <div class="flex items-center space-x-3">
                                                <button onclick="updateQty({{ $cart->id }}, {{ $cart->qty - 1 }})"
                                                    class="bg-[var(--light-primary)] text-[var(--primary)] px-4 py-2 rounded-full hover:bg-[var(--primary)] hover:text-white transition">
                                                    -
                                                </button>
                                                <input type="number" value="{{ $cart->qty }}" min="1" max="10"
                                                    class="w-16 text-center border border-[var(--light-primary)] rounded-lg focus:outline-none focus:ring-2 focus:ring-[var(--secondary)]"
                                                    onchange="updateQty({{ $cart->id }}, this.value)">
                                                <button onclick="updateQty({{ $cart->id }}, {{ $cart->qty + 1 }})"
                                                    class="bg-[var(--light-primary)] text-[var(--primary)] px-4 py-2 rounded-full hover:bg-[var(--primary)] hover:text-white transition">
                                                    +
                                                </button>
                                            </div>
                                        </td>
                                        <td class="p-4 text-[var(--primary)] font-semibold">
                                            Rs. {{ number_format($cart->amount, 2) }}
                                        </td>
                                        <td class="p-4">
                                            <button onclick="deleteCart({{ $cart->id }})"
                                                class="text-red-500 hover:text-red-600 font-medium transition">
                                                Remove
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-6 flex justify-end items-center space-x-6">
                        <p class="text-xl font-semibold text-[var(--primary)]">
                            Subtotal: Rs. {{ number_format($shopCarts->sum('amount'), 2) }}
                        </p>
                        <button onclick="placeOrder({{ $shopId }})"
                            class="bg-[var(--secondary)] text-white px-8 py-3 rounded-full hover:bg-opacity-80 transition duration-300 font-medium">
                            Place Order
                        </button>
                    </div>
                </div>
            @endforeach
        @endif
    </div>

    <!-- Include SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function updateQty(cartId, qty) {
            if (qty < 1 || qty > 10) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Invalid Quantity',
                    text: 'Quantity must be between 1 and 10.',
                });
                return;
            }
            fetch('/cart/update/' + cartId, {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ qty: qty })
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Updated',
                            text: 'Cart quantity updated successfully!',
                            timer: 1500,
                            showConfirmButton: false
                        }).then(() => {
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Failed to update quantity.',
                        });
                    }
                })
                .catch(error => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'An error occurred while updating the cart.',
                    });
                });
        }

        function deleteCart(cartId) {
            Swal.fire({
                title: 'Are you sure?',
                text: 'Do you want to remove this item from your cart?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#0c9cd7',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, remove it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch('/cart/delete/' + cartId, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Removed',
                                    text: 'Item removed from cart!',
                                    timer: 1500,
                                    showConfirmButton: false
                                }).then(() => {
                                    location.reload();
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: 'Failed to remove item.',
                                });
                            }
                        })
                        .catch(error => {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'An error occurred while removing the item.',
                            });
                        });
                }
            });
        }

        function placeOrder(shopId) {
            Swal.fire({
                title: 'Confirm Order',
                text: 'Are you sure you want to place this order?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#0c9cd7',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, place order!'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch('/order/create/' + shopId, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Order Placed',
                                    text: 'Your order has been placed successfully!',
                                    timer: 1500,
                                    showConfirmButton: false
                                }).then(() => {
                                    window.location.href = '/order/confirmation/' + data.orderId;
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: 'Failed to place order.',
                                });
                            }
                        })
                        .catch(error => {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'An error occurred while placing the order.',
                            });
                        });
                }
            });
        }
    </script>
</x-frontend-layout>
