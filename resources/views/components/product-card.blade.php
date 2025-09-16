@props(['product'])
<div class="rounded overflow-hidden shadow hover:shadow-xl duration-100">
    <a href="{{route('product', $product->id)}}">
        <div class="relative h-[180px] overflow-hidden">
            <img class="w-full object-cover h-full hover:scale-105 duration-200"
                src="{{ asset(Storage::url($product->images[0])) }}" alt="">
            @if ($product->discount_percentage > 0)
                <span class="absolute top-1 right-0 bg-[red] text-white px-4 py-1">
                    {{ $product->discount_percentage }}% off
                </span>
            @endif
        </div>

        <div class="p-2">
            <h3 class="font-semibold">
                {{ $product->name }}
            </h3>
            <p class="text-sm">
                Rs.{{ $product->price - ($product->price * $product->discount_percentage) / 100 }}
                @if ($product->discount_percentage > 0)
                    <span class="text-[red] line-through">
                        Rs.{{ $product->price }}
                    </span>
                @endif
            </p>
            <a href="{{route('product', $product->id)}}"
                class="text-sm flex justify-center border border-[var(--primary)] text-[var(--primary)] py-1 rounded-3xl mt-2">
                view details
            </a>
        </div>
    </a>
</div>
