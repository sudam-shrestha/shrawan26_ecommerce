<x-frontend-layout>


    <section>
        <div class="container py-10">
            <div class="mb-6">
                <h2 class="text-2xl font-bold text-gray-800">
                    Search Result for {{ $q }}
                </h2>
                <p>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Autem, fugit!
                </p>
            </div>

            @if (count($products) > 0)
                <div class="grid grid-cols-4 gap-6">
                    @foreach ($products as $product)
                        <x-product-card :product="$product" />
                    @endforeach
                </div>
            @else
                <h3>
                    No products found
                </h3>
            @endif
        </div>
    </section>

</x-frontend-layout>
