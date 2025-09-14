<header class="w-full shadow bg-white">
    <div class="container mx-auto flex items-center justify-between px-4 py-3">
        <!-- Logo -->
        <div class="flex items-center gap-2">
            <img src="{{ asset(Storage::url($company->logo)) }}" alt="Logo" class="h-10" />
            <span class="font-bold text-xl" style="color: var(--primary)">{{ $company->name }}</span>
        </div>

        <!-- Search -->
        <div class="w-1/2">
            <div class="relative">
                <input type="text" placeholder="Search for products..."
                    class="w-full rounded-full border border-gray-300 py-2 pl-4 pr-10 focus:outline-none focus:ring-2"
                    style="--tw-ring-color: var(--secondary);" />
                <button class="absolute right-2 top-1/2 -translate-y-1/2 text-white px-3 py-1 rounded-full"
                    style="background: var(--secondary)">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </div>
        </div>

        <!-- Login -->
        <div>
            <a href="/login" class="px-5 py-2 rounded-full font-medium transition"
                style="background: var(--primary); color: white;" onmouseover="this.style.background='var(--secondary)'"
                onmouseout="this.style.background='var(--primary)'">
                Login
            </a>
        </div>
    </div>
</header>
