@auth
<div class="bg-white shadow-md p-4 flex justify-between items-center">

    <h2 class="text-xl font-bold text-gray-800">
        @yield('page-title', 'Dashboard')
    </h2>

    <div class="flex items-center space-x-4">

        @if(auth()->user()->isAdmin())
            <div class="text-right">
                <p class="font-semibold">{{ auth()->user()->name }}</p>
                <p class="text-sm text-blue-600">Administrator</p>
            </div>

            <div class="w-10 h-10 bg-blue-600 text-white rounded-full flex items-center justify-center">
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
            </div>
        @else
            <div class="text-right">
                <p class="font-semibold">{{ auth()->user()->name }}</p>
                <p class="text-sm text-green-600">
                    {{ auth()->user()->class }} {{ auth()->user()->major }}
                </p>
            </div>

            <div class="w-10 h-10 bg-green-600 text-white rounded-full flex items-center justify-center">
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
            </div>
        @endif

    </div>
</div>
@endauth
