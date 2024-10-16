<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Blog MSIB')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js']) <!-- Menggunakan Vite untuk mengelola aset -->
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100 flex flex-col">
        <header>
            <nav class="bg-white border-b border-gray-200">
                <div class="max-w-7xl mx-auto px-4 py-2">
                    <div class="flex justify-between items-center">
                        <div>
                            <a href="/" class="text-lg font-bold">Blog MSIB</a>
                        </div>
                        <div class="hidden md:flex space-x-4">
                            <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                                {{ __('Dashboard') }}
                            </x-nav-link>
                            <x-nav-link :href="route('categories.index')" :active="request()->routeIs('categories.*')">
                                {{ __('Categories') }}
                            </x-nav-link>
                            <x-nav-link :href="route('posts.index')" :active="request()->routeIs('posts.*')">
                                {{ __('Posts') }}
                            </x-nav-link>
                            <x-nav-link :href="route('profile.edit')" :active="request()->routeIs('profile.*')">
                                {{ __('Profile') }}
                            </x-nav-link>
                        </div>
                    </div>
                </div>
            </nav>
        </header>

        <main class="flex-1">
            <div class="container mx-auto mt-4">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @elseif (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @yield('content')
            </div>
        </main>

        <footer class="bg-gray-200 text-center py-4">
            <p>Copyright &copy; 2024</p>
        </footer>
    </div>

    @yield('scripts') <!-- Untuk menambahkan skrip tambahan di halaman tertentu -->
</body>
</html>
