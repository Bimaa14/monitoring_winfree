<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Winfree Monitoring - Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f3f4f6;
            background-image: url('data:image/svg+xml;utf8,<svg width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid slice"><circle cx="50" cy="50" r="10" fill="%23e5e7eb" opacity="0.1"/><circle cx="80" cy="20" r="12" fill="%23e5e7eb" opacity="0.1"/><circle cx="30" cy="80" r="8" fill="%23e5e7eb" opacity="0.1"/><path d="M50 0 A50 50 0 0 1 100 50 L100 0 Z" fill="%23e5e7eb" opacity="0.1"/><path d="M0 50 A50 50 0 0 1 50 100 L0 100 Z" fill="%23e5e7eb" opacity="0.1"/></svg>');
            background-size: 50% 50%;
        }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen p-4">

    <!-- Main Container -->
    <div class="w-full max-w-sm p-8 bg-white rounded-xl shadow-lg transform transition-transform duration-300 hover:scale-[1.02]">

        <!-- Login Header -->
        <div class="flex flex-col items-center justify-center mb-6">
            <!-- Winfree Logo -->
            <img src="{{ asset('images/images.png') }}" alt="Winfree Logo" class="h-16 w-16 mb-2 rounded-full">
            <h1 class="text-2xl font-bold text-gray-800">WinFree</h1>
            <p class="text-sm text-gray-500">Monitoring Internet Gratis</p>
        </div>

        <!-- Login Form -->
        <form method="POST" action="/login" class="space-y-4">
            @csrf

            <!-- Email Input -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <div class="mt-1">
                    <input id="email" name="email" type="email" autocomplete="email" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors">
                </div>
            </div>

            <!-- Password Input -->
            <div>
                <div class="flex items-center justify-between">
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <a href="#" class="text-sm text-blue-600 hover:underline">Lupa Password?</a>
                </div>
                <div class="mt-1">
                    <input id="password" name="password" type="password" autocomplete="current-password" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors">
                </div>
            </div>

            <!-- Login Button -->
            <div>
                <button type="submit"
                        class="w-full px-4 py-2 text-white bg-blue-600 rounded-lg font-semibold shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                    Login
                </button>
            </div>
        </form>
    </div>

</body>
</html>
