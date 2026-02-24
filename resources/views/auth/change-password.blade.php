@extends('layouts.guest')

@section('title', 'Ganti Password')
@section('subtitle', 'Ganti Password Pertama Kali')

@section('content')
<div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-6 rounded">
    <div class="flex items-start">
        <span class="text-3xl mr-3">⚠️</span>
        <div>
            <p class="font-bold text-yellow-800">PERHATIAN!</p>
            <p class="text-sm text-yellow-700 mt-1">
                Anda menggunakan password default. Silakan ganti password Anda sebelum dapat menggunakan sistem.
            </p>
        </div>
    </div>
</div>

<form method="POST" action="{{ route('siswa.change-password.update') }}">
    @csrf
    
    <div class="mb-5">
        <label class="block text-gray-700 font-bold mb-2" for="old_password">
            🔐 Password Lama
        </label>
        <input type="password" 
               id="old_password" 
               name="old_password" 
               required
               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
        @error('old_password')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>
    
    <div class="mb-5">
        <label class="block text-gray-700 font-bold mb-2" for="password">
            🔐 Password Baru
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
    
    <div class="mb-6">
        <label class="block text-gray-700 font-bold mb-2" for="password_confirmation">
            🔐 Konfirmasi Password
        </label>
        <input type="password" 
               id="password_confirmation" 
               name="password_confirmation" 
               required
               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
    </div>
    
    <div class="bg-blue-50 border-l-4 border-blue-400 p-3 mb-6 rounded">
        <p class="font-semibold text-blue-800 text-sm">✅ Persyaratan Password:</p>
        <ul class="text-xs text-blue-700 mt-2 space-y-1">
            <li>• Minimal 8 karakter</li>
            <li>• Mengandung huruf dan angka</li>
            <li>• Tidak sama dengan password lama</li>
        </ul>
    </div>
    
    <button type="submit" 
            class="w-full bg-blue-600 text-white font-bold py-3 px-4 rounded-lg hover:bg-blue-700 transition duration-300 shadow-lg hover:shadow-xl">
        ✅ SIMPAN PASSWORD
    </button>
</form>
@endsection