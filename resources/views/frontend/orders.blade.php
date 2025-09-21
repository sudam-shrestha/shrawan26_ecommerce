<x-frontend-layout>
    <div class="container mx-auto p-6">
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="p-6 bg-[var(--primary)] text-white">
                <h1 class="text-2xl font-bold">My Orders</h1>
            </div>
            <div class="p-6">
                @if ($orders->isEmpty())
                    <p class="text-[var(--text)] text-center">No orders found.</p>
                @else
                    <div class="overflow-x-auto">
                        <table class="w-full border-collapse">
                            <thead>
                                <tr class="bg-[var(--light-primary)]">
                                    <th class="p-3 text-left text-[var(--text)] font-semibold">Order ID</th>
                                    <th class="p-3 text-left text-[var(--text)] font-semibold">Total Amount</th>
                                    <th class="p-3 text-left text-[var(--text)] font-semibold">Status</th>
                                    <th class="p-3 text-left text-[var(--text)] font-semibold">Date</th>
                                    <th class="p-3 text-left text-[var(--text)] font-semibold">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                    <tr class="border-b hover:bg-[var(--light-primary)]">
                                        <td class="p-3 text-[var(--text)]">{{ $order->id }}</td>
                                        <td class="p-3 text-[var(--text)]">Rs.
                                            {{ number_format($order->total_amount, 2) }}</td>
                                        <td class="p-3 text-[var(--text)]">
                                            <span
                                                class="inline-block px-2 py-1 rounded @if ($order->status == 'delivered') bg-green-100 text-green-800 @elseif($order->status == 'processing') bg-yellow-100 text-yellow-800 @else bg-red-100 text-red-800 @endif">
                                                {{ ucfirst($order->status) }}
                                            </span>
                                        </td>
                                        <td class="p-3 text-[var(--text)]">{{ $order->created_at->format('d M Y') }}
                                        </td>
                                        <td class="p-3">
                                            <a href="{{ route('receipt', $order->id) }}" target="_blank"
                                                class="inline-flex items-center px-3 py-1 bg-[var(--secondary)] text-white rounded hover:bg-[var(--primary)]">
                                                <i class="fas fa-receipt mr-2"></i> View Receipt
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-frontend-layout>
