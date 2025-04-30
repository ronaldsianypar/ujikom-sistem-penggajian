<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ujikom</title>
    <script src="/js/cdn.tailwindcss.com.3.4.16.min.js"></script>
    <style>
        #clock {
            animation: pulse 1s infinite;
        }

        @keyframes pulse {
            0%, 100% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.05);
            }
        }
    </style>
</head>
<body class="bg-gradient-to-br from-blue-500 to-indigo-600 min-h-screen flex flex-col items-center justify-center text-white">
    <div class="absolute top-6 right-6">
        @if (Route::has('login'))
            <div class="flex space-x-4">
                @auth
                    <a href="{{ url('/admin') }}" class="text-lg font-medium hover:underline">Admin</a>
                @else
                    <a href="{{ route('login') }}" class="text-lg font-medium hover:underline">Login</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="text-lg font-medium hover:underline">Register</a>
                    @endif
                @endauth
            </div>
        @endif
    </div>

    <div class="text-center">
        <h1 class="text-6xl font-bold mb-6 drop-shadow-lg">Selamat Datang</h1>
        {{-- <p class="text-xl font-light mb-8">Jelajahi keunggulan kami dan nikmati pengalamannya.</p> --}}
        <div id="clock" class="text-4xl font-mono bg-white text-blue-600 px-6 py-3 rounded-lg shadow-lg inline-block">00:00:00</div>
    </div>

    <script>
        const updateClock = () => {
            const now = new Date();
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const seconds = String(now.getSeconds()).padStart(2, '0');
            document.getElementById('clock').textContent = `${hours}:${minutes}:${seconds}`;
        };
        setInterval(updateClock, 1000);
        updateClock();
    </script>

</body>
</html>