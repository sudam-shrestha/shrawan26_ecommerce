@php
    $primary = '#642571';
    $secondary = '#e6227b';
    $text = '#666666';
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Shop Request Notification</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

</head>

<body class="bg-gray-100 font-sans" style="margin:0; padding:0; background:#f9fafb; font-family:Arial, sans-serif;">
    <div class="max-w-xl mx-auto my-10 bg-white shadow-md rounded-lg overflow-hidden"
        style="max-width:600px; margin:40px auto; background:#ffffff; border-radius:10px; box-shadow:0 4px 10px rgba(0,0,0,0.05);">

        <!-- Header -->
        <div class="bg-purple-800 text-white text-center py-6"
            style="background:{{ $primary }}; color:white; padding:20px;">
            <h1 class="text-2xl font-bold">New Shop Request</h1>
        </div>

        <!-- Body -->
        <div class="p-6 text-gray-700" style="padding:24px; color:{{ $text }};">
            <p class="mb-4">Hello Admin,</p>
            <p class="mb-4">A new shop has requested to join your marketplace. Here are the details:</p>

            <div class="border rounded-lg p-4 mb-6 bg-gray-50"
                style="border:1px solid #e5e7eb; border-radius:8px; background:#f9fafb; padding:16px;">
                <p><strong>Shop Name:</strong> {{ $shop->name }}</p>
                <p><strong>Email:</strong> {{ $shop->email }}</p>
                <p><strong>Phone:</strong> {{ $shop->phone }}</p>
                @if ($shop->photo)
                    <p class="mt-3">
                        <strong>Shop Logo:</strong><br>
                        <img src="{{ asset('storage/' . $shop->photo) }}" alt="Shop Logo"
                            style="max-width:150px; border-radius:8px; margin-top:8px;">
                    </p>
                @endif
            </div>

            <p class="mb-4">Please review the request and approve/reject it from your admin panel.</p>

            <!-- Call to action -->
            <div class="text-center mt-6">
                <a href="{{ url('/admin/shops') }}" class="inline-block px-6 py-3 rounded-lg font-semibold"
                    style="background:{{ $secondary }}; color:white; text-decoration:none; display:inline-block;">
                    Review Shop Request
                </a>
            </div>
        </div>

        <!-- Footer -->
        <div class="bg-gray-100 text-center text-xs text-gray-500 py-4"
            style="background:#f3f4f6; padding:16px; font-size:12px; color:#6b7280;">
            <p>&copy; {{ date('Y') }} Your Company. All rights reserved.</p>
        </div>
    </div>
</body>

</html>
