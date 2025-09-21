<x-frontend-layout>


    <section>
        <div class="container py-10">
            <div class="flex justify-between items-center">
                <div class="mb-6">
                    <h2 class="text-2xl font-bold text-gray-800">
                        Our Products
                    </h2>
                    <p>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Autem, fugit!
                    </p>
                </div>

                <div>
                    <button type="button" id="filterDropdown" data-dropdown-toggle="filter"
                        class="px-5 py-2 rounded-full font-medium transition" style="color: var(--primary);">
                        <i class="fa-solid fa-filter text-2xl"></i>
                    </button>

                    <!-- Dropdown menu -->
                    <div id="filter" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow-sm w-44">
                        <ul class="py-2 text-sm text-gray-700" aria-labelledby="filterDropdown">
                            <li>
                                <a href="{{ route('home', ['sort' => 'desc']) }}" class="block px-4 py-2 hover:bg-gray-100">Price (high to low)</a>
                            </li>
                            <li>
                                <a href="{{ route('home', ['sort' => 'asc']) }}" class="block px-4 py-2 hover:bg-gray-100">Price (low to high)</a>
                            </li>
                            <li>
                                <a href="{{ route('home', ['sort' => 'latest']) }}" class="block px-4 py-2 hover:bg-gray-100">Latest</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-4 gap-6">
                @foreach ($products as $product)
                    <x-product-card :product="$product" />
                @endforeach
            </div>
        </div>
    </section>

    <section>
        <div class="max-w-2xl mx-auto bg-white shadow-md rounded-lg p-8 mt-10">
            <h2 class="text-2xl font-bold mb-6 text-center text-gray-800">
                <i class="fas fa-store text-[var(--primary)]"></i> Request to Open Shop
            </h2>

            <form action="{{ route('shop.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                @csrf

                <!-- Shop Name -->
                <div>
                    <label class="block mb-2 text-gray-700 font-medium">
                        <i class="fas fa-tag mr-2 text-[var(--primary)]"></i> Shop Name
                    </label>
                    <input type="text" name="name" value="{{ old('name') }}"
                        class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-purple-600 focus:outline-none"
                        placeholder="Enter your shop name" required />
                    @error('name')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Email -->
                <div>
                    <label class="block mb-2 text-gray-700 font-medium">
                        <i class="fas fa-envelope mr-2 text-[var(--primary)]"></i> Email
                    </label>
                    <input type="email" name="email" value="{{ old('email') }}"
                        class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-purple-600 focus:outline-none"
                        placeholder="Enter your email" required />
                    @error('email')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Phone -->
                <div>
                    <label class="block mb-2 text-gray-700 font-medium">
                        <i class="fas fa-phone mr-2 text-[var(--primary)]"></i> Phone
                    </label>
                    <input type="text" name="phone" value="{{ old('phone') }}"
                        class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-purple-600 focus:outline-none"
                        placeholder="Enter your phone number" required />
                    @error('phone')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Shop Photo -->
                <div>
                    <label class="block mb-2 text-gray-700 font-medium">
                        <i class="fas fa-image mr-2 text-[var(--primary)]"></i> Shop Photo
                    </label>
                    <input type="file" name="photo"
                        class="w-full border rounded-lg px-4 py-2 focus:outline-none file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-white file:bg-[var(--primary)] hover:file:bg-[var(--secondary  )]" />
                    @error('photo')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Submit -->
                <div class="text-center">
                    <button type="submit"
                        class="bg-[var(--primary)] text-white px-6 py-2 rounded-lg hover:bg-[var(--secondary    )] transition">
                        <i class="fas fa-paper-plane mr-2"></i> Submit Request
                    </button>
                </div>
            </form>
        </div>
    </section>
</x-frontend-layout>
