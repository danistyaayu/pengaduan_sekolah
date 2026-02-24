@extends('layouts.guest')

@section('title', 'Login Siswa')
@section('subtitle', 'Login Siswa Sekolah')

@section('content')
<form method="POST" action="{{ route('login.siswa.store') }}">
    @csrf
    
    <div class="mb-5">
        <label class="block text-gray-700 font-bold mb-2" for="nis">
            🆔 NIS (Nomor Induk Siswa)
        </label>
        <input type="text" 
               id="nis" 
               name="nis" 
               value="{{ old('nis') }}" 
               required 
               autofocus
               placeholder="Contoh: 2310001"
               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
        @error('nis')
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
               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
        @error('password')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>
    
    <div class="flex items-center justify-between mb-6">
        <label class="inline-flex items-center">
            <input type="checkbox" name="remember" class="form-checkbox h-4 w-4 text-green-600">
            <span class="ml-2 text-gray-700 text-sm">Ingat Saya</span>
        </label>
        
        <a href="{{ route('login.admin') }}" class="text-sm text-green-600 hover:underline">
            Login sebagai Admin
        </a>
    </div>
    
    <button type="submit" 
            class="w-full bg-green-600 text-white font-bold py-3 px-4 rounded-lg hover:bg-green-700 transition duration-300 shadow-lg hover:shadow-xl">
        🔐 MASUK SEBAGAI SISWA
    </button>
</form>
@endsection

@section('footer')
    💡 Password pertama kali diberikan oleh admin<br>
    🔑 Lupa password? Hubungi guru BK atau admin sekolah
@endsection