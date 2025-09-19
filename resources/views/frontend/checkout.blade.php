<x-frontend-layout>
    <section class="container mx-auto py-6 px-4 md:px-6">
        <div class="checkout-container mx-auto py-8 px-4 md:px-6">
            <div class="text-center mb-10">
                <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-2">Complete Your Order</h1>
                <p class="text-gray-600">From {{ $shop->name }}</p>

                <!-- Progress indicator -->
                <div class="flex justify-center mt-8 mb-6">
                    <div class="flex items-center">
                        <div class="flex flex-col items-center">
                            <div
                                class="w-10 h-10 rounded-full bg-indigo-600 text-white flex items-center justify-center">
                                <span>1</span>
                            </div>
                            <span class="mt-2 text-sm font-medium text-indigo-600">Cart</span>
                        </div>
                        <div class="w-16 md:w-24 h-1 bg-indigo-600 mx-2"></div>
                        <div class="flex flex-col items-center">
                            <div
                                class="w-10 h-10 rounded-full bg-indigo-600 text-white flex items-center justify-center">
                                <span>2</span>
                            </div>
                            <span class="mt-2 text-sm font-medium text-indigo-600">Details</span>
                        </div>
                        <div class="w-16 md:w-24 h-1 bg-gray-300 mx-2"></div>
                        <div class="flex flex-col items-center">
                            <div
                                class="w-10 h-10 rounded-full bg-gray-300 text-gray-600 flex items-center justify-center">
                                <span>3</span>
                            </div>
                            <span class="mt-2 text-sm font-medium text-gray-500">Confirmation</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Left: Delivery & Payment Form -->
                <div class="bg-white p-6 md:p-8 rounded-2xl shadow-sm border border-gray-200">
                    <h2 class="text-xl font-semibold mb-6 text-gray-900 pb-3 border-b border-gray-200">Delivery
                        Information</h2>

                    <form action="{{ route('order.store', $shop->id) }}" method="POST" class="space-y-6"
                        id="checkoutForm" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="shop_id" value="{{ $shop->id }}">

                        <!-- Delivery Information -->
                        <div class="space-y-5">
                            <div>
                                <label for="address" class="block text-sm font-medium text-gray-700 mb-2">Delivery
                                    Address</label>
                                <textarea name="address" id="address" required
                                    class="form-input mt-1 p-3 w-full border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 transition duration-200"
                                    rows="3" placeholder="Enter your full delivery address"></textarea>
                            </div>
                            <div>
                                <label for="contact" class="block text-sm font-medium text-gray-700 mb-2">Contact
                                    Number</label>
                                <input type="text" name="contact" id="contact" required
                                    class="form-input mt-1 p-3 w-full border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 transition duration-200"
                                    placeholder="Enter your phone number">
                            </div>
                        </div>

                        <!-- Payment Method -->
                        <div class="pt-6 border-t border-gray-200">
                            <h2 class="text-xl font-semibold mb-6 text-gray-900">Payment Method</h2>
                            <label class="block text-sm font-medium text-gray-700 mb-4">Select your preferred payment
                                method</label>
                            <div class="grid gap-2">
                                <!-- Cash on Delivery -->
                                <label class="relative cursor-pointer">
                                    <input type="radio" name="payment_method" value="cash_on_delivery"
                                        class="sr-only peer" checked>
                                    <div
                                        class="payment-option peer-checked:bg-indigo-50 peer-checked:border-indigo-600 peer-checked:ring-2 peer-checked:ring-indigo-200 border-2 border-gray-200 rounded-xl p-4 text-center hover:shadow-md transition-all duration-300 bg-white">
                                        <div class="flex flex-col items-center">
                                            <div
                                                class="w-6 h-6 rounded-full bg-indigo-100 flex items-center justify-center mb-3">
                                                <svg class="w-3 h-3 text-indigo-600" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3-3V0m6 0h4" />
                                                </svg>
                                            </div>
                                            <h3 class="font-semibold text-sm text-gray-800">Cash on Delivery</h3>
                                            <p class="text-xs text-gray-500 mt-1">Pay when you receive</p>
                                        </div>
                                    </div>
                                </label>

                                <!-- QR Payment -->
                                <label class="relative cursor-pointer">
                                    <input type="radio" name="payment_method" value="qr_payment" class="sr-only peer">
                                    <div
                                        class="payment-option peer-checked:bg-indigo-50 peer-checked:border-indigo-600 peer-checked:ring-2 peer-checked:ring-indigo-200 border-2 border-gray-200 rounded-xl p-4 text-center hover:shadow-md transition-all duration-300 bg-white">
                                        <div class="flex flex-col items-center">
                                            <div
                                                class="w-6 h-6 rounded-full bg-indigo-100 flex items-center justify-center mb-3">
                                                <svg class="w-3 h-3 text-indigo-600" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M12 18v-5.25m0 0a6.01 6.01 0 001.5-.583m-1.5.583a6.01 6.01 0 01-1.5-.583M9.75 9.75c0 .621-.504 1.125-1.125 1.125H5.25M18.75 9.75c0 .621-.504 1.125-1.125 1.125H15m0 0c-.621 0-1.125.504-1.125 1.125v3.75c0 .621.504 1.125 1.125 1.125h3.75c.621 0 1.125-.504 1.125-1.125V12.75c0-.621-.504-1.125-1.125-1.125z" />
                                                </svg>
                                            </div>
                                            <h3 class="font-semibold text-sm text-gray-800">QR Payment</h3>
                                            <p class="text-xs text-gray-500 mt-1">Scan & Pay</p>
                                        </div>
                                    </div>
                                </label>

                                <!-- Pay with Khalti -->
                                <label class="relative cursor-pointer">
                                    <input type="radio" name="payment_method" value="khalti" class="sr-only peer">
                                    <div
                                        class="payment-option peer-checked:bg-indigo-50 peer-checked:border-indigo-600 peer-checked:ring-2 peer-checked:ring-indigo-200 border-2 border-gray-200 rounded-xl p-4 text-center hover:shadow-md transition-all duration-300 bg-white">
                                        <div class="flex flex-col items-center">
                                            <div
                                                class="w-6 h-6 rounded-full bg-indigo-100 flex items-center justify-center mb-3">
                                                <svg class="w-3 h-3 text-indigo-600" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5m12 0v2a2 2 0 002 2h2a2 2 0 002-2V7a2 2 0 00-2-2h-2a2 2 0 00-2 2z" />
                                                </svg>
                                            </div>
                                            <h3 class="font-semibold text-sm text-gray-800">Pay with Khalti</h3>
                                            <p class="text-xs text-gray-500 mt-1">Digital Wallet</p>
                                        </div>
                                    </div>
                                </label>
                            </div>

                            <!-- QR Payment Details -->
                            <div id="qrReceipt"
                                class="hidden mt-6 space-y-4 p-5 bg-gray-50 rounded-xl border border-gray-200">
                                <h3 class="font-medium text-gray-800">Complete QR Payment</h3>
                                <div class="">
                                    <div class="flex justify-center md:justify-start">
                                        <img src="https://upload.wikimedia.org/wikipedia/commons/d/d0/QR_code_for_mobile_English_Wikipedia.svg"
                                            alt="QR Payment Code"
                                            class="w-40 h-40 object-contain rounded-lg bg-white p-3 shadow-sm border border-gray-200">
                                    </div>
                                    <div class="mt-4 md:mt-0 flex-1">
                                        <div>
                                            <label for="payment_receipt_image"
                                                class="block text-sm font-medium text-gray-700 mb-1">Upload Receipt
                                                (Optional)</label>
                                            <div class="flex items-center space-x-2">
                                                <input type="file" name="payment_receipt_image" accept="image/*"
                                                    class="text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button type="submit"
                            class="w-full bg-indigo-600 text-white py-3 px-4 rounded-lg hover:bg-indigo-700 transition duration-300 font-semibold text-lg shadow-md hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Place Order & Pay
                        </button>
                    </form>
                </div>

                <!-- Right: Order Summary -->
                <div class="bg-white p-6 md:p-8 rounded-2xl shadow-sm border border-gray-200 h-fit sticky top-6">
                    <h2 class="text-xl font-semibold mb-6 text-gray-900 pb-3 border-b border-gray-200">Order Summary
                    </h2>
                    <div class="space-y-6">
                        <div class="max-h-96 overflow-y-auto pr-2">
                            @foreach ($shopCarts as $cart)
                                <div
                                    class="order-item flex justify-between items-start p-4 rounded-lg hover:bg-gray-50 transition-colors">
                                    <div class="flex items-start space-x-4">
                                        @if (!empty($cart->product->images))
                                            <img src="{{ asset('storage/' . $cart->product->images[0]) }}"
                                                alt="{{ $cart->product->name }}"
                                                class="w-16 h-16 object-cover rounded-lg flex-shrink-0">
                                        @else
                                            <div class="w-16 h-16 bg-gray-100 rounded-lg flex-shrink-0"></div>
                                        @endif
                                        <div>
                                            <h3 class="text-base font-medium text-gray-800">{{ $cart->product->name }}
                                            </h3>
                                            <p class="text-sm text-gray-500 mt-1">Quantity: {{ $cart->qty }}</p>
                                            <p class="text-sm text-gray-500">Unit Price:
                                                Rs.{{ number_format($cart->product->price * (1 - $cart->product->discount_percentage / 100), 2) }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="text-base font-semibold text-gray-800 whitespace-nowrap">
                                        Rs.{{ number_format($cart->amount, 2) }}
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="pt-4 border-t border-gray-200 space-y-3">
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">Subtotal</span>
                                <span
                                    class="text-gray-800 font-medium">Rs.{{ number_format($shopCarts->sum('amount'), 2) }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">Delivery Fee</span>
                                <span class="text-gray-800 font-medium">Rs.100.00</span>
                            </div>
                            <div
                                class="flex justify-between items-center text-lg font-semibold pt-3 border-t border-gray-200">
                                <span class="text-gray-900">Total</span>
                                <span
                                    class="text-indigo-600">Rs.{{ number_format($shopCarts->sum('amount') + 100, 2) }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="mt-8 bg-indigo-50 p-4 rounded-lg border border-indigo-100">
                        <div class="flex items-start">
                            <svg class="w-5 h-5 text-indigo-600 mt-0.5 mr-2 flex-shrink-0" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <p class="text-sm text-indigo-700">Your order will be delivered within 2-3 business days.
                                You will receive a confirmation email shortly after placing your order.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const qrRadio = document.querySelector('input[value="qr_payment"]');
                const qrReceipt = document.getElementById('qrReceipt');

                function toggleQrReceipt() {
                    if (qrRadio.checked) {
                        qrReceipt.classList.remove('hidden');
                    } else {
                        qrReceipt.classList.add('hidden');
                    }
                }

                document.querySelectorAll('input[name="payment_method"]').forEach(radio => {
                    radio.addEventListener('change', toggleQrReceipt);
                });

                toggleQrReceipt(); // Initial check
            });
        </script>
    </section>
</x-frontend-layout>
