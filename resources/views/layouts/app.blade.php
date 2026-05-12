<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Shop</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <nav class="bg-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between items-center h-16">
                <div class="flex space-x-7">
                    <a href="{{ route('products.index') }}" class="text-gray-800 font-bold text-xl">Simple Shop</a>
                    
                    @auth
                        <a href="{{ route('products.index') }}" class="text-gray-600 hover:text-gray-800">Товары</a>
                        <a href="{{ route('orders.index') }}" class="text-gray-600 hover:text-gray-800">Мои заказы</a>
                        @if(auth()->user()->is_admin)
                            <a href="{{ route('admin.dashboard') }}" class="text-red-600 hover:text-red-800 font-bold">Админ панель</a>
                        @endif
                    @endauth
                </div>
                
                <div class="flex space-x-3">
                    @guest
                        <a href="{{ route('login') }}" class="text-gray-600 hover:text-gray-800">Вход</a>
                        <a href="{{ route('register') }}" class="text-gray-600 hover:text-gray-800">Регистрация</a>
                    @endguest
                    
                    @auth
                        <span class="text-gray-600">{{ auth()->user()->name }}</span>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="text-red-600 hover:text-red-800">Выход</button>
                        </form>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-4 py-6">
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif
        
        @yield('content')
    </main>
</body>
</html>