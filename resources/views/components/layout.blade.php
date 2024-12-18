<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ env('APP_NAME') }}</title>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-slate-100 text-slate-900">
    <header class="bg-navy-600 shadow-lg">
        <nav class="flex justify-between items-center py-4 px-8">
            <a href="{{ route('products.index') }}" class="text-lg font-semibold text-white">Home</a>

            @auth
                <div class="relative grid place-items-center" x-data="{ open: false }">
                    {{-- - Dropdown menu button - --}}
                    <button @click="open = !open" type="button" class="round-btn">
                        <img src="https://picsum.photos/200" alt="">
                    </button>

                    {{-- - Dropdown menu - --}}
                    <div x-show="open" x-transition @click.away="open = false"
                        class="bg-white shadow-lg absolute top-10 right-0 rounded-lg overflow-hidden font-light w-48">
                        <p class="px-4 py-2 text-gray-700">{{auth()->user()-> username}}</p>
                        <a href="{{route('dashboard')}}" class="block hover:bg-slate-200 pl-4 pr-8 py-2 mb-1 rounded-md transition-all duration-200">
                            Dashboard
                        </a>  
                        <form action="{{route('logout')}}" method="POST">
                            @csrf
                            <button class="block w-full text-left hover:bg-slate-100 pl-4 pr-8 py-2 rounded-lg">
                                Logout
                            </button>   
                        </form>                      
                    </div>

                </div>

            @endauth
            @guest
                <div class="flex items-center gap-4">
                    <a href="{{ route('login') }}" class="text-sm text-white hover:text-gray-200">Login</a>
                    <a href="{{ route('register') }}" class="text-sm text-white hover:text-gray-200">Register</a>
                </div>
            @endguest
        </nav>
    </header>
    <main class="py-8 px-4 mx-auto max-w-screen-lg"> <!-- Changed to max-w-screen-lg -->
        {{ $slot }}
    </main>
</body>

</html>
