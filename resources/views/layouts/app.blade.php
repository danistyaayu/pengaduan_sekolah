<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name'))</title>

    <!-- TAILWIND -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

<div class="flex min-h-screen">

    {{-- SIDEBAR --}}
    @auth
        @include('layouts.sidebar')
    @endauth

    {{-- MAIN --}}
    <div class="flex flex-col flex-1 ml-20 transition-all duration-300">
        {{-- ⬆️ INI YANG DITAMBAHKAN --}}

        {{-- TOPBAR --}}
        @auth
            @include('layouts.topbar')
        @endauth

        {{-- CONTENT --}}
        <main class="flex-1 overflow-y-auto p-6">

            @if(session('success'))
                <div class="mb-6 bg-green-100 border border-green-300 text-green-800 px-6 py-4 rounded-xl shadow">
                    ✅ {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6 bg-red-100 border border-red-300 text-red-800 px-6 py-4 rounded-xl shadow">
                    ❌ {{ session('error') }}
                </div>
            @endif

            @yield('content')
        </main>
    </div>
</div>

</body>
</html>
