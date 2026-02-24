@extends('layouts.app')

@section('title', 'Tambah Siswa Baru - Admin')
@section('page-title', '➕ Tambah Siswa Baru')

@section('content')
<div class="w-full flex justify-center py-10 px-4">

    <!-- Card Utama -->
    <div class="w-full max-w-5xl">

        <div class="bg-white rounded-2xl shadow-xl p-10 space-y-10">

            <!-- Back -->
            <a href="{{ route('admin.students.index') }}"
               class="inline-flex items-center text-blue-600 hover:underline font-semibold">
                ← Kembali ke Daftar Siswa
            </a>

            <!-- Title -->
            <div>
                <h2 class="text-3xl font-bold text-gray-800">
                    Form Data Siswa
                </h2>
                <p class="text-gray-500 mt-2">
                    Silakan isi data siswa dengan lengkap dan benar
                </p>
            </div>

            <!-- Form -->
            <form method="POST" action="{{ route('admin.students.store') }}">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-10 gap-y-8">

                    <!-- NIS -->
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-3">
                            🆔 NIS <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="nis" value="{{ old('nis') }}" required
                               placeholder="Contoh: 2310001"
                               class="w-full px-5 py-4 text-lg border border-gray-300 rounded-xl
                                      focus:ring-2 focus:ring-blue-500 focus:outline-none">
                        @error('nis')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                        <p class="text-sm text-gray-500 mt-2">
                            Format: 2 digit tahun + 4 digit nomor
                        </p>
                    </div>

                    <!-- Nama -->
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-3">
                            👤 Nama Lengkap <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="name" value="{{ old('name') }}" required
                               placeholder="Nama lengkap siswa"
                               class="w-full px-5 py-4 text-lg border border-gray-300 rounded-xl
                                      focus:ring-2 focus:ring-blue-500 focus:outline-none">
                        @error('name')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Kelas -->
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-3">
                            📚 Kelas <span class="text-red-500">*</span>
                        </label>
                        <select name="class" required
                                class="w-full px-5 py-4 text-lg border border-gray-300 rounded-xl
                                       focus:ring-2 focus:ring-blue-500 focus:outline-none">
                            <option value="">Pilih Kelas</option>
                            @foreach($classes as $kelas)
                                <option value="{{ $kelas }}" {{ old('class') == $kelas ? 'selected' : '' }}>
                                    {{ $kelas }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Jurusan -->
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-3">
                            🎓 Jurusan <span class="text-red-500">*</span>
                        </label>
                        <select name="major" required
                                class="w-full px-5 py-4 text-lg border border-gray-300 rounded-xl
                                       focus:ring-2 focus:ring-blue-500 focus:outline-none">
                            <option value="">Pilih Jurusan</option>
                            @foreach($majors as $jurusan)
                                <option value="{{ $jurusan }}" {{ old('major') == $jurusan ? 'selected' : '' }}>
                                    {{ $jurusan }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Password -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-bold text-gray-700 mb-3">
                            🔐 Password
                        </label>
                        <input type="password" name="password"
                               placeholder="Kosongkan untuk password otomatis"
                               class="w-full px-5 py-4 text-lg border border-gray-300 rounded-xl
                                      focus:ring-2 focus:ring-blue-500 focus:outline-none">
                        <p class="text-sm text-gray-500 mt-2">
                            Password default: <span class="font-mono">sekolah{{ date('Y') }}</span>
                        </p>
                    </div>

                    <!-- Konfirmasi -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-bold text-gray-700 mb-3">
                            🔐 Konfirmasi Password
                        </label>
                        <input type="password" name="password_confirmation"
                               class="w-full px-5 py-4 text-lg border border-gray-300 rounded-xl
                                      focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    </div>
                </div>

                <!-- Buttons -->
                <div class="mt-10 flex gap-6">
                    <button type="submit"
                            class="bg-green-600 text-white px-8 py-4 rounded-xl
                                   font-bold text-lg hover:bg-green-700 shadow-lg transition">
                        ✅ Simpan Siswa
                    </button>

                    <a href="{{ route('admin.students.index') }}"
                       class="bg-gray-200 text-gray-700 px-8 py-4 rounded-xl
                              font-semibold hover:bg-gray-300">
                        Batal
                    </a>
                </div>
            </form>

            <!-- Info -->
            <div class="bg-blue-50 border-l-4 border-blue-400 p-6 rounded-xl">
                <h3 class="font-bold text-blue-800 mb-3">
                    ℹ️ Informasi Penting
                </h3>
                <ul class="text-sm text-blue-700 space-y-2">
                    <li>• NIS harus unik</li>
                    <li>• Password default diberikan ke siswa</li>
                    <li>• Siswa wajib ganti password saat login pertama</li>
                    <li>• Data bisa diedit kapan saja</li>
                </ul>
            </div>

        </div>
    </div>
</div>
@endsection
