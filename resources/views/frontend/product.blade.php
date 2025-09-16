<x-frontend-layout>

    <section>
        <div class="container py-10">
            <!-- Product Section -->
            <div class="flex flex-col md:flex-row gap-8">
                <!-- Image Gallery -->
                <div class="w-full md:w-1/2">
                    <!-- Main Image -->
                    <div class="rounded-lg overflow-hidden shadow-lg mb-4">
                        <img id="mainImage" src="{{ asset(Storage::url($product->images[0])) }}" alt="Chicken Momo"
                            class="w-full h-96 object-cover">
                    </div>

                    <!-- Thumbnails -->
                    <div class="grid grid-cols-3 gap-4">
                        @foreach ($product->images as $img)
                            <div
                                class="cursor-pointer border-2 border-transparent hover:border-blue-500 rounded-lg overflow-hidden transition-all">
                                <img src="{{ asset(Storage::url($img)) }}" alt="Chicken Momo 1"
                                    class="w-full h-24 object-cover" onclick="changeImage(this.src)">
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Product Info -->
                <div class="w-full md:w-1/2">
                    <h1 class="text-3xl font-bold text-[var(--primary)] mb-2">
                        {{ $product->name }}
                    </h1>

                    <div class="mb-6">
                        Rs.{{ $product->price - ($product->price * $product->discount_percentage) / 100 }}
                        @if ($product->discount_percentage > 0)
                            <span class="text-[red] line-through">
                                Rs.{{ $product->price }}
                            </span>
                        @endif
                    </div>

                    <div class="mb-6">
                        {!! $product->description !!}
                    </div>

                    <div class="flex items-center mb-6">
                        <span
                            class="{{ $product->status ? 'text-green-800 bg-green-100' : 'text-red-800 bg-red-100' }} text-xs font-semibold px-2.5 py-0.5 rounded">
                            {{ $product->status ? 'In Stock' : 'Out of Stock' }}
                        </span>
                        <span class="ml-3 text-sm text-gray-500"><i class="fas fa-fire text-orange-500 mr-1"></i> 120+
                            ordered</span>
                    </div>

                    <div class="flex items-center mb-6">
                        <span class="text-gray-700 mr-4">Quantity:</span>
                        <div class="flex items-center border border-gray-300 rounded-md">
                            <button class="px-3 py-2 text-gray-600" onclick="decreaseQuantity()">-</button>
                            <input type="number" id="quantity" value="1" min="1"
                                class="w-12 text-center border-0 focus:ring-0">
                            <button class="px-3 py-2 text-gray-600" onclick="increaseQuantity()">+</button>
                        </div>
                    </div>

                    <div class="flex space-x-4">
                        <button
                            class="bg-[var(--primary)] hover:bg-[var(--secondary)] text-white py-3 px-6 rounded-lg flex items-center transition-colors">
                            <i class="fas fa-shopping-cart mr-2"></i>
                            Add to Cart
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <script>
        // Function to change the main image when clicking on thumbnails
        function changeImage(src) {
            document.getElementById('mainImage').src = src;
        }

        // Function to handle quantity changes
        function increaseQuantity() {
            const quantityInput = document.getElementById('quantity');
            quantityInput.value = parseInt(quantityInput.value) + 1;
        }

        function decreaseQuantity() {
            const quantityInput = document.getElementById('quantity');
            if (parseInt(quantityInput.value) > 1) {
                quantityInput.value = parseInt(quantityInput.value) - 1;
            }
        }

        // Initialize the page
        document.addEventListener('DOMContentLoaded', function() {
            // You can add any initialization code here
        });
    </script>
</x-frontend-layout>
