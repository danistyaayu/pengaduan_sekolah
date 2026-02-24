<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', config('app.name'))</title>
    
    <!-- CSS Inline untuk Tailwind-like styling -->
    <style>
        :root {
            --primary-blue: #3B82F6;
            --primary-green: #10B981;
            --primary-purple: #8B5CF6;
            --secondary-yellow: #F59E0B;
            --secondary-red: #EF4444;
        }
        
        /* Basic Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            /* Background biru muda gradasi soft */
            background: linear-gradient(135deg, #5a9ec0 0%, #97bdc2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
        }
        
        /* Utility Classes */
        .bg-white { background-color: white; }
        .text-gray-800 { color: #1f2937; }
        .text-gray-600 { color: #4b5563; }
        .font-bold { font-weight: bold; }
        .rounded-xl { border-radius: 0.75rem; }
        .shadow-2xl { box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.1); }
        .p-8 { padding: 2rem; }
        .mb-8 { margin-bottom: 2rem; }
        .mb-4 { margin-bottom: 1rem; }
        .mt-6 { margin-top: 1.5rem; }
        .text-center { text-align: center; }
        .flex { display: flex; }
        .items-center { align-items: center; }
        .justify-center { justify-content: center; }
        .w-full { width: 100%; }
        .max-w-md { max-width: 28rem; }
        .text-3xl { font-size: 1.875rem; }
        .text-5xl { font-size: 3rem; }
        .text-sm { font-size: 0.875rem; }
        
        /* Alert Styles */
        .bg-green-100 { background-color: #d15; }
        .border-green-400 { border-color: #4ade80; }
        .text-green-700 { color: #065f46; }
        
        .bg-red-100 { background-color: #fee2e2; }
        .border-red-400 { border-color: #f87171; }
        .text-red-700 { color: #b91c1c; }
        
        /* List Styles */
        .list-disc { list-style-type: disc; }
        .list-inside { list-style-position: inside; }
    </style>
</head>
<body class="bg-gradient-br from-blue-50 to-blue-100 min-h-screen flex items-center justify-center p-4">
    <div class="bg-white rounded-xl shadow-2xl p-8 w-full max-w-md">
        <div class="text-center mb-8">
            <div class="text-5xl mb-3">🏫</div>
            <h1 class="text-3xl font-bold text-gray-800">Pengaduan Sekolah</h1>
            <p class="text-gray-600 mt-2">@yield('subtitle', 'Sistem Pengaduan Sekolah')</p>
        </div>
        
        @if(session('success'))
            <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg">
                {{ session('success') }}
            </div>
        @endif
        
        @if(session('error'))
            <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg">
                {{ session('error') }}
            </div>
        @endif
        
        @if($errors->any())
            <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        @yield('content')
        
        <div class="mt-6 text-center text-sm text-gray-600">
            @yield('footer')
        </div>
    </div>
</body>
</html>