<x-frontend-layout>
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
</x-frontend-layout>
