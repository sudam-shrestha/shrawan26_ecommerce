<x-frontend-layout>
    <div class="container mx-auto p-6 max-w-3xl">
        <div id="receipt-card" class="bg-white shadow-md rounded-lg p-6">
            <h1 class="text-2xl font-bold mb-4 text-center text-[var(--primary)]">Order Receipt</h1>

            <!-- Order Information -->
            <div class="mb-6">
                <h2 class="text-xl font-semibold mb-2 text-[var(--text)]">Order Details</h2>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p><strong>Order ID:</strong> {{ $order->id }}</p>
                        <p><strong>Customer:</strong> {{ $order->user->name }}</p>
                        <p><strong>Contact:</strong> {{ $order->contact }}</p>
                    </div>
                    <div>
                        <p><strong>Delivery Address:</strong> {{ $order->delivery_address }}</p>
                        <p><strong>Order Status:</strong> {{ ucfirst($order->status) }}</p>
                        <p><strong>Order Date:</strong> {{ $order->created_at->format('d M Y, H:i') }}</p>
                    </div>
                </div>
            </div>

            <!-- Order Items -->
            <div class="mb-6">
                <h2 class="text-xl font-semibold mb-2 text-[var(--text)]">Order Items</h2>
                <table class="w-full border-collapse">
                    <thead>
                        <tr class="bg-[var(--light-primary)]">
                            <th class="border p-2 text-left text-[var(--text)]">Product</th>
                            <th class="border p-2 text-right text-[var(--text)]">Quantity</th>
                            <th class="border p-2 text-right text-[var(--text)]">Price</th>
                            <th class="border p-2 text-right text-[var(--text)]">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order->order_items as $item)
                            <tr>
                                <td class="border p-2 text-[var(--text)]">{{ $item->product->name }}</td>
                                <td class="border p-2 text-right text-[var(--text)]">{{ $item->qty }}</td>
                                <td class="border p-2 text-right text-[var(--text)]">Rs. {{ number_format($item->amount / $item->qty, 2) }}</td>
                                <td class="border p-2 text-right text-[var(--text)]">Rs. {{ number_format($item->amount, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr class="font-semibold">
                            <td colspan="3" class="border p-2 text-right text-[var(--text)]">Total Amount:</td>
                            <td class="border p-2 text-right text-[var(--text)]">Rs. {{ number_format($order->total_amount, 2) }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <!-- Payment Information -->
            <div class="mb-6">
                <h2 class="text-xl font-semibold mb-2 text-[var(--text)]">Payment Details</h2>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p><strong>Payment Method:</strong> {{ ucfirst($order->payment->method) }}</p>
                        <p><strong>Payment Status:</strong> {{ ucfirst($order->payment->status) }}</p>
                    </div>
                    <div>
                        <p><strong>Transaction ID:</strong> {{ $order->payment->transaction_id ?? 'N/A' }}</p>
                        @if ($order->payment->payment_receipt)
                            <p><strong>Receipt:</strong> <a href="{{ asset($order->payment->payment_receipt) }}" target="_blank" class="text-[var(--secondary)] hover:underline">View Receipt</a></p>
                        @else
                            <p><strong>Receipt:</strong> Not uploaded</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Buttons -->
        <div class="text-center mt-4">
            <button onclick="printReceipt()" class="inline-flex items-center px-4 py-2 bg-[var(--secondary)] text-white rounded hover:bg-[var(--primary)]">
                <i class="fas fa-print mr-2"></i> Print PDF
            </button>
            <a href="{{ url()->previous() }}" class="inline-flex items-center px-4 py-2 bg-[var(--primary)] text-white rounded hover:bg-[var(--secondary)] ml-2">
                <i class="fas fa-arrow-left mr-2"></i> Back
            </a>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script>
        function printReceipt() {
            const { jsPDF } = window.jspdf;
            const receiptCard = document.getElementById('receipt-card');

            html2canvas(receiptCard, { scale: 2 }).then(canvas => {
                const imgData = canvas.toDataURL('image/png');
                const pdf = new jsPDF({
                    orientation: 'portrait',
                    unit: 'mm',
                    format: 'a4'
                });

                const imgProps = pdf.getImageProperties(imgData);
                const pdfWidth = pdf.internal.pageSize.getWidth();
                const pdfHeight = (imgProps.height * pdfWidth) / imgProps.width;

                pdf.addImage(imgData, 'PNG', 0, 0, pdfWidth, pdfHeight);
                pdf.save(`receipt_order.pdf`);
            });
        }
    </script>
</x-frontend-layout>
