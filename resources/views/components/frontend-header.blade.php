<header class="w-full shadow sticky top-0 z-50 bg-white">
    <div class="container mx-auto flex items-center justify-between px-4 py-3">
        <!-- Logo -->
        <a href="{{ route('home') }}" class="flex items-center gap-2">
            <img src="{{ asset(Storage::url($company->logo)) }}" alt="Logo" class="h-10" />
            <span class="font-bold text-xl" style="color: var(--primary)">{{ $company->name }}</span>
        </a>

        <!-- Search -->
        <div class="w-1/2">
            <form action="{{ route('search') }}" method="get">
                <div class="relative">
                    <input type="text" placeholder="Search for products..." name="q"
                        class="w-full rounded-full border border-gray-300 py-2 pl-4 pr-10 focus:outline-none focus:ring-2"
                        style="--tw-ring-color: var(--secondary);" />
                    <button class="absolute right-2 top-1/2 -translate-y-1/2 text-white px-3 py-1 rounded-full"
                        style="background: var(--secondary)">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </div>
            </form>
        </div>

        <!-- Login -->
        <div>

            @if (Auth::user())
                <div class="flex items-center gap-5">
                    <a href="{{ route('cart.index') }}" class="text-[var(--primary)] text-xl relative">
                        <i class="fa-solid fa-cart-shopping"></i>
                        <span class="absolute text-[9px] bg-[red] text-white px-1 rounded-full -top-1 -right-1">
                            {{ Auth::user()->carts()->count() }}
                        </span>
                    </a>

                    <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown" type="button"
                        class="flex items-center gap-1 bg-[var(--primary)] text-white py-2 px-3.5 rounded-full text-sm font-medium">
                        <span>
                            {{ Str::substr(Auth::user()->name, 0, 1) }}
                        </span>
                    </button>
                </div>

                <!-- Dropdown menu -->
                <div id="dropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow-sm w-44">
                    <ul class="py-2 text-sm text-gray-700" aria-labelledby="dropdownDefaultButton">
                        <li>
                            <a href="{{ route('order') }}" class="block px-4 py-2 hover:bg-gray-100">Order</a>
                        </li>

                        <li class="block px-4 py-2 hover:bg-red-100">
                            <form action="{{ route('logout') }}" method="post">
                                @csrf
                                <button type="submit">Logout</button>
                            </form>
                        </li>
                    </ul>
                </div>
            @else
                <button type="button" id="dropdownDefaultButton" data-dropdown-toggle="dropdown" class="px-5 py-2 rounded-full font-medium transition"
                    style="background: var(--primary); color: white;"
                    onmouseover="this.style.background='var(--secondary)'"
                    onmouseout="this.style.background='var(--primary)'">
                    Login <i class="fa-solid fa-circle-chevron-down"></i>
                </button>

                <!-- Dropdown menu -->
                <div id="dropdown"
                    class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow-sm w-44">
                    <ul class="py-2 text-sm text-gray-700" aria-labelledby="dropdownDefaultButton">
                        <li>
                            <a href="{{route('login')}}"
                                class="block px-4 py-2 hover:bg-gray-100">User</a>
                        </li>
                        <li>
                            <a href="/shop" target="_blank"
                                class="block px-4 py-2 hover:bg-gray-100">Shop</a>
                        </li>
                        <li>
                            <a href="/admin" target="_blank"
                                class="block px-4 py-2 hover:bg-gray-100">Admin</a>
                        </li>
                    </ul>
                </div>
            @endif



        </div>
    </div>
</header>
