@extends('layouts.guest')

@section('title', 'Login Admin')
@section('subtitle', 'Login Admin Sekolah')

@section('content')
<form method="POST" action="{{ route('login.admin.store') }}">
    @csrf
    
    <div class="mb-5">
        <label class="block text-gray-700 font-bold mb-2" for="username">
            👤 Username
        </label>
        <input type="text" 
               id="username" 
               name="username" 
               value="{{ old('username') }}" 
               required 
               autofocus
               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
        @error('username')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>
    
    <div class="mb-6">
        <label class="block text-gray-700 font-bold mb-2" for="password">
            🔐 Password
        </label>
        <input type="password" 
               id="password" 
               name="password" 
               required
               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
        @error('password')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>
    
    <div class="flex items-center justify-between mb-6">
        <label class="inline-flex items-center">
            <input type="checkbox" name="remember" class="form-checkbox h-4 w-4 text-blue-600">
            <span class="ml-2 text-gray-700 text-sm">Ingat Saya</span>
        </label>
        
        <a href="{{ route('login.siswa') }}" class="text-sm text-blue-600 hover:underline">
            Login sebagai Siswa
        </a>
    </div>
    
    <button type="submit" 
            class="w-full bg-blue-600 text-white font-bold py-3 px-4 rounded-lg hover:bg-blue-700 transition duration-300 shadow-lg hover:shadow-xl">
        🔐 MASUK SEBAGAI ADMIN
    </button>
</form>
@endsection

@section('footer')
    🔑 Belum punya akun? Hubungi IT Sekolah
@endsection