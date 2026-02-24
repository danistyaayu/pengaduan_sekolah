@extends('layouts.app')

@section('title', 'Edit Siswa - Admin')
@section('page-title', '✏️ Edit Data Siswa')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="bg-white rounded-lg shadow p-6">
        <a href="{{ route('admin.students.index') }}" 
           class="text-blue-600 hover:underline mb-4 inline-block">
            ← Kembali ke Daftar Siswa
        </a>
        
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Edit Data Siswa</h2>
        
        <form method="POST" action="{{ route('admin.students.update', $student->id) }}">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- NIS (Read Only) -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2" for="nis">
                        🆔 NIS
                    </label>
                    <input type="text" 
                           id="nis" 
                           value="{{ $student->nis }}" 
                           disabled
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-gray-100 cursor-not-allowed">
                    <p class="text-xs text-gray-500 mt-1">NIS tidak dapat diubah</p>
                </div>
                
                <!-- Nama Lengkap -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2" for="name">
                        👤 Nama Lengkap <span class="text-red-500">*</span>
                    </label>
                    <input type="text" 
                           id="name" 
                           name="name" 
                           value="{{ old('name', $student->name) }}" 
                           required
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Kelas -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2" for="class">
                        📚 Kelas <span class="text-red-500">*</span>
                    </label>
                    <select id="class" name="class" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @foreach($classes as $kelas)
                        <option value="{{ $kelas }}" {{ old('class', $student->class) == $kelas ? 'selected' : '' }}>{{ $kelas }}</option>
                        @endforeach
                    </select>
                    @error('class')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Jurusan -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2" for="major">
                        🎓 Jurusan <span class="text-red-500">*</span>
                    </label>
                    <select id="major" name="major" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @foreach($majors as $jurusan)
                        <option value="{{ $jurusan }}" {{ old('major', $student->major) == $jurusan ? 'selected' : '' }}>{{ $jurusan }}</option>
                        @endforeach
                    </select>
                    @error('major')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            
            <!-- Submit Buttons -->
            <div class="mt-8 flex space-x-4">
                <button type="submit" 
                        class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 font-bold text-lg shadow-lg hover:shadow-xl transition">
                    ✅ Update Data
                </button>
                
                <a href="{{ route('admin.students.index') }}" 
                   class="bg-gray-300 text-gray-700 px-6 py-3 rounded-lg hover:bg-gray-400 font-semibold">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection