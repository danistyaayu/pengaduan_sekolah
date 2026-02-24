@extends('layouts.app')

@section('title', 'Buat Pengaduan Baru - Siswa')
@section('page-title', '➕ Buat Pengaduan Baru')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-lg shadow p-6">
        <a href="{{ route('siswa.aspirasi.index') }}" 
           class="text-blue-600 hover:underline mb-4 inline-block">
            ← Kembali ke Daftar Pengaduan
        </a>
        
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Form Pengaduan</h2>
        
        <form method="POST" action="{{ route('siswa.aspirasi.store') }}">
            @csrf
            
            <!-- Step 1: Kategori -->
            <div class="mb-6">
                <h3 class="text-lg font-bold text-gray-800 mb-3">Step 1: Pilih Kategori Pengaduan</h3>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                    @foreach($categories as $category)
                    <label class="flex flex-col items-center justify-center p-4 border-2 rounded-lg cursor-pointer hover:border-blue-500 transition {{ old('category') == $category ? 'border-blue-500 bg-blue-50' : 'border-gray-300' }}">
                        <input type="radio" name="category" value="{{ $category }}" 
                               required {{ old('category') == $category ? 'checked' : '' }}
                               class="hidden">
                        <span class="text-3xl mb-2">
                            @if($category == 'Fasilitas Sekolah') 🏫
                            @elseif($category == 'Bullying') 👥
                            @elseif($category == 'Kurikulum') 📚
                            @elseif($category == 'Kebersihan') 🧹
                            @elseif($category == 'Listrik') 🔌
                            @elseif($category == 'Keamanan') 🔒
                            @else 📝
                            @endif
                        </span>
                        <span class="text-sm font-semibold text-center">{{ $category }}</span>
                    </label>
                    @endforeach
                </div>
                @error('category')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="border-t my-6"></div>
            
            <!-- Step 2: Detail Pengaduan -->
            <div class="mb-6">
                <h3 class="text-lg font-bold text-gray-800 mb-3">Step 2: Isi Detail Pengaduan</h3>
                
                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-2" for="title">
                        Judul Pengaduan <span class="text-red-500">*</span>
                    </label>
                    <input type="text" 
                           id="title" 
                           name="title" 
                           value="{{ old('title') }}" 
                           required
                           maxlength="100"
                           placeholder="Contoh: Fasilitas toilet rusak di lantai 2"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <p class="text-xs text-gray-500 mt-1">Maksimal 100 karakter</p>
                    @error('title')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-2" for="description">
                        Deskripsi Detail <span class="text-red-500">*</span>
                    </label>
                    <textarea id="description" 
                              name="description" 
                              rows="6"
                              required
                              maxlength="1000"
                              placeholder="Jelaskan secara detail masalah yang Anda alami..."
                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 resize-none"
                              oninput="countChars(this)">{{ old('description') }}</textarea>
                    <p class="text-xs text-gray-500 mt-1">Maksimal 1000 karakter. <span id="charCount">0</span> / 1000</p>
                    @error('description')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-2" for="location">
                        Lokasi Kejadian (Opsional)
                    </label>
                    <select id="location" name="location"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Pilih lokasi atau biarkan kosong</option>
                        @foreach($locations as $location)
                        <option value="{{ $location }}" {{ old('location') == $location ? 'selected' : '' }}>{{ $location }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            
            <!-- Submit Buttons -->
            <div class="mt-8 flex space-x-4">
                <button type="submit" 
                        class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 font-bold text-lg shadow-lg hover:shadow-xl transition">
                    ✅ Submit Pengaduan
                </button>
                
                <a href="{{ route('siswa.aspirasi.index') }}" 
                   class="bg-gray-300 text-gray-700 px-6 py-3 rounded-lg hover:bg-gray-400 font-semibold">
                    Batal
                </a>
            </div>
        </form>
        
        <!-- Info Box -->
        <div class="mt-6 bg-blue-50 border-l-4 border-blue-400 p-4 rounded">
            <h3 class="font-bold text-blue-800 mb-2">ℹ️ Tips Menulis Pengaduan yang Baik:</h3>
            <ul class="text-sm text-blue-700 space-y-1">
                <li>• Jelaskan masalah dengan jelas dan detail</li>
                <li>• Sertakan lokasi kejadian jika memungkinkan</li>
                <li>• Gunakan bahasa yang sopan dan objektif</li>
                <li>• Cantumkan waktu kejadian jika relevan</li>
                <li>• Pengaduan Anda akan diproses secepatnya oleh admin</li>
            </ul>
        </div>
    </div>
</div>

<script>
function countChars(textarea) {
    document.getElementById('charCount').textContent = textarea.value.length;
}
// Initialize on page load
document.addEventListener('DOMContentLoaded', function() {
    const textarea = document.getElementById('description');
    if (textarea) {
        countChars(textarea);
    }
});
</script>
@endsection
